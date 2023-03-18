function deleteRoleUI(roleId) {
    $("#role_" + roleId).remove();
}

function deleteMenuItemUI(itemId) {
    $("#menuItem_" + itemId).remove();
}

function deleteMenuList(MenuId) {

    $("#menu_" + MenuId).remove();
}

function deleteUserList(userId) {
    console.log(userId)
    $("#user_" + userId).remove();
}

function deleteCatList(catId) {

    $("#cat_" + catId).remove();
}

function deletePostList(postId) {

    $("#post_" + postId).remove();
}

function deleteSliderList(slideId) {

    $("#slider_" + slideId).remove();
}

function deleteModuleList(moduleId) {

    $("#post_" + moduleId).remove();
}

function deleteCatTypeList(catTypeId) {

    $("#catType_" + catTypeId).remove();
}

function deleteSocialId(socialId) {
    console.log(socialId)
    $("#social_" + socialId).remove();
}

function deleteMessagelist(MessageId) {
    $("#contact_" + MessageId).remove();
}

function deleteLocationList(locId) {
    $("#location_" + locId).remove();
}

//roles/update/{role}
function updateRole(sender) {
    const action = $(sender).data("action");
    const data = {
        role: $("#role").val(),
        permissions: $("#permission").val(),
        _token: $('[name="_token"]').val(),
        methods: 'put',
    };

    $.ajax({
        url: action,
        type: "put",

        dataType: "JSON",
        data: data,

        success(response) {
            if (response.status == true) {
                $("#role").val("");
                $("#permission").val("");
                toastr["success"](response.message);
                setTimeout(function () {
                    location.reload();
                }, 2000);
            } else {
                toastr["error"]('خطا در ارتباط با سرور! دوباره امتحان کنید')
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

//roles/delete/{role}
function deleteRole(sender) {

    var action = $(sender).data("action");
    var roleId = action.substring(action.lastIndexOf('/') + 1);
    swal.fire({
        title: "آیا از حذف این نقش اطمینان دارید؟",
        html: "<small>توجه داشته باشید که حذف نقش باعث حذف دسترسی از مدیران دارای این نقش خواهد شد!</small>",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        cancelButtonText: "انصراف",
        confirmButtonText: "حذف!",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: action,
                dataType: "json",
                type: "delete",
                data: {_token: $('input[name="_token"]').val()},

                success(data) {
                    if (data.status) {
                        toastr["success"]('نقش با موفقیت حذف شد');
                    }
                    deleteRoleUI(roleId);

                },
                complete() {

                },
            });
        }
    });
}

function addNewRole(sender) {

    const action = $(sender).data("action");
    const data = {
        role: $("#roleName").val(),
        permissions: $("#addPermissionToRole").val(),
        _token: $('[name="_token"]').val(),

    };

    $.ajax({
        url: action,
        type: "post",
        dataType: "JSON",
        data: data,

        success(response) {
            if (response.status == true) {
                $("#roleName").val("");
                $("#addPermissionToRole").val("");
                toastr["success"]('نقش جدید با موفقعیت اضافه شد');
                setTimeout(function () {
                    location.reload();
                }, 2000);
            } else {
                toastr["error"]('خطا در ارتباط با سرور! دوباره امتحان کنید')
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


//addItem
$("[data-add-menu-item]").submit(function (e) {
    e.preventDefault();
    var form = $(this);
    var actionUrl = form.attr('action');
    console.log(form.serialize())
    $.ajax({
        type: "POST",
        url: actionUrl,
        data: form.serialize(), // serializes the form's elements.
        success(response) {
            if (response.status) {
                toastr["success"](response.message);
                form.find('.js-items-list').empty().html(response.views);
                $('select[data-menuItem="' + response.menu.id + '"]').empty().append('<option value="">مادر</option>');
                $.each(response.menu.parents, function (id, parent) {
                    $('select[data-menuItem="' + response.menu.id + '"]').append('<option value="' + parent['id'] + '">' + parent['title'] + '</option>');
                });
                // updateAddItemMenuOptions(form, response.items);
            } else {
                toastr["error"](response.message)
            }
        },
        error(error) {
            toastr["error"](error.responseJSON.message);
        },
    });

});

// function updateAddItemMenuOptions(parent, items) {
//     parent.find('[data-repeater-list]').find('[data-repeater-item]:not(:first-of-type)').remove();
//     const repeater = parent.find('[data-repeater-list]').find('[data-repeater-item]');
//     items.forEach(function (item) {
//         const template = `<option value="${item.id}">${item.title}</option>`
//         repeater.find('select').append(template);
//     });
//
//     repeater.find('input.form-control').val('');
//     repeater.find('select').val('');
// }

function deleteItemMenu(sender) {
    var action = $(sender).data("action");
    var menuItemId = action.substring(action.lastIndexOf('/') + 1);
    swal.fire({
        title: "آیا از حذف این منو اطمینان دارید؟",
        html: "<small>توجه داشته باشید که حذف منو باعث حذف این آیتم از منو خواهد شد!</small>",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        cancelButtonText: "انصراف",
        confirmButtonText: "حذف!",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: action,
                dataType: "json",
                type: "delete",
                data: {_token: $('input[name="_token"]').val()},

                success(data) {
                    if (data.status) {
                        toastr["success"]('آیتم منو با موفقیت حذف شد');
                    }
                    deleteMenuItemUI(menuItemId);

                },
                complete() {

                },
            });
        }
    });
}

//action:/manage/menu/updateItemupdateItem/{id}
function updateItemMenu(sender) {

    const parent = $(sender).closest('div.row');
    const action = $(sender).data("action");
    const data = {
        title: $('input[name="title"]', parent).val(),
        link: $('input[name="link"]', parent).val(),
        index: $('input[name="index"]', parent).val(),
        icon: $('input[name="icon"]', parent).val(),
        status: $('input[type="checkbox"]', parent).is(':checked') ? 1 : 0,
        parent_id: $('select[name="parent_id"]', parent).val(),
        _token: $('input[name="_token"]').val(),
        _methods: 'put',
    };


    $.ajax({
        url: action,
        type: "put",
        dataType: "JSON",
        data: data,

        success(response) {
            if (response.status == true) {

                toastr["success"](response.message);
            } else {
                toastr["error"]('خطا در ارتباط با سرور! دوباره امتحان کنید')
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

//menu curd
function addNewMenu(sender) {
    const action = $(sender).data("action");
    const image = $("#image-input").prop('files')[0];
    let formData = new FormData();
    formData.append('description', addDEs.getData());
    formData.append('name', $("#menuName").val());
    formData.append('_token', $('[name="_token"]').val());
    formData.append('image', image);

    $.ajax({
        url: action,
        type: "post",
        dataType: "JSON",
        data: formData,
        contentType: false,
        processData: false,

        success(response) {
            if (response.status == true) {
                $("#menuName").val("");
                toastr["success"]('نقش جدید با موفقعیت اضافه شد');
                setTimeout(function () {
                    location.reload();
                }, 2000);

            } else {
                toastr["error"]('خطا در ارتباط با سرور! دوباره امتحان کنید')
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

function changeStatus(sender) {

    const action = $(sender).data("action");
    const status = $(sender).data("status");
    console.log(status);
    $.ajax({
        url: action,
        type: "put",
        dataType: "JSON",
        data: {
            _token: $('[name="_token"]').val(),
            'status': status
        },
        success(response) {
            if (response.status == true) {
                $(sender).data('status', response.statusValue);
                toastr["success"](response.message);
                if (action.includes("contactUs")) {
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                }
            } else {
                toastr["error"]('خطا در ارتباط با سرور! دوباره امتحان کنید')
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
function updateMenu(sender) {
    const action = $(sender).data("action");

    var image = $("#image_upload_edit").prop('files')[0];
    let formData = new FormData();
    formData.append('name', $("#menuNameEdit").val());
    formData.append('description', editDEs.getData());
    formData.append('_method', 'put');
    if ($("#image_upload_edit").val()) {
        formData.append('logo_image', image);
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: action,
        data: formData,
        method: 'post',
        cache: false,
        processData: false,
        contentType: false,
        success(response) {
            if (response.status == true) {
                $('#menuImageEdit').attr('');
                $('#menuNameEdit').val('')
                toastr["success"](response.message);
                setTimeout(function () {
                    location.reload();
                }, 2000);
            } else {
                toastr["error"]('خطا در ارتباط با سرور! دوباره امتحان کنید')
            }
        },
        error(error) {

            if (error.status == 422) {
                toastr["error"](error.responseJSON.message);
            } else if (error.status == 500) {
                toastr["error"]('خطا ذخیره ');
            }
        },
    });
}

function deleteMenu(sender) {
    var action = $(sender).data("action");
    var menuId = action.substring(action.lastIndexOf('/') + 1);
    console.log(action, menuId)
    swal.fire({
        title: "آیا از حذف این جایگاه اطمینان دارید؟",
        html: "<small>توجه داشته باشید که حذف جایگاه منو احتمالا باعث خرابی قالب خواهد شد!</small>",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        cancelButtonText: "انصراف",
        confirmButtonText: "حذف!",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: action,
                dataType: "json",
                type: "delete",
                data: {_token: $('input[name="_token"]').val()},

                success(data) {
                    if (data.status) {
                        toastr["success"]('جایگاه منو با موفقیت حذف شد');
                    }
                    deleteMenuList(menuId);

                },
                complete() {

                },
            });
        }
    });
}

//user
function addUser(sender) {

    const action = $(sender).data("action");

    const data = {
        name: $("#name").val(),
        password: $("#password").val(),
        email: $("#email").val(),
        roles: $("#addRoleToUser").val(),
        _token: $('[name="_token"]').val(),

    };

    $.ajax({
        url: action,
        type: "post",
        dataType: "JSON",
        data: data,

        success(response) {
            if (response.status == true) {

                $("#name").val("");
                $("#email").val("");
                $("#password").val("");
                $("#addRoleToUser").val("");
                toastr["success"](response.message);
                setTimeout(function () {
                    location.reload();
                }, 2000);
            } else {

                toastr["error"](response.error)
            }
        },
        error(error) {
            toastr["error"](error.responseJSON.message);
        },
    });

}

function updateUser(sender) {

    const action = $(sender).data("action");
    const data = {
        name: $("#nameEdit").val(),
        password: $("#passwordEdit").val(),
        email: $("#emailEdit").val(),
        roles: $("#editRoleToUser").val(),
        _token: $('[name="_token"]').val(),
        _method: 'PUT',

    };
    $.ajax({
        url: action,
        type: "POST",
        dataType: "JSON",
        data: data,

        success(response) {
            if (response.status == true) {
                setTimeout(function () {
                    location.reload();
                }, 1000);
                toastr["success"](response.message);
            } else {
                toastr["error"]('خطا در ارتباط با سرور! دوباره امتحان کنید')
            }
        },
        error(error) {
            if (error.status == 422) {
                // showFormErrors(error);
                toastr["error"](error.responseJSON.message);
            }
        },
    });
}

function deleteUser(sender) {

    var action = $(sender).data("action");
    var userId = action.substring(action.lastIndexOf('/') + 1);

    swal.fire({
        title: "آیا از حذف این کاربر اطمینان دارید؟",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        cancelButtonText: "انصراف",
        confirmButtonText: "حذف!",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: action,
                dataType: "json",
                type: "delete",
                data: {_token: $('input[name="_token"]').val()},

                success(data) {
                    if (data.status) {
                        toastr["success"]('نقش با موفقیت حذف شد');
                    }

                    deleteUserList(userId);
                },
                complete() {

                },
            });
        }
    });
}


//////category post

function addCategoryPost(sender) {
    const action = $(sender).data("action");
    const data = {
        title: $("#title").val(),
        type_id: $("#type").val(),
        img_src: $("#img_src").val(),
        _token: $('[name="_token"]').val(),
    };
    $.ajax({
        url: action,
        type: "post",
        dataType: "JSON",
        data: data,
        success(response) {
            if (response.status == true) {

                $("#title").val("");
                $("#type").val("");

                toastr["success"](response.message);
                setTimeout(function () {
                    location.reload();
                }, 2000);
            } else {

                toastr["error"](response.error)
            }
        },
        error(error) {
            toastr["error"](error.responseJSON.message);
        },
    });
}

function updateCategory(sender) {
    const action = $(sender).attr("data-action");
    const data = {
        title: $("#titleEdit").val(),
        type_id: $("#typeEdit").val(),
        img_src: $("#img_src_edit").val(),
        _token: $('[name="_token"]').val(),
        _method: 'PUT',
    };
    $.ajax({
        url: action,
        type: "PUT",
        dataType: "JSON",
        data: data,
        success(response) {
            if (response.status == true) {
                setTimeout(function () {
                    location.reload();
                }, 1000);
                toastr["success"](response.message);
            } else {
                toastr["error"]('خطا در ارتباط با سرور! دوباره امتحان کنید')
            }
        },
        error(error) {
            if (error.status == 422) {
                // showFormErrors(error);
                toastr["error"](error.responseJSON.message);
            }
        },
    });
}


function deleteCategory(sender) {

    var action = $(sender).data("action");
    var catId = action.substring(action.lastIndexOf('/') + 1);

    swal.fire({
        title: "آیا از حذف این دسته بندی اطمینان دارید؟",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        cancelButtonText: "انصراف",
        confirmButtonText: "حذف!",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: action,
                dataType: "json",
                type: "delete",
                data: {_token: $('input[name="_token"]').val()},

                success(data) {
                    if (data.status) {
                        toastr["success"]('نقش با موفقیت حذف شد');
                    }
                    deleteCatList(catId);

                },
                complete() {

                },
            });
        }
    });
}

function deleteTypeCategory(sender) {

    var action = $(sender).data("action");
    var catTypeId = action.substring(action.lastIndexOf('/') + 1);

    swal.fire({
        title: "آیا از حذف این وع دسته بندی اطمینان دارید؟",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        cancelButtonText: "انصراف",
        confirmButtonText: "حذف!",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: action,
                dataType: "json",
                type: "delete",
                data: {_token: $('input[name="_token"]').val()},

                success(data) {
                    if (data.status) {
                        toastr["success"](' با موفقیت حذف شد');
                    }

                    deleteCatTypeList(catTypeId);
                },
                complete() {

                },
            });
        }
    });
}

$("#formGallery").submit(function (e) {

    e.preventDefault();
    var form = $(this);
    let formData = new FormData();

    var action = form.attr('data-action');
    var dataType = form.attr('data-type');
    var method = (dataType == 'update') ? 'PUT' : 'POST';
    form.serializeArray().forEach(function (item, key) {
        formData.append(item.name, item.value);
    });
    if (dataType === "update") formData.append('_method', 'PUT');

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: action,
        type: "POST",
        dataType: "JSON",
        data: formData,
        contentType: false,
        processData: false,
        beforeSend() {
            $('[type="submit"]').prop('disabled', true);
        },
        success(response) {
            if (response.status) {
                location.href = '/manage/gallery';
            } else {
                toastr["error"](response.message)
            }
        },
        error(error) {
            toastr["error"](error.responseJSON.message);
        },
        complete() {
            $('[type="submit"]').prop('disabled', false);
        }
    });

});
//////slider
$("#formSlide").submit(function (e) {

    e.preventDefault();
    var form = $(this);
    let formData = new FormData();

    var action = form.attr('data-action');
    var dataType = form.attr('data-type');
    var method = (dataType == 'update') ? 'PUT' : 'POST';
    formData.append('content', theEditor.getData());
    form.serializeArray().forEach(function (item, key) {
        formData.append(item.name, item.value);
    });
    if (dataType === "update") formData.append('_method', 'PUT');

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: action,
        type: "POST",
        dataType: "JSON",
        data: formData,
        contentType: false,
        processData: false,
        beforeSend() {
            $('[type="submit"]').prop('disabled', true);
        },
        success(response) {
            if (response.status) {
                location.href = '/manage/slider';
            } else {
                toastr["error"](response.message)
            }
        },
        error(error) {
            toastr["error"](error.responseJSON.message);
        },
        complete() {
            $('[type="submit"]').prop('disabled', false);
        }
    });

});

function deleteSlider(sender) {

    var action = $(sender).data("action");
    var sliderId = action.substring(action.lastIndexOf('/') + 1);

    swal.fire({
        title: "آیا از حذف این اسلایدر اطمینان دارید؟",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        cancelButtonText: "انصراف",
        confirmButtonText: "حذف!",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: action,
                dataType: "json",
                type: "delete",
                data: {_token: $('input[name="_token"]').val()},

                success(data) {
                    if (data.status) {
                        toastr["success"]('اسلایدر با موفقیت حذف شد');
                    }
                    deleteSliderList(sliderId);

                },
                complete() {

                },
            });
        }
    });
}

