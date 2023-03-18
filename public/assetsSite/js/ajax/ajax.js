function changeSide(sender) {
    var url = $(sender).data("url");
    var type = $(sender).data("type");
    console.log(url)
    $.ajax({
        url: url,
        type: "get",
        dataType: "JSON",
        success(response) {
            $("#panelContent").empty().html(response['html']);
            $('.tab_panel').removeClass('active-tab')
            $('#' + type).addClass('active-tab')
        },
        error(error) {
            if (error.status == 422) {
                // showFormErrors(error);
                console.log(error);
            }
        },
    });
}

function getTimeDatepicher(sender) {

    var url = $(sender).data("url");
    $.ajax({
        url: url,
        type: "get",
        dataType: "JSON",
        data: {
            date: sender.value,
        },
        success(response) {
            $('.times').empty()
            $('.times').append('<option disabled selected value="0">انتخاب کنید</option>');
            for ( let i = 8; i<= 18; i++) {
                if(response[0]){
                    if( response[0].indexOf(i) != -1){
                        $('.times').append(`<option disabled value="${i}:00:00">${i}:00</option>`);
                    }
                    else {
                        $('.times').append(`<option value="${i}:00:00">${i}:00</option>`);
                    }
                }else{
                    $('.times').append(`<option value="${i}:00:00">${i}:00</option>`);
                }

                // $('.times').append(`<option ${(response[0].indexOf(i) != -1) ? disabled: " "}  value="${i}:00:00">${i}:00</option>`);
            }
        },
        error(error) {
            if (error.status == 422) {
                // showFormErrors(error);
                console.log(error);
            }
        },
    });
}
