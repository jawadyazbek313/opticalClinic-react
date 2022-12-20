function deleteMe(id) {
    let _token = $('meta[name="csrf-token"]').attr("content");
    $.ajax({
        url: "/appointment/" + id,
        type: "DELETE",
        data: {
            _token: _token,
            id: id
        },
        success: function(response) {
            location.reload();
            $("#confirm-delete").modal("hide");
            toastr.options = {
                closeButton: true,
                progressBar: true,
                positionClass: "toast-bottom-center"
            };
            toastr.success(response["success"]);

            $.ajax({
                url: "/go/fetch_data/?page=" + 1,
                success: function(data) {
                    $("#ContentHere").html("" + data + "");
                    $('[data-toggle="tooltip"]').tooltip();
                    $('[data-toggle="popover"]').popover();
                    $(".btnAbort").click(function(event) {
                        let appointment_id = $(this).attr("data-appointmentid");
                        $("input[name=appointmentidtrash]").val(appointment_id);

                        $("#confirm-delete").modal("show");
                    });
                    $(".OpenModal").click(function(event) {
                        $("#myModal").modal("show");
                        var pat_id = $(this).attr("data-patient_id");
                        var app_id = $(this).attr("data-appointment_id");
                        $("input[name=patient_id]").val(pat_id);
                        $("input[name=appointment_id]").val(app_id);
                    });
                }
            });
        }
    });
}

function deleteAppointment(id) {
    let _token = $('meta[name="csrf-token"]').attr("content");
    $.ajax({
        url: "/appointment/" + id,
        type: "DELETE",
        data: {
            _token: _token,
            id: id
        },
        success: function(response) {
            location.reload();
            $("#confirm-delete").modal("hide");
            toastr.options = {
                closeButton: true,
                progressBar: true,
                positionClass: "toast-bottom-center"
            };
            toastr.success(response["success"]);
            location.reload();
        }
    });
}
