$(document).ready(function () {
    var request;

    $("#form").submit(function (event) {

        event.preventDefault();

        if (request) {
            request.abort();
        }

        var $form = $(this);

        var $inputs = $form.find("input, select, button, textarea");

        var serializedData = $form.serialize();

        $inputs.prop("disabled", true);

        request = $.ajax({
            url: "../Controllers/addProduct.php",
            type: "post",
            data: serializedData
        });

        request.done(function (response, textStatus, jqXHR) {
            console.log("Hooray, it worked!");
            console.log(response);
            document.getElementById('log').innerHTML = response;
        });

        request.fail(function (jqXHR, textStatus, errorThrown) {
            console.error(
                "The following error occurred: " +
                textStatus, errorThrown
            );
        });

        request.always(function () {
            $inputs.prop("disabled", false);
        });

    });
});