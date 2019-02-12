$('[data-toggle="tooltip"]').tooltip();


function send_mail(id) {

    $.ajax({
        url: "Admin_Dashbd/getClientForEmail/" + id,
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