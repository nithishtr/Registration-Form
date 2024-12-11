$(document).ready(function () {
    $("#registrationForm").on("submit", function (event) {
        event.preventDefault();
        const formData = $(this).serialize();
        $.post("process.php", formData, function (response) {
            $("#output").html(response).fadeIn();
        }).fail(function () {
            $("#output").html("<p style='color:red;'>Error processing the request.</p>").fadeIn();
        });
    });
});
