$(document).ready(function() {
    $('#time_type').on('change', function() {
        var selected = $(this).val();
        if (selected === 'hours') {
            $('#time_hours').show();
            $('#time_days').hide();
        } else if (selected === 'days') {
            $('#time_hours').hide();
            $('#time_days').show();
        } else {
            $('#time_hours').hide();
            $('#time_days').hide();
        }
    });
});