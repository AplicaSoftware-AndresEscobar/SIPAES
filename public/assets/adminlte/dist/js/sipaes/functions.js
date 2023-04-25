function saveForm(modalId, errorsId, tableId) {
    const modal = $(modalId);
    const form = modal.find("form");
    const formAction = form.attr("action");
    const formMethod = form.attr("method");
    const formData = form.serializeArray();

    $.ajax({
        url: formAction,
        type: formMethod,
        data: formData,
        success: function (response) {
            modal.modal("hide");
            showMessageAlert(response.icon, response.title);
        },
        error: function (response) {
            clearInputs(form);
            var errors = response.responseJSON.errors;
            showErrors(errors, errorsId);
        },
    });
}
function editForm(modalId, route) {
    const modal = $(modalId);
    const form = modal.find("form");

    $.ajax({
        url: route,
        type: "GET",
        success: function (response) {
            modal.modal("show");
            addDataInputs(form, response);
        },
    });
}

function showErrors(errors, divError) {
    var errorHtml = "";
    $.each(errors, function (key, value) {
        $("#" + key).addClass("is-invalid");
        errorHtml +=
            "<p class='text-danger font-weight-bold'>" + value[0] + "</p>";
    });
    $(divError).html(errorHtml);
}

function addDataInputs(form, data) {
    const formData = form.serializeArray();
    formData.forEach(function (item) {
        var dataInput = $("#" + item.name);
        if (dataInput.hasClass("custom-select")) {
            console.log(data);
            dataInput.val(data[item.name]).change();
        } else {
            dataInput.val(data[item.name]);
        }
    });
}

function clearInputs(form) {
    const formData = form.serializeArray();
    formData.forEach(function (item) {
        $("#" + item.name).removeClass("is-invalid");
    });
}

function showMessageAlert(icon, message) {
    Toast.fire({
        icon: icon,
        title: message,
    });
}

function resetTableBody(tableId) {
    const table = $(tableId);
}
