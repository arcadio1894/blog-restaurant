$(document).ready(function() {
    // Elimina style="font-size: 1rem;" en cualquier etiqueta
    $('.text_description_show *[style*="font-size: 1rem;"]').removeAttr('style');

    // Elimina <p><br></p>
    $('.text_description_show p').each(function() {
        if ($(this).html().trim() === '<br>') {
            $(this).remove();
        }
    });

    // Elimina espacios normales y &nbsp; al inicio del contenido de cualquier etiqueta dentro de .text_description_show
    $('.text_description_show *').each(function() {
        let content = $(this).html();
        $(this).html(content.replace(/^(\s|&nbsp;)+/, '')); // Elimina espacios y &nbsp; al inicio
    });
});