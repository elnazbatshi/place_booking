


// $('#filter-form').on('submit', function (e) {
//     e.preventDefault();
//     history.replaceState("", "", "?" + $(this).serialize());
//     $('#removeFilter').removeClass("btn-light").addClass("btn-danger");
//     var action = $(this).data('action');
//
//     load(function (){
//     },action)
// });

function load(callback,action) {
    var filter = '';
    if (getAllParam() != null) {
        var filter = getAllParam();
    }
    // $('#orderTable').empty();
    var index = 1;
    $.ajax({
        url: action,
        type: "get",
        data: filter,
        success: function (data) {
            // console.log(data);
            data.data.forEach(function (invoice) {
                /*invoice.orders.forEach(function (order) {

                });*/

                var classStatus = function () {
                    if (invoice.status == 'pending') {
                        return 'btn-dark';
                    } else if (invoice.status == 'completed') {
                        return 'btn-success';
                    } else {
                        return 'btn-danger';
                    }
                }();
                var status = function () {
                    if (invoice.status == 'pending') {
                        return 'منتظر تایید';
                    } else if (invoice.status == 'completed') {
                        return 'تایید شده';
                    } else {
                        return 'مسدود شده';
                    }
                }();
                html +=
                    `<tr>
						<input type="hidden" value="${htmlSpecialChars(JSON.stringify(invoice))}">
	                    <th scope="row">${index++}</th>
	                    <th scope="row">${invoice.id}</th>
	                    <td>${invoice.customer['name']}</td>
	                              <td>
                                 <div class="btn-group ${classStatus}">
                                     <span class="btn btn-sm ${classStatus}">
                                      ${status}
                                     </span>
                                     <button type="button"
                                             class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split"
                                             id="dropdownMenuReference28" data-toggle="dropdown"
                                             aria-haspopup="true" aria-expanded="false"
                                             data-reference="parent">
                                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                              viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                              stroke-width="2" stroke-linecap="round"
                                              stroke-linejoin="round"
                                              class="feather feather-chevron-down">
                                             <polyline points="6 9 12 15 18 9"></polyline>
                                         </svg>
                                     </button>
                                     <div class="dropdown-menu"
                                          aria-labelledby="dropdownMenuReference28">
                                         <button class="dropdown-item statusChanger" data-id="${invoice.id}" data-status="completed"
                                         > تکمیل شده
                                         </button>
                                         <button class="dropdown-item statusChanger" data-id="${invoice.id}"

                                                 data-status="pending"

                                         >منتظر تایید

                                         <button class="dropdown-item statusChanger" data-id="${invoice.id}"
                                                 data-status="cancelled"
                                         >کنسل شده
                                         </button>
                                     </div>
                                 </div>
                             </td>
	                    <td>${invoice.jalali_date}</td>
	                    <td>
	                    <button onclick="showInvoice(this)" data-toggle="modal" data-target="#products" class="btn btn-info">
	                       نمایش
	                    </button>
	                    </td>
	                </tr>`

            });


            $('#orderTable').append(html);
        },
        complete: function () {
            callback();
        },
        error: function (data) {
            console.log(data);
        }
    });
}
function getAllParam(){
    var queryString = location.href.split('#');
    queryString = queryString[0].split('?');
    var query=queryString[1];
    return query;
}
