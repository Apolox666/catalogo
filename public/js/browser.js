$(document).ready(function() {
    $('#search').on('input', function() {
        var searchTerm = $(this).val();
        if (searchTerm.length >= 3) {
            $.ajax({
                url: "{{ route('activity.search') }}",
                method: 'GET',
                data: {
                    search: searchTerm
                },
                success: function(response) {
                    var activities = response.activities;
                    var resultsHtml = '<ul>';
                    activities.forEach(function(activity) {
                        // Genera la ruta con el ID de la actividad usando Blade
                        var showRoute = "{{ route('activity.show', ':id') }}";
                        showRoute = showRoute.replace(':id', activity.id);
                        resultsHtml +=
                            '<li class="py-2 text-black bg-white"><a class="hover:text-blue-600 hover:font-bold" href="' +
                            showRoute + '">' + activity.name + '</a></li>';
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