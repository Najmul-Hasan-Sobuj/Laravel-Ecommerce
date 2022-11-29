/* ------------------------------------------------------------------------------
 *
 *  # Custom JS code
 *
 *  Place here all your custom js. Make sure it's loaded after app.js
 *
 * ------------------------------------------------------------------------------ */

// prevent-multiple-submits disable
(function () {
    $('.from-prevent-multiple-submits').on('submit', function () {
        $('.from-prevent-multiple-submits').attr('disabled', 'true');
    })
})();
// ------------------------------------------------------------------------------ end


//multiple delete data click ina a single button


// /  ### globaly delete data with sweet alert message
$(document).on("click", ".delete", function (e) {
    e.preventDefault();
    var deleteLinkUrl = $(this).attr("href");
    var dataType = $(this).attr("href") ?
        $(this).attr("href") :
        "html";
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    swalInit.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this imaginary file!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",

        preConfirm: function () {
            $.ajax({
                url: deleteLinkUrl,
                type: "POST",
                data: {
                    _method: "DELETE"
                },
                dataType: 'html',
                success: function (data) {
                    var dataError =
                        dataType == "html" ? data.trim() : data.error;
                    if (typeof dataError !== typeof undefined && dataError) {
                        swalInit.fire({
                            title: "Oops...",
                            text: dataError,
                            icon: "error",
                            allowEscapeKey: false,
                            allowEnterKey: false,
                        });
                    } else {
                        swalInit.fire({
                            title: "Deleted!",
                            text: "This data has been deleted!",
                            confirmButtonColor: "#66BB6A",
                            icon: "success",
                            type: "success",
                            preConfirm: function () {
                                location.reload();
                            },
                        });
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    swalInit.fire({
                        title: "Oops...",
                        text: dataError,
                        icon: "error",
                        allowEscapeKey: false,
                        allowEnterKey: false,
                    });
                },
            });
        },
    });
});

// ----------------------------------------------------------------------------------- end
// Defaults sweet alert js
var swalInit = swal.mixin({
    buttonsStyling: false,
    customClass: {
        confirmButton: "btn btn-primary",
        cancelButton: "btn btn-light",
        denyButton: "btn btn-light",
        input: "form-control",
    },
});
// --------------------------------


//multiple delete data click one single button
// $('#multi-delete').on('click', function () {
$(document).on("click", "#multi-delete", function (e) {
    let formId = $(this).attr("formId");
    let multiDeleteLinkUrl = $(this).attr("multiDeleteLinkUrl");

    var rowIds = [];
    $('#' + formId + ' input[name="rowId[]"]:checked').each(function () {
        rowIds[rowIds.length] = (this.checked ? $(this).val() : "");
    });
    console.log('rowIds ', rowIds);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    swalInit.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this imaginary file!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",

        preConfirm: function () {
            $.ajax({
                url: multiDeleteLinkUrl,
                method: "POST",
                data: {
                    'rowIds': rowIds
                },
                dataType: 'json',
                success: function (data) {
                    swalInit.fire({
                        title: "Deleted!",
                        text: "This data has been deleted!",
                        confirmButtonColor: "#66BB6A",
                        icon: "success",
                        type: "success",
                        preConfirm: function () {
                            location.reload();
                        },
                    });
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    swalInit.fire({
                        title: "Oops...",
                        text: "Seems you couldn't submit form for a longtime. Please refresh your form & try again",
                        icon: "error",
                        allowEscapeKey: false,
                        allowEnterKey: false,
                    });
                },
            });
        },
    });
});



//side bar toggle
// function classToggle() {
//     const navs = document.querySelectorAll('.nav-group-sub')

//     navs.forEach(nav => nav.classList.toggle('show'));
// }

// document.querySelector('.nav-item-submenu')
//     .addEventListener('click', classToggle);


//side bar toggle

// $(function () {
//     $('.nav-toggle').on('click', function (e) {
//         $('.sideNav').toggleClass('open');

//         e.stopPropagation();
//         return false;
//     });

//     $('*:not(.nav-toggle)').on('click', function () {
//         $('.sideNav').removeClass('open');
//     });
// });


// $(function () {

//     $('body').on('click', function (event) {
//         if (event.target.className == 'nav-toggle') {
//             $('.sideNav').addClass('open');
//         } else {
//             $('.sideNav').removeClass('open');
//         }
//     });
// });
// ------------------------------end
