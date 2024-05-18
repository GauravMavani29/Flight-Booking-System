(function ($) {
    "use strict";
    var FLIGHT = FLIGHT || {};
    FLIGHT.extra = {
        deleteConfirm: function () {
            $(".confirm-delete").click(function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var url = $(this).data("href");
                        $.ajax({
                            type: 'GET',
                            url: url,
                            success: function (data) {
                                Swal.fire(
                                    'Deleted!',
                                    'Deleted successful.',
                                    'success'
                                );
                                console.log(data);
                                $('#row-' + data.id).remove();
                            }
                        });
                    }
                })
            });
        },
        fillSelectValue: function () {
            $("#fillSelect").on("change", function () {
                var value = $(this).val();
                $("#fillSelectValue").val(value);
            });
        }

    }

    FLIGHT.extra.deleteConfirm();
    FLIGHT.extra.fillSelectValue();

})(jQuery);