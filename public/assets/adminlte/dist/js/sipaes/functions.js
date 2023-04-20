function saveForm(formId, modalId, errorsId) {
    const form = $(formId);
    const formAction = form.attr("action");
    const formMethod = form.attr("method");
    const formData = form.serializeArray();

    $.ajax({
        url: formAction,
        type: formMethod,
        data: formData,
        success: function (response) {
            console.log(response);
            $(modalId).modal("hide");
            showMessageAlert();
            setTimeout(() => {
                location.reload();
            }, 5000);
        },
        error: function (response) {
            clearInputs(form);
            var errors = response.responseJSON.errors;
            showErrors(errors, errorsId);
        },
    });
}

function showErrors(errors, divError) {
    console.log(errors);
    var errorHtml = "";
    $.each(errors, function (key, value) {
        $("#" + key).addClass("is-invalid");
        errorHtml +=
            "<p class='text-danger font-weight-bold'>" + value[0] + "</p>";
    });
    $(divError).html(errorHtml);
}

function clearInputs(form) {
    const formData = form.serializeArray();
    formData.forEach(function (item) {
        $("#" + item.name).removeClass("is-invalid");
    });
}

function showMessageAlert() {
    Toast.fire({
        icon: "success",
        title: "Lorem ipsum dolor sit amet, consetetur sadipscing elitr.",
    });
}
