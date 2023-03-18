function search_by_ajax(sender) {
    const action = $(sender).data("action");

    const keyword = sender.value;

    console.log($(this));
    console.log(keyword, action)
    if (keyword.length > 2) {
        $('.result-box').removeClass('d-none')
        $.ajax({
            url: action,
            type: "get",
            // dataType: "JSON",
            data: {
                _token: $('[name="_token"]').val(),
                'keyword': keyword
            },
            success: function (data) {
                var htmlBarayand = '';
                var htmlSessions = '';
                var htmlMedias = '';
                var htmlDocuments = '';
                var htmlNews = '';

                $.each(data.barayands, function (i, barayand) {
                    $('.barayand-bord').empty()
                    htmlBarayand +=
                        `
                       <a href="/blog/single/${barayand.id}">
                      <div class="result">
                      <img style="width: 50px;height: 50px" src="${barayand.imageIndex}" alt="">
                       <span>${barayand.title.slice(0, 35) + (barayand.title.length > 35 ? "..." : "")}</span>
                      </div></a>
					  `
                    if (data.barayands) {
                        $('.barayand-bord').append(htmlBarayand)
                        $('.barayandCount').empty().append(data.barayandCount)
                        $('.barayand-bord').append(`<a href="/blog/archive/برایند?keyword=${data.keyword}"><div class="not-result">نتایج بیشتر</div></a>`)
                    }
                });
                $.each(data.sessions, function (i, session) {
                    $('.session-bord').empty()
                    htmlSessions +=
                        `
                       <a href="/blog/single/${session.id}">
                      <div class="result">
                      <img style="width: 50px;height: 50px" src="${session.imageIndex}" alt="">
                      <span>${session.title.slice(0, 35) + (session.title.length > 35 ? "..." : "")}</span>
                      </div></a>
					  `
                    if (data.sessions) {
                        $('.session-bord').append(htmlSessions)
                        $('.sessionCount').empty().append(data.sessionCount)
                        $('.session-bord').append(`<a href="/blog/archive/نشست?keyword=${data.keyword}"><div class="not-result">نتایج بیشتر</div></a>`)
                    }
                });
                $.each(data.medias, function (i, media) {
                    $('.media-bord').empty()
                    htmlMedias +=
                        `
                      <a href="/blog/single/${media.id}">
                      <div class="result">
                      <img style="width: 50px;height: 50px" src="${media.imageIndex}" alt="">
                      <span>${media.title.slice(0, 35) + (media.title.length > 35 ? "..." : "")}</span>
                      </div>
                      </a>
					  `
                    if (data.medias) {
                        $('.media-bord').append(htmlMedias)
                        $('.mediaCount').empty().append(data.mediaCount)
                        $('.media-bord').append(`<a href="/blog/archive/گفتمان?keyword=${data.keyword}"><div class="not-result">نتایج بیشتر</div></a>`)
                    }
                });
                $.each(data.documents, function (i, document) {
                    $('.document-bord').empty()
                    htmlDocuments +=
                        `
                       <a href="/blog/single/${document.id}">
                      <div class="result">
                      <img style="width: 50px;height: 50px" src="${document.imageIndex}" alt="">
                      <span>${document.title.slice(0, 35) + (document.title.length > 35 ? "..." : "")}</span>
                      </div></a>
					  `
                    if (data.documents) {
                        $('.document-bord').append(htmlDocuments)
                        $('.documentCount').empty().append(data.documentCount)
                        $('.document-bord').append(`<a href="/blog/archive/اسناد?keyword=${data.keyword}"><div class="not-result">نتایج بیشتر</div></a>`)
                    }
                });
                $.each(data.newses, function (i, news) {
                    $('.news-bord').empty()
                    htmlNews +=
                        `
                       <a href="/blog/single/${news.id}">
                      <div class="result">
                      <img style="width: 50px;height: 50px" src="${news.imageIndex}" alt="">
                      <span>${news.title.slice(0, 35) + (news.title.length > 35 ? "..." : "")}</span>
                      </div></a>
					  `
                    if (data.documents) {
                        $('.news-bord').append(htmlNews)
                        $('.news-bord').append(`<a href="/blog/archive/اخبار?keyword=${data.keyword}"><div class="not-result">نتایج بیشتر</div></a>`)
                    }
                });

                (data.barayands.length) ? " " : $('.barayand-bord').empty().append('<div class="not-result">نتایجی یافت نشد</div>');
                (data.sessions.length) ? " " : $('.session-bord').empty().append('<div class="not-result">نتایجی یافت نشد</div>');
                (data.medias.length) ? " " : $('.media-bord').empty().append('<div class="not-result">نتایجی یافت نشد</div>');
                (data.documents.length) ? " " : $('.document-bord').empty().append('<div class="not-result">نتایجی یافت نشد</div>');
                (data.newses.length) ? " " : $('.news-bord').empty().append('<div class="not-result">نتایجی یافت نشد</div>');

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
