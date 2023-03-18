function search_by_ajax(sender) {

    const action = $(sender).data("action");
    const keyword = sender.value;
    if (keyword.length > 2) {
        $('.title-search').removeClass('d-none')
        $.ajax({
            url: action,
            type: "get",
            // dataType: "JSON",
            data: {
                _token: $('[name="_token"]').val(),
                'search': keyword
            },
            success: function (data) {
                var html = '';
                $.each(data.data['location'], function (i, person) {
                    $('.person-bord').empty()
                    html +=
                        `
                         <a href="/event/${person.uuid}/${person.url}"   > <div class="result-search">
                         <div class="result "><img  onerror="this.src='/images/no-image.png'" class="ml-2" src="/image/${person.image}" alt=""> <span>${person.name}  </span></div>
                        </div></a>
					  `
                    if (data.data['persons'].length > 0) {
                        $('.person-bord').append(html)
                    }
                });
                (data.data['location'].length) ? $('.event-bord').append(`<a href="/timeline?word=رویداد&s=all&search=${data.data['search']}"><div class="more-result">نتایج بیشتر</div></a>`) : $('.event-bord').empty().append('<div class="not-result">نتایجی یافت نشد</div>');
            },
            error(error) {
                if (error.status == 422) {
                    // showFormErrors(error);
                    console.log(error);
                }
            },
        });
    }

}
