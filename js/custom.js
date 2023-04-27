(function ($) {
    "use strict"; // Start of use strict
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });
    /*Loader Javascript
    -------------------*/
    var window_var = $(window);
    window_var.on('load', function () {
        $(".loading").fadeOut("fast");
        $("#snackbar").addClass("show");
    });

    // fullscreen function
    $(".fullscreen").on('click', function () {
        if (document.webkitCurrentFullScreenElement == null) {
            document.documentElement.webkitRequestFullScreen();
        } else {
            document.webkitCancelFullScreen();
        }
    });
    // fullscreen function End

})(jQuery);

$(".btnupd").on('click', function () {
    $.ajax({
        method: "POST",
        url: "get-staff.php",
        dataType: "json",
        data: { "data": this.id },
        success: function (data) {
            $("#updmodal").modal('show');
            $("#ustaff_name").val(data.name);
            $("#uphone").val(data.phone);
            $("#uemail").val(data.email);
            $("#id").val(data.id);
            if (data.role == 'doctor') {
                $("#ustaff_typeD").prop('checked', true);
            }
            else if (data.role == 'receptionist') {
                $("#ustaff_typeR").prop('checked', true);
            }

        },
        error: function () {
            window.alert("Failed");
        }
    });
});

$(".btnnew").on('click', function () {
    $("#newPatient").show();
});
$(".btnnext").on('click', function () {
    $("#newPatient").hide();
    $("#newPatient2").show();
});
$(".btnexist").on('click', function () {
    $("#exiPatient").show();
});
function close1() {
    $("#newPatient").hide();
    $("#newPatient2").hide();
    $("#exiPatient").hide();

}

// custom.js

$(document).ready(function() {
    // Fetch appointment data using AJAX when the page loads
    $.ajax({
        url: 'fetch-appointments.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            // Iterate over each appointment and add a row to the table
            $.each(data, function(index, appointment) {
                var row = '<tr>' +
                    '<td>' + (index + 1) + '</td>' +
                    '<td>' + appointment.name + '</td>' +
                    '<td>' + appointment.gender + '</td>' +
                    '<td>' + appointment.complaint + '</td>' +
                    '<td>' +
                        '<button class=" btn-primary btn-view p-1 border border-dark rounded" data-id="' + appointment.id + '"><a href="in-patient.php?id=' + appointment.id + '">Call In</a></button>' +
                        '<button class="ml-1 btn-danger btn-edit p-1 border border-dark rounded" data-id="' + appointment.id + '"><a href="delete-patient.php?id=' + appointment.id + '">Delete</a></button>' +
                        // '<button class="btn-delete" data-id="' + appointment.ID + '">Delete</button>' +
                    '</td>' +
                '</tr>';
                $('#appointment-table-body').append(row);
            });
        },
        error: function(xhr, status, error) {
            // Handle any errors that occur during the AJAX call
            console.error(error);
        }
    });

    // $('#appointments-table').on('click', '.btn-view', function() {
    //     var appointmentId = $(this).data('id');
    //     console.log(appointmentId);
    //     $.ajax({
    //         url : "fetch-patient-data.php?id="+appointmentId,
    //         method : "GET",
    //         success : function(data) {

    //         }
    //     })
    //     // Implement logic to display appointment edit form in a modal
    // });

    $('#appointments-table').on('click', '.btn-delete', function() {
        var appointmentId = $(this).data('id');
        // Implement logic to delete the appointment and remove it from the table
    });
});
