$(document).ready(function() {
    $('#startingPriceCheckbox').change(function() {
        if ($(this).is(':checked')) {
            $('#startingPriceInput').removeClass('d-none');
        } else {
            $('#startingPriceInput').addClass('d-none');
        }
    });

    $('#dayNightCheckbox').change(function() {
        if ($(this).is(':checked')) {
            $('#dayNightInputs').removeClass('d-none');
        } else {
            $('#dayNightInputs').addClass('d-none');
        }
    });
});