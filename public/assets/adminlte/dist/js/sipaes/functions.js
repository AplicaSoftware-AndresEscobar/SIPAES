function openModal(modal) {
    modal.modal({ backdrop: "static", keyboard: false, show: true });
}

function closeModal(modal) {
    modal.modal("hide");
}

function saveForm(modal, errorsDiv, table) {
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
            resetTableBody(table);
        },
        error: function (response) {
            var errors = response.responseJSON.errors;
            showErrors(errors, errorsDiv);
        },
    });
}

function editForm(modal, route) {
    const form = modal.find("form");
    const title = modal.find("h5");

    $.ajax({
        url: route,
        type: "GET",
        success: function (response) {
            clearErrorInputs(form);
            title.text(
                window.translations_models.user_work_experience.forms.edit
            );
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
    formData.forEach(function (item) {
        $("#" + item.name).removeClass("is-invalid");
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

function resetTableBody(table) {
    const route = table.data("route");
    const tbody = table.find("tbody").empty();
    $.ajax({
        url: route,
        type: "GET",
        success: function (response) {
            var htmlTd = "";
            response.forEach((item) => {
                htmlTd += `
                    <tr>
                        <td>${item.company}</td>
                        <td>${item.job_title}</td>
                        <td>${item.start_date}</td>
                        <td>${item.end_date}</td>
                        <td>${item.diff}</td>
                        <td>
                            <div class="btn-group">
                                <button type="button"
                                    class="dropdown-toggle btn btn-sm btn-block btn-danger"
                                    data-toggle="dropdown">
                                    <span class="fas fa-cog"></span>
                                </button>
                                <div class="dropdown-menu">
                                    <button type="button"
                                        onclick="openWorkExperienceModal(true, '${item.routes.show}')"
                                        class="dropdown-item">
                                        <i class="fas fa-sm fa-sm fa-edit"></i>
                                        ${window.translations_button["edit"]}
                                    </button>
                                    <form action=""
                                        id="form-work-experience-delete-${item.id}"
                                        method="post">
                                        <input type="hidden" name="_token" value="${window.csrf}">
                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" class="dropdown-item"
                                            onclick="destroy(event, ${item.id}, 'form-work-experience-delete-')">
                                            <i class="fas fa-sm fa-sm fa-trash"></i>
                                            ${window.translations_button["edit"]}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                `;
            });
            tbody.html(htmlTd);
        },
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
