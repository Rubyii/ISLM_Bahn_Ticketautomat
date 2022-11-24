let autocomplete;
function initAutocomplete() {
    autocomplete = new google.maps.places.Autocomplete(
        document.getElementById('ziel'),
        {
            types: ['train_station'],
            componentRestrictions: {'country': ['DE']},
            fields: ['geometry']
        });
}


