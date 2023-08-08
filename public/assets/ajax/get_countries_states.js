$(document).ready(function() {
    // Initialize select2 on the location field
    $('#location').select2();

    $('#type').change(function() {
        var type = $(this).val();
        var locationSelect = $('#location');

        if (type === 'international') {
            // Fetch countries and populate select2
            $.ajax({
                url: '/countries',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    locationSelect.empty();
                    $.each(data, function(key, value) {
                        locationSelect.append(new Option(value.name,
                            value.id));
                    });
                    // Trigger change event to update select2 display
                    locationSelect.trigger('change');
                }
            });
        } else if (type === 'domestic') {
            // Fetch Indian states and populate select2
            $.ajax({
                url: '/states/102', // Replace '1' with the country_id of India in your database
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    locationSelect.empty();
                    $.each(data, function(key, value) {
                        locationSelect.append(new Option(value.name,
                            value.id));
                    });
                    // Trigger change event to update select2 display
                    locationSelect.trigger('change');
                }
            });
        }
    });
});