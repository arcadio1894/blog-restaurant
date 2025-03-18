$(document).ready(function () {
    getDataPosts(1);

    $("#page").on('click', showData);

    $(document).on('click', '[data-page]', showData);

});

function showData() {
    //event.preventDefault();
    var numberPage = $(this).attr('data-page');
    console.log(numberPage);
    getDataPosts(numberPage)
}

function getDataPosts($numberPage) {
    $('[data-toggle="tooltip"]').tooltip('dispose').tooltip({
        selector: '[data-toggle="tooltip"]'
    });

    $.get('/blog/get/welcome/posts/'+$numberPage, {},function(data) {
        if ( data.data.length > 0 )
        {
            renderDataPosts(data);
        }


    }).fail(function(jqXHR, textStatus, errorThrown) {
        // Función de error, se ejecuta cuando la solicitud GET falla
        console.error(textStatus, errorThrown);
        if (jqXHR.responseJSON.message && !jqXHR.responseJSON.errors) {
            toastr.error(jqXHR.responseJSON.message, 'Error', {
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
        for (var property in jqXHR.responseJSON.errors) {
            toastr.error(jqXHR.responseJSON.errors[property], 'Error', {
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
    }, 'json')
        .done(function() {
            // Configuración de encabezados
            var headers = {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            };

            $.ajaxSetup({
                headers: headers
            });
        });
}

function renderDataPosts(data) {
    var dataPosts = data.data;
    var pagination = data.pagination;

    $("#body-table").html('');
    $("#pagination").html('');

    for (let j = 0; j < dataPosts.length ; j++) {
        renderDataTable(dataPosts[j]);
    }

    if ( pagination.currentPage == 1 )
    {
        // Si solo hay un botón "Older Posts" y es la única página, aseguramos que esté a la derecha
        $("#pagination").addClass('justify-content-end').removeClass('justify-content-between');
    } else {
        $("#pagination").removeClass('justify-content-end').addClass('justify-content-between');
    }

    if (pagination.currentPage > 1)
    {
        renderPreviousPage(pagination.currentPage-1);
    }

    if (pagination.currentPage < pagination.totalPages) {
        renderNextPage(pagination.currentPage + 1);
    }
}

function renderDataTable(data) {
    var clone = activateTemplate('#item-post');

    clone.querySelector("[data-url]").setAttribute("href", data.url);
    clone.querySelector("[data-title]").innerHTML = data.title;
    clone.querySelector("[data-subtitle]").innerHTML = data.subtitle;
    clone.querySelector("[data-posted]").innerHTML = data.posted;

    $("#body-table").append(clone);
}

function renderPreviousPage($numberPage) {
    var clone = activateTemplate('#previous-page');
    clone.querySelector("[data-page]").setAttribute('data-page', $numberPage);
    $("#pagination").append(clone);
}

function renderNextPage($numberPage) {
    var clone = activateTemplate('#next-page');
    clone.querySelector("[data-page]").setAttribute('data-page', $numberPage);
    $("#pagination").append(clone);
}

function activateTemplate(id) {
    var t = document.querySelector(id);
    return document.importNode(t.content, true);
}