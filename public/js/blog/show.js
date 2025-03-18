$(document).ready(function() {
    // 1. Elimina atributos style innecesarios en cualquier etiqueta dentro de .text_description_show
    $('.text_description_show *').removeAttr('style');

    // 2. Elimina <p> que solo contienen <br>, &nbsp; o están vacíos
    $('.text_description_show p').each(function() {
        let content = $(this).html().trim();
        if (content === '' || content === '<br>' || content === '&nbsp;') {
            $(this).remove();
        }
    });

    // 3. Elimina <span> vacíos o con solo espacios (&nbsp;)
    $('.text_description_show span').each(function() {
        let content = $(this).html().trim();
        if (content === '' || content === '&nbsp;') {
            $(this).remove();
        }
    });

    // 4. Elimina espacios normales y &nbsp; al inicio de cualquier etiqueta
    $('.text_description_show *').each(function() {
        let content = $(this).html();
        if (content) {
            $(this).html(content.replace(/^(\s|&nbsp;)+/, '')); // Elimina espacios y &nbsp; al inicio
        }
    });

    // 5. Si hay varios <p> vacíos seguidos, los elimina
    $('.text_description_show p:empty').remove();
});