//////MultiMorph
$("#MultiMorphformPost").submit(function (e) {

    e.preventDefault();
    var form = $(this);
    let formData = new FormData();

    var action = form.attr('data-action');
    var dataType = form.attr('data-type');
    var dataCType = form.attr('data-ctype');
    var method = (dataType == 'update') ? 'PUT' : 'POST';
    formData.append('files', $('#fileRelated').val().replace(/,\s*$/, ""));
    formData.append('_token', $('[name="_token"]').val());
    formData.append('categoryType', form.attr('data-ctype'));
    formData.append('content', theEditor.getData());
    formData.append('semiContent', semicontentEditor.getData());
    if (dataType === "update") formData.append('_method', 'PUT');
    form.serializeArray().forEach(function (item, key) {
        if (item.name === "files") {
            formData.append(item.name, $('#fileRelated').val().replace(/,\s*$/, ""));
        } else {
            formData.append(item.name, item.value);
        }
    });
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: action,
        type: "POST",
        dataType: "JSON",
        data: formData,
        contentType: false,
        processData: false,
        beforeSend() {
            $('[type="submit"]').prop('disabled', true);
        },
        success(response) {
            if (response.status) {
                location.href = '/manage/multiMorphPost?type=' + dataCType;
            } else {
                toastr["error"](response.message)
            }
        },
        error(error) {

            if (error.status == 422) {
                toastr["error"](error.responseJSON.message);
            } else {
                toastr["error"]('خطا ذخیره اطلاعات');
            }
        },
        complete() {
            $('[type="submit"]').prop('disabled', false);
        }
    });

});

function deleteMultiMorphformPost(sender) {

    var action = $(sender).data("action");
    var postId = action.substring(action.lastIndexOf('/') + 1);

    swal.fire({
        title: "آیا از حذف این پست اطمینان دارید؟",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        cancelButtonText: "انصراف",
        confirmButtonText: "حذف!",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: action,
                dataType: "json",
                type: "delete",
                data: {_token: $('input[name="_token"]').val()},

                success(data) {
                    if (data.status) {
                        toastr["success"]('پست با موفقیت حذف شد');
                    }
                    deletePostList(postId);

                },
                complete() {

                },
            });
        }
    });
}

function changeStatusMultiMorphformPost(sender) {

    var status = $(sender).val();

    const action = $(sender).data("action");


    $.ajax({
        url: action,
        type: "put",
        dataType: "JSON",
        data: {
            _token: $('[name="_token"]').val(),
            'status': status
        },
        success(response) {
            if (response.status == true) {
                $(sender).data('status', response.statusValue);
                toastr["success"](response.message);

            } else {
                toastr["error"]('خطا در ارتباط با سرور! دوباره امتحان کنید')
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

function changePrivacyMultiMorphformPost(sender) {

    var privacy = $('#privacy').val();

    const action = $(sender).data("action");


    $.ajax({
        url: action,
        type: "put",
        dataType: "JSON",
        data: {
            _token: $('[name="_token"]').val(),
            'privacy': privacy
        },
        success(response) {
            if (response.status == true) {
                $(sender).data('status', response.statusValue);
                toastr["success"](response.message);

            } else {
                toastr["error"]('خطا در ارتباط با سرور! دوباره امتحان کنید')
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

//////post
$("#formPost").submit(function (e) {

    e.preventDefault();
    var form = $(this);
    let formData = new FormData();

    var action = form.attr('data-action');
    var dataType = form.attr('data-type');
    var method = (dataType == 'update') ? 'PUT' : 'POST';
    if (dataType === "update") formData.append('_method', 'PUT');

    formData.append('files', $('#fileRelated').val().replace(/,\s*$/, ""));

    formData.append('_token', $('[name="_token"]').val());
    formData.append('content', theEditor.getData());
    formData.append('semiContent', semicontentEditor.getData());


    form.serializeArray().forEach(function (item, key) {
        if (item.name === "files") {
            formData.append(item.name, $('#fileRelated').val().replace(/,\s*$/, ""));
        } else {
            formData.append(item.name, item.value);
        }
    });

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: action,
        type: "POST",
        dataType: "JSON",
        data: formData,
        contentType: false,
        processData: false,
        beforeSend() {
            $('[type="submit"]').prop('disabled', true);
        },
        success(response) {
            if (response.status) {
                location.href = '/manage/post';
            } else {
                toastr["error"](response.message)
            }
        },
        error(error) {
            toastr["error"](error.responseJSON.message);
        },
        complete() {
            $('[type="submit"]').prop('disabled', false);
        }
    });

});


function deletePost(sender) {

    var action = $(sender).data("action");
    var postId = action.substring(action.lastIndexOf('/') + 1);

    swal.fire({
        title: "آیا از حذف این پست اطمینان دارید؟",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        cancelButtonText: "انصراف",
        confirmButtonText: "حذف!",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: action,
                dataType: "json",
                type: "delete",
                data: {_token: $('input[name="_token"]').val()},

                success(data) {
                    if (data.status) {
                        toastr["success"]('پست با موفقیت حذف شد');
                    }
                    deletePostList(postId);

                },
                complete() {

                },
            });
        }
    });
}

function changeStatusPost(sender) {
    var status = $(sender).val();
    const action = $(sender).data("action");
    $.ajax({
        url: action,
        type: "put",
        dataType: "JSON",
        data: {
            _token: $('[name="_token"]').val(),
            'status': status
        },
        success(response) {
            if (response.status == true) {
                $(sender).data('status', response.statusValue);
                toastr["success"](response.message);
                if (action.includes("order")) {
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                }
            } else {
                toastr["error"]('خطا در ارتباط با سرور! دوباره امتحان کنید')
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

function changePrivacyPost(sender) {

    var privacy = $(sender).val();
    const action = $(sender).data("action");
    $.ajax({
        url: action,
        type: "put",
        dataType: "JSON",
        data: {
            _token: $('[name="_token"]').val(),
            'privacy': privacy
        },
        success(response) {
            if (response.status == true) {
                $(sender).data('status', response.statusValue);
                toastr["success"](response.message);

            } else {
                toastr["error"]('خطا در ارتباط با سرور! دوباره امتحان کنید')
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


///typeCategory
$(document).ready(function () {
    $("#addTypeCatForm").submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var action = form.data('action');
        let formData = new FormData();
        formData.append('desc', catTextEditor.getData());
        form.serializeArray().forEach(function (item, key) {
            formData.append(item.name, item.value);
        });
        formData.append('_token', $('[name="_token"]').val());
        $.ajax({
            url: action,
            type: "post",
            dataType: "JSON",
            data: formData,
            contentType: false,
            processData: false,
            success(response) {
                if (response.status == true) {
                    toastr["success"](response.message);
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                } else {
                    toastr["error"]('خطا در ارتباط با سرور! دوباره امتحان کنید')
                }
            },
            error(error) {
                if (error.status == 422) {

                    toastr["error"](error.responseJSON.message);
                }
            },
        });
    });
});
$(document).ready(function () {
    $("#updateCatTypeForm").submit(function (e) {
        e.preventDefault();
        var form = $(this);

        var action = form.data('action');
        let formData = new FormData();
        formData.append('desc', updateEditor.getData());
        // formData.append('name', $('#titleEdit').val());
        // formData.append('type', $('#typeEdit').val());
        // formData.append('image', $('#image_edit').val());
        form.serializeArray().forEach(function (item, key) {
            formData.append(item.name, item.value);
        });
        formData.append('_token', $('[name="_token"]').val());
        formData.append('_method', 'PUT');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: action,
            type: "POST",
            dataType: "JSON",
            data: formData,
            contentType: false,
            processData: false,
            success(response) {
                if (response.status == true) {
                    toastr["success"](response.message);
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                } else {
                    toastr["error"]('خطا در ارتباط با سرور! دوباره امتحان کنید')
                }
            },
            error(error) {
                if (error.status == 422) {

                    toastr["error"](error.responseJSON.message);
                }
            },
        });
    });
});
$("#formModule").submit(function (e) {

    e.preventDefault();
    var form = $(this);
    let formData = new FormData();

    var action = form.attr('data-action');

    var dataType = form.attr('data-type');

    var method = (dataType == 'update') ? 'PUT' : 'POST';

    formData.append('_token', $('[name="_token"]').val());
    formData.append('content', theEditor.getData());
    if (dataType === "update") formData.append('_method', 'PUT');

    form.serializeArray().forEach(function (item, key) {
        formData.append(item.name, item.value);
    });
    console.log(formData)
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: action,
        type: 'post',
        dataType: "JSON",
        data: formData,
        contentType: false,
        processData: false,
        beforeSend() {
            $('[type="submit"]').prop('disabled', true);
        },
        success(response) {
            if (response.status) {
                location.href = '/manage/module';
            } else {
                toastr["error"](response.message)
            }
        },
        error(error) {
            toastr["error"](error.responseJSON.message);
        },
        complete() {
            $('[type="submit"]').prop('disabled', false);
        }
    });

});

function deleteModule(sender) {

    var action = $(sender).data("action");
    var moduleId = action.substring(action.lastIndexOf('/') + 1);

    swal.fire({
        title: "آیا از حذف این ماژول اطمینان دارید؟",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        cancelButtonText: "انصراف",
        confirmButtonText: "حذف!",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: action,
                dataType: "json",
                type: "delete",
                data: {_token: $('input[name="_token"]').val()},

                success(data) {
                    if (data.status) {
                        toastr["success"]('ماژول     با موفقیت حذف شد');
                    }
                    deleteModuleList(moduleId);

                },
                complete() {

                },
            });
        }
    });
}

$(".addSettingForm").submit(function (e) {
    e.preventDefault();
    var form = $(this);
    var type = $(this).data('type');
    var action = form.attr('action');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "POST",
        url: action,
        data: form.serialize() + '&type=' + type, // serializes the form's elements.
        success(response) {
            if (type == 'social') {
                console.log('social')
                $("#social-table").empty().append(response['html']);
            }
            toastr["success"]('با موفقعیت ثبت شد');
        },
        error(error) {
            toastr["error"](error.responseJSON.message);
        },
    });
});

function updateSocial(sender) {
    const action = $(sender).data("action");

    const data = {
        name: $("#update-name").val(),
        address: $("#update-value").val(),
        id: $("#id").val(),

        _token: $('[name="_token"]').val(),
        methods: 'put',
    };

    $.ajax({
        url: action,
        type: "put",
        dataType: "JSON",
        data: data,
        id: data,

        success(response) {
            if (response.status == true) {
                $("#update-name").val("");
                $("#update-value").val("");
                toastr["success"](response.message);
                setTimeout(function () {
                    location.reload();
                }, 1000);
            } else {
                toastr["error"]('خطا در ارتباط با سرور! دوباره امتحان کنید')
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

function deleteSocial(sender) {

    var action = $(sender).data("action");
    var socialId = action.substring(action.lastIndexOf('/') + 1);
    swal.fire({
        title: "آیا از حذف این شبکه اجتماعی اطمینان دارید؟",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        cancelButtonText: "انصراف",
        confirmButtonText: "حذف!",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: action,
                dataType: "json",
                type: "delete",
                data: {_token: $('input[name="_token"]').val()},

                success(data) {
                    if (data.status) {
                        toastr["success"]('نقش با موفقیت حذف شد');
                    }
                    deleteSocialId(socialId);

                },
                complete() {

                },
            });
        }
    });
}

function updateKeyword(sender) {

    const action = $(sender).attr("data-action");

    const data = {
        tags: $('#tagsKeyword').val(),

        _token: $('[name="_token"]').val(),
        _method: 'PUT',

    };
    $.ajax({
        url: action,
        type: "PUT",
        dataType: "JSON",
        data: data,

        success(response) {
            if (response.status == true) {
                setTimeout(function () {
                    location.reload();
                }, 1000);
                toastr["success"](response.message);
            } else {
                toastr["error"]('خطا در ارتباط با سرور! دوباره امتحان کنید')
            }
        },
        error(error) {
            if (error.status == 422) {
                // showFormErrors(error);
                toastr["error"](error.responseJSON.message);
            }
        },
    });
}

function deleteMessage(sender) {
    var action = $(sender).data("action");
    var MessageId = action.substring(action.lastIndexOf('/') + 1);
    console.log(action, MessageId)
    swal.fire({
        title: "آیا از حذف این جایگاه اطمینان دارید؟",
        html: "<small>توجه داشته باشید که حذف جایگاه پیام احتمالا باعث خرابی قالب خواهد شد!</small>",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        cancelButtonText: "انصراف",
        confirmButtonText: "حذف!",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: action,
                dataType: "json",
                type: "delete",
                data: {_token: $('input[name="_token"]').val()},

                success(data) {
                    if (data.status) {
                        toastr["success"]('پیام موفقیت حذف شد');
                    }
                    deleteMessagelist(MessageId);

                },
                complete() {

                },
            });
        }
    });
}

//add info about us
$("#addInfoForm").submit(function (e) {
    e.preventDefault();
    var form = $(this);
    var action = form.attr('action');
    let formData = new FormData();
    formData.append('description', aboutUsEditor.getData());
    form.serializeArray().forEach(function (item, key) {
        formData.append(item.name, item.value);
    });
    formData.append('_token', $('[name="_token"]').val());
    $.ajax({
        url: action,
        type: "post",
        dataType: "JSON",
        data: formData,
        contentType: false,
        processData: false,

        success(response) {
            console.log('ddd')
            if (response.status == true) {
                toastr["success"]('نقش جدید با موفقعیت اضافه شد');
                $("#info-table").empty().append(response['html']);

            } else {
                toastr["error"]('خطا در ارتباط با سرور! دوباره امتحان کنید')
            }
        },
        error(error) {
            if (error.status == 422) {
                // showFormErrors(error);
                console.log(error);
            }
        },
    });
});
$(document).ready(function () {
    $("#addSubject").submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var action = form.data('action');
        let formData = new FormData();
        console.log(subjectEditor.getData());
        formData.append('content', subjectEditor.getData());
        form.serializeArray().forEach(function (item, key) {
            formData.append(item.name, item.value);
        });
        formData.append('_token', $('[name="_token"]').val());
        $.ajax({
            url: action,
            type: "post",
            dataType: "JSON",
            data: formData,
            contentType: false,
            processData: false,

            success(response) {
                console.log('ddd')
                if (response.status == true) {
                    toastr["success"]('نقش جدید با موفقعیت اضافه شد');


                } else {
                    toastr["error"]('خطا در ارتباط با سرور! دوباره امتحان کنید')
                }
            },
            error(error) {
                if (error.status == 422) {

                    toastr["error"](error.responseJSON.message);
                }
            },
        });
    });
});
//location js
$("#formLocation").submit(function (e) {

    e.preventDefault();
    var form = $(this);
    let formData = new FormData();

    var dataType = form.attr('data-type');
    // var method = (dataType == 'update') ? 'PUT' : 'POST';
    if (dataType === "update") formData.append('_method', 'PUT');
    var action = form.attr('data-action');
    formData.append('files', $('#fileRelated').val().replace(/,\s*$/, ""));
    formData.append('desc', theEditor.getData());
    formData.append('_token', $('[name="_token"]').val());
    if (dataType === "update") formData.append('_method', 'PUT');
    form.serializeArray().forEach(function (item, key) {
        formData.append(item.name, item.value);
    });

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: action,
        type: "POST",
        dataType: "JSON",
        data: formData,
        contentType: false,
        processData: false,
        // beforeSend() {
        //     $('[type="submit"]').prop('disabled', true);
        // },
        success(response) {
            if (response.status) {
                toastr["success"](response.message);
                location.href = '/manage/location';
            } else {
                toastr["error"]('خطا ذخیره سازی');
            }
        },
        error(error) {
            toastr["error"](response);
        },
        complete() {
            $('[type="submit"]').prop('disabled', false);
        }
    });

});

function showLocation(sender) {
    const action = $(sender).data("action");
    $.ajax({
        url: action,
        type: "get",
        dataType: "JSON",
        data: {
            _token: $('[name="_token"]').val(),
            'status': name
        },
        success(response) {
            $('#nameShow').empty();
            $('#descShow').empty();
            $('.icons-dl').empty();
            $('.set-status').empty();

            if (response.location.status == '1' ? $('.set-status').addClass('bg-success').html("فعال") : $('.set-status').addClass('bg-danger').html('غیر فعال'))

                response.location.video.forEach(function (item, key) {
                    $('.icons-dl').append(`<video style="margin-inline: 5px" width="220" height="140" controls> <source src="${item}" type="video/mp4"></video>`);
                });
            response.location.files.forEach(function (item, key) {
                $('.icons-dl').append(`<iframe style="margin-inline: 5px" src="${item}" width="50" height="50"></iframe>`);
            });
        },
        error(error) {
            toastr["error"](response);
        },
        complete() {
            $('[type="submit"]').prop('disabled', false);
        }
    });


}

function deleteLocation(sender) {

    var action = $(sender).data("action");
    var locId = action.substring(action.lastIndexOf('/') + 1);

    swal.fire({
        title: "آیا از حذف این مکان اطمینان دارید؟",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        cancelButtonText: "انصراف",
        confirmButtonText: "حذف!",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: action,
                dataType: "json",
                type: "delete",
                data: {_token: $('input[name="_token"]').val()},

                success(data) {
                    if (data.status) {
                        toastr["success"]('مکان با موفقیت حذف شد');
                    }
                    deleteLocationList(locId);

                },
                complete() {

                },
            });
        }
    });
}

