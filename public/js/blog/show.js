$(document).ready(function() {
    // 1. Elimina atributos 'style' innecesarios de cualquier etiqueta dentro de .text_description_show
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

    // 4. Busca *cualquier* nodo de texto dentro de .text_description_show y elimina espacios al inicio
    $('.text_description_show *').contents().each(function() {
        if (this.nodeType === 3) { // Nodo de texto
            this.nodeValue = this.nodeValue.replace(/^\s+|\u00A0+/g, ''); // Elimina espacios y &nbsp; al inicio
        }
    });

    // 5. Si hay <p> vacíos después de limpiar, los elimina
    $('.text_description_show p:empty').remove();
});