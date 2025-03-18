let $caracteres = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
let $longitud = 10;

$(document).ready(function() {
    $('#add-tag').on('click', addTag);

    $(document).on('click', '.remove-tag', removeTag);

    $('#add_description').on('click', addDescription);
    $('#add_image').on('click', addImage);
    $('#add_subtitle').on('click', addSubtitle);
    $('#add_video').on('click', addVideo);

    $(document).on('click', '[data-remove_section]', removeSection);

    $('#banner').on('change', changeImage);

    $('#title').on('input', changeTitle);

    $('#idea').on('input', changeSubtitle);

    //$(document).on('input', '[data-text_description]', changeDescription);
    $(document).on("summernote.change", "[data-text_description]", changeDescription);

    $(document).on('input', '[data-text_subtitle]', changeDescriptionSubtitle);

    $(document).on('input', '[data-comment_image]', changeCommentImage);

    $(document).on('input', '[data-image]', changeDescriptionImage);

    $(document).on('input', '[data-text_video]', changeDescriptionVideo);

    $(document).on('input', '[data-comment_video]', changeCommentVideo);

    $("#btn-submit").on('click', savePost);
});

function savePost() {
    event.preventDefault();
    $("#btn-submit").attr("disabled", true);

    // Obtener el token CSRF desde la meta etiqueta
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    // TODO: Datos generales
    var category_id = $("#category_id").val();
    var imagen = $("#banner")[0].files[0];
    var title = $("#title").val();
    var idea = $("#idea").val();
    let tags = [];
    $('#tags-container input[data-text]').each(function() {
        tags.push($(this).val());
    });

    // TODO: Recorremos todas las secciones
    let sectionsData = [];
    let imageIndex = 0; // Variable para manejar el índice de las imágenes

    $('#sections-container [data-section]').each(function(index) {
        let sectionType = $(this).data('section');
        let sectionData = {};

        if (sectionType === 'description') {
            sectionData.type = 'description';
            sectionData.text_description = $(this).find('textarea[data-text_description]').val();

        } else if (sectionType === 'image') {
            sectionData.type = 'image';
            sectionData.comment_image = $(this).find('textarea[data-comment_image]').val();
            sectionData.image_name = 'section_image_' + imageIndex; // Nombre único para cada imagen
            imageIndex++;

        } else if (sectionType === 'subtitle') {
            sectionData.type = 'subtitle';
            sectionData.text_subtitle = $(this).find('textarea[data-text_subtitle]').val();

        } else if (sectionType === 'video') {
            sectionData.type = 'video';
            sectionData.comment_video = $(this).find('textarea[data-comment_video]').val();
            sectionData.url_video = $(this).find('textarea[data-text_video]').val();
        }

        sectionsData.push(sectionData);
    });

    //console.log(sectionsData);
    // Crear FormData y añadir todos los datos
    var formData = new FormData();
    formData.append('category_id', category_id);
    formData.append('banner', imagen);
    formData.append('title', title);
    formData.append('idea', idea);
    formData.append('tags', JSON.stringify(tags));
    formData.append('sections', JSON.stringify(sectionsData));
    formData.append('_token', csrfToken);

    // Añadir las imágenes al FormData
    imageIndex = 0; // Reiniciamos el índice de las imágenes
    $('#sections-container [data-section="image"]').each(function(index) {
        let fileInput = $(this).find('input[data-image]')[0];
        if (fileInput.files.length > 0) {
            formData.append('section_image_' + imageIndex, fileInput.files[0]);
            imageIndex++;
        }
    });

    // Enviar los datos al servidor usando $.ajax
    $.ajax({
        url: $("#btn-submit").attr("data-url"), // Reemplaza con la URL de tu servidor
        type: 'POST',
        data: formData,
        contentType: false, // Para evitar que jQuery establezca el contentType
        processData: false, // Para evitar que jQuery procese los datos
        success: function(data) {
            toastr.success(data.message, 'Éxito',
                {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "2000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                });
            setTimeout( function () {
                $("#btn-submit").attr("disabled", false);
                location.reload();
            }, 2000 )
        },
        error: function(data) {
            if( data.responseJSON.message && !data.responseJSON.errors )
            {
                toastr.error(data.responseJSON.message, 'Error',
                    {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "2000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    });
            }
            for ( var property in data.responseJSON.errors ) {
                toastr.error(data.responseJSON.errors[property], 'Error',
                    {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "2000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    });
            }
            // Habilitar el botón y manejar el error
            $("#btn-submit").attr("disabled", false);
        }
    });

}

function changeCommentVideo() {
    var comment = $(this).val();
    console.log(comment);
    var code = $(this).parent().parent().parent().parent().attr('data-id_section');
    console.log(code);
    var targetElement = $('[data-id_preview_video="' + code + '"]');
    console.log(targetElement.find('[data-comment_video]'));
    targetElement.find('[data-comment_video]').html(comment)

}

function changeDescriptionVideo() {
    var code = $(this).parent().parent().parent().parent().attr('data-id_section');
    var targetElement = $('[data-id_preview_video="' + code + '"]');

    var url = $(this).val();
    // Extraer el código del video de YouTube
    var videoId = getYouTubeVideoId(url);

    if (videoId) {
        // Construir la URL del embed de YouTube
        var embedUrl = 'https://www.youtube.com/embed/' + videoId;
        // Actualizar el src del iframe en el preview
        var iframe = '<iframe width="460" height="315" src="' + embedUrl + '" frameborder="0" allowfullscreen></iframe>';
        targetElement.find('[data-preview_video]').html(iframe);
        //$('[data-preview_video]').html(iframe);
    } else {
        // Si la URL no es válida, limpiar el preview
        targetElement.find('[data-preview_video]').html('');
        //$('[data-preview_video]').html('');
    }
}

function getYouTubeVideoId(url) {
    var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
    var match = url.match(regExp);
    if (match && match[2].length === 11) {
        return match[2];
    } else {
        return false;
    }
}

function changeDescriptionImage() {
    var code = $(this).parent().parent().parent().parent().attr('data-id_section');
    var targetElement = $('[data-id_preview_image="' + code + '"]');

    var file = this.files[0];

    if (file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            targetElement.find('[data-url_image]').attr('src',e.target.result);
            //$('#preview').html('<img class="img-fluid" src="' + e.target.result + '" alt="Selected Image">');
        };
        reader.readAsDataURL(file);
    } else {
        targetElement.find('[data-url_image]').attr('src',"");
    }
}

function changeCommentImage() {
    var comment = $(this).val();
    console.log(comment);
    var code = $(this).parent().parent().parent().parent().attr('data-id_section');
    console.log(code);
    var targetElement = $('[data-id_preview_image="' + code + '"]');
    console.log(targetElement.find('[data-comment_image]'));
    targetElement.find('[data-comment_image]').html(comment)

}

function changeDescriptionSubtitle() {
    var text = $(this).val();
    console.log(text);
    var code = $(this).parent().parent().parent().parent().attr('data-id_section');
    console.log(code);
    var targetElement = $('[data-id_preview_subtitle="' + code + '"]');
    console.log(targetElement);
    targetElement.html(text);
}

function changeDescription() {
    var text = $(this).val();
    var code = $(this).parent().parent().parent().parent().attr('data-id_section');
    var targetElement = $('[data-id_preview_description="' + code + '"]');
    targetElement.html(text);
}

function changeSubtitle() {
    var text = $(this).val();
    $('#preview_subtitle').text(text);
}

function changeTitle() {
    var text = $(this).val();
    $('#preview_title').text(text);
}

function changeImage() {
    var file = this.files[0];
    if (file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#preview').html('<img class="img-fluid" src="' + e.target.result + '" alt="Selected Image">');
        };
        reader.readAsDataURL(file);
    } else {
        $('#preview').html('');
    }
}

function removeSection() {
    var code = $(this).parent().parent().parent().attr('data-id_section');
    var type = $(this).parent().parent().parent().attr('data-section');
    var targetElement = $('[data-id_preview_'+type+'="' + code + '"]');
    targetElement.remove();
    $(this).parent().parent().parent().remove();

}

function addVideo() {
    var clone = activateTemplate('#template-video');
    var clone_p = activateTemplate('#template-preview_video');

    var code = rand_code($caracteres, $longitud);
    clone.querySelector("[data-id_section]").setAttribute('data-id_section', code);
    clone_p.querySelector("[data-id_preview_video]").setAttribute('data-id_preview_video', code);

    $("#sections-container").append(clone);

    $("#sections-preview").append(clone_p);
}

function addSubtitle() {
    var clone = activateTemplate('#template-subtitle');
    var clone_p = activateTemplate('#template-preview_subtitle');

    var code = rand_code($caracteres, $longitud);
    clone.querySelector("[data-id_section]").setAttribute('data-id_section', code);
    clone_p.querySelector("[data-id_preview_subtitle]").setAttribute('data-id_preview_subtitle', code);

    $("#sections-container").append(clone);

    $("#sections-preview").append(clone_p);
}

function addImage() {
    var clone = activateTemplate('#template-image');
    var clone_p = activateTemplate('#template-preview_image');

    var code = rand_code($caracteres, $longitud);
    clone.querySelector("[data-id_section]").setAttribute('data-id_section', code);
    clone_p.querySelector("[data-id_preview_image]").setAttribute('data-id_preview_image', code);

    $("#sections-container").append(clone);

    $("#sections-preview").append(clone_p);
}

function addDescription() {
    var clone = activateTemplate('#template-description');
    var clone_p = activateTemplate('#template-preview_description');

    var code = rand_code($caracteres, $longitud);
    clone.querySelector("[data-id_section]").setAttribute('data-id_section', code);
    clone_p.querySelector("[data-id_preview_description]").setAttribute('data-id_preview_description', code);

    $("#sections-container").append(clone);

    $("#sections-preview").append(clone_p);

    $('.textarea_edit').summernote({
        lang: 'es-ES',
        placeholder: 'Ingrese los detalles',
        tabsize: 2,
        height: 120,
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['para', ['ul', 'ol']],
            ['insert', ['link']],
            ['view', ['codeview', 'help']]
        ],
        callbacks: {
            onPaste: function(e) {
                // Acceder al texto del portapapeles
                var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');

                // Prevenir la acción de pegado predeterminada
                e.preventDefault();

                // Insertar el texto sin formato en Summernote
                document.execCommand('insertText', false, bufferText);
            }
        }
    });
}

function addTag() {
    event.preventDefault();
    var tagText = $('#tag-input').val();
    if (tagText) {
        renderTag(tagText);
        $('#tag-input').val('');
    }
}

function removeTag() {
    $(this).parent().parent().remove();
}

function renderTag(tagText) {
    var clone = activateTemplate('#template-tag');
    clone.querySelector("[data-text]").setAttribute('value', tagText);
    $("#tags-container").append(clone);
}

function activateTemplate(id) {
    var t = document.querySelector(id);
    return document.importNode(t.content, true);
}

function rand_code($caracteres, $longitud){
    var code = "";
    for (var x=0; x < $longitud; x++)
    {
        var rand = Math.floor(Math.random()*$caracteres.length);
        code += $caracteres.substr(rand, 1);
    }
    return code;
}

function mayus(e) {
    e.value = e.value.toUpperCase();
}