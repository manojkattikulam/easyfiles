$('[data-toggle="tooltip"]').tooltip();
let urlbase = "http://localhost/efiles/";

function send_mail(id) {



    $.ajax({
        url: urlbase + "Admin_Dashbd/getClientForEmail/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('[name="email"]').val(data.email);
            $('#clientAdminMsg').modal('show');
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert("Error, Updating Data");
        }
    });

}