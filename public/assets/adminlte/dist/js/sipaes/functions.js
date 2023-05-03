function openModal(modal) {
    modal.modal({ backdrop: "static", keyboard: false, show: true });
}

function closeModal(modal) {
    modal.modal("hide");
}

function saveForm(modal, errorDiv) {
    const form = modal.find("form");
    const formAction = form.attr("action");
    const formMethod = form.attr("method");
    const formData = form.serializeArray();

    let result = false;

    $.ajax({
        url: formAction,
        type: formMethod,
        data: formData,
        async: false,
        success: function (response) {
            showMessageAlert(response.icon, response.title);
            clearErrorInputs(form);
            clearInputs(form);
            removeErrorsDiv(errorDiv);
            removeInputMethod(form);
            closeModal(modal);
            result = true;
        },
        error: function (response) {
            var errors = response.responseJSON.errors;
            clearErrorInputs(form);
            showErrors(errors, errorDiv);
            result = false;
        },
    });

    return result;
}

function editFormMode(modal, route) {
    const form = modal.find("form");

    $.ajax({
        url: route,
        type: "GET",
        success: function (response) {
            clearErrorInputs(form);
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
    divError.html(errorHtml);
}

function addDataInputs(form, data) {
    const formData = form.serializeArray();
    formData.forEach(function (item) {
        var dataInput = $("#" + item.name);
        if (dataInput.hasClass("custom-select")) {
            dataInput.val(data[item.name]).change();
        } else {
            dataInput.val(data[item.name]);
        }
    });
}

function clearErrorInputs(form) {
    const formData = form.serializeArray();
    console.log(formData);
    formData.forEach(function (item) {
        form.find("#" + item.name).removeClass("is-invalid");
    });
}

function clearInputs(form) {
    const formData = form.serializeArray();
    formData.forEach(function (item) {
        var dataInput = $("#" + item.name);
        if (dataInput.hasClass("custom-select")) {
            dataInput.val(-1).change();
        } else {
            dataInput.val("");
        }
    });
}

function removeErrorsDiv(divError) {
    divError.empty();
}

function showMessageAlert(icon, message) {
    Toast.fire({
        icon: icon,
        title: message,
    });
}

function deleteItem(formId, trId) {
    const form = $(formId);
    const formAction = form.attr("action");
    const formMethod = form.attr("method");
    const formData = form.serializeArray();

    const tr = $(trId);

    Swal.fire({
        title: window.translations_messages.confirm_delete,
        showCancelButton: true,
        confirmButtonText: window.translations_button.confirm,
        cancelButtonText: window.translations_button.cancel,
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: formAction,
                type: formMethod,
                data: formData,
                success: function (response) {
                    showMessageAlert(response.icon, response.title);
                    tr.remove();
                },
                error: function (response) {
                    showMessageAlert(response.icon, response.title);
                },
            });
        }
    });
}

function addInputMethod(form, method = "PUT") {
    const escapeValue = unescape(method);
    form.append(
        `<input id='method' name='_method' type='hidden' value='${method}'>`
    );
}

function removeInputMethod(form) {
    const input = form.find("#method");
    if (input) {
        input.remove();
    }
}