// aad customer


function addCustomer(sender) {

    console.log($("#password").val());
    const action = $(sender).data("action");
    const data = {
        name: $("#name").val(),
        email: $("#email").val(),
        phone: $("#phone").val(),
        mobile_number: $("#mobile_number").val(),
        department: $("#department").val(),
        personal_id: $("#personal_id").val(),
        password: $("#password").val(),
        _token: $('[name="_token"]').val(),
    };
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: action,
        type: "post",
        dataType: "JSON",
        data: data,

        success(response) {
            if (response.status == true) {
                $("#name").val('');
                $("#email").val("");
                $("#phone").val('');
                $("#mobile_number").val('');
                $("#department").val('');
                $("#personal_id").val('');
                $("#password").val('');
                toastr["success"](response.message);
                setTimeout(function () {
                    location.reload();
                }, 2000);
            } else {

                toastr["error"](response.error)
            }
        },
        error(error) {
            toastr["error"](error.responseJSON.message);
        },
    });

}

function deleteCustomer(sender) {
    var action = $(sender).data("action");
    var userId = action.substring(action.lastIndexOf('/') + 1);
    swal.fire({
        title: "آیا از حذف این کاربر اطمینان دارید؟",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        cancelButtonText: "انصراف",
        confirmButtonText: "حذف!",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: action,
                dataType: "json",
                type: "delete",
                data: {_token: $('input[name="_token"]').val()},

                success(data) {
                    if (data.status) {
                        toastr["success"]('نقش با موفقیت حذف شد');
                    }

                    deleteUserList(userId);
                },
                complete() {

                },
            });
        }
    });
}


function updateCustomer(sender) {

    const action = $(sender).data("action");
    const data = {
        name: $('#name_edit').val(),
        email: $('#email_edit').val(),
        mobile_number: $('#mobile_edit').val(),
        phone: $('#phone_edit').val(),
        personal_id: $('#personalId_edit').val(),
        department: $('#department_edit').val(),
        password: $('#password_edit').val(),
        _token: $('[name="_token"]').val(),
        _method: 'PUT',
    };
    $.ajax({
        url: action,
        type: "POST",
        dataType: "JSON",
        data: data,

        success(response) {
            if (response.status == true) {
                setTimeout(function () {
                    location.reload();
                }, 1000);
                toastr["success"](response.message);
            } else {
                toastr["error"]('خطا در ارتباط با سرور! دوباره امتحان کنید')
            }
        },
        error(error) {
            if (error.status == 422) {
                // showFormErrors(error);
                toastr["error"](error.responseJSON.message);
            }
        },
    });
}
