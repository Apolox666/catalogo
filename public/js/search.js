$(document).ready(function() {
    $('#search').on('input', function() {
        var searchText = $(this).val().trim().toLowerCase();
        $('.search').each(function() {
            var name = $(this).find('p').text().trim().toLowerCase();
            if (name.includes(searchText)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
});
