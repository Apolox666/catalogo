$(document).ready(function() {
    $('#search').on('input', function() {
        var searchTerm = $(this).val();
        if (searchTerm.length >= 3) {
            $.ajax({
                url: searchRoute, // Utiliza la variable searchRoute
                method: 'GET',
                data: {search: searchTerm},
                success: function(response) {
                    var activities = response.activities;
                    var resultsHtml = '<ul>';
                    activities.forEach(function(activity) {
                        // Genera la ruta con el ID de la actividad
                        var showRoute = "{{ route('activity.show', ':id') }}";
                        showRoute = showRoute.replace(':id', activity.id);
                        resultsHtml += '<li class="py-2 text-white font-bold hover:bg-blue-500 rounded-full hover:bg-opacity-50 "><a href="'+ showRoute +'">'+ activity.name +'</a></li>';
                    });
                    resultsHtml += '</ul>';
                    $('#search-results').html(resultsHtml);
                }
            });
        } else {
            $('#search-results').html('');
        }
    });
});
