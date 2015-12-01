
function NASort(a, b) {
    if (a.innerHTML == 'NA') {
        return 1;
    }
    else if (b.innerHTML == 'NA') {
        return -1;
    }
    return (a.innerHTML > b.innerHTML) ? 1 : -1;
}

function changeCountry(country_name){
    $('#city').empty();
    $.ajax({
        method: 'post',
        url: 'changeCountry.html',
        data: 'country_name='+country_name,
        success: function(cities){
            $('#city').append(cities);
            $('#city option').sort(NASort).appendTo('#city');
        }
    });
}

function changeCity(city_id){
    document.cookie = 'city_id='+city_id;
    $('#result').empty();
    $.ajax({
        method: 'post',
        url: 'changeCity.html',
        data: 'city_id='+city_id,
        success: function(data){
            $('#result').html(data);
        }
    });
}
