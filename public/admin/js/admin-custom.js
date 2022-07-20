(function ($) {
    "use strict";

    /** ============ my script ===============**/
    $(document).on("click", "a.delete", function () {
        const selector = $(this);
        Swal.fire({
            title: 'Sure! You want to delete?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete It!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'GET',
                    url: $(this).data("url"),
                    success: function (data) {
                        selector.closest('.removable-item').fadeOut('fast');
                        Swal.fire({
                            title: 'Deleted',
                            html: ' <span style="color:red">Item has been deleted</span> ',
                            timer: 2000,
                            icon: 'success'
                        })
                    }
                })
            }
        })
    });

    $(document).on("click", ".deleteItem", function () {
        let form_id = this.dataset.formid;
        Swal.fire({
            title: 'Sure! You want to delete?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete It!'
        }).then((result) => {
            if (result.value) {
                $("#" + form_id).submit();
            } else if (result.dismiss === "cancel") {
                Swal.fire(
                    "Cancelled",
                    "Your imaginary file is safe :)",
                    "error"
                )
            }
        })
    });

    $(document).ready(function () {
        $(".multiple-basic-single").select2({
            placeholder: "Select Option",
        });
        $(".multiple-select-input").select2({
            tags: true,
            tokenSeparators: [',', ' '],
        })
    });
})(jQuery)
