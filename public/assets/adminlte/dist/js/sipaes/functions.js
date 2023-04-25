function saveForm(modalId, errorsId) {
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
    const route = table.data("route");
    const tbody = table.find("tbody").empty();
    $.ajax({
        url: route,
        type: "GET",
        success: function (response) {
            console.log(response);
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
                                        onclick="editWorkExperience(event, '${item.routes.show}')"
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
                    console.log(response);
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
