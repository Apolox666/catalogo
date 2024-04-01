$(document).on('click', 'a[href]', function() {
    $('#spinner-overlay').removeClass('hidden').css('opacity', 1);
});

$(document).ready(function() {
    // Hacer que el spinner se desvanezca gradualmente una vez que la página ha sido cargada completamente
    setTimeout(function() {
        $('#spinner-overlay').css('opacity', 0);
        setTimeout(function() {
            $('#spinner-overlay').addClass('hidden');
        }, 500); // Ajusta el tiempo para que coincida con la duración de la transición CSS
    }, 1000); // Ajusta el tiempo para que coincida con la duración de la transición CSS
});