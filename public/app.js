(function (w) {
    var api = "http://localhost:8000/api/", studentUpdateDialog, overlay, studentUpdateForm, studentInsetionForm, studentDataTable, refreshButton;

    // Make it public
    w.Student = {
        get: () => {
            $.get({
                url: `${api}get_all_students`,
                success: (data) => {
                    var studentData = data.data, rows = "";

                    studentData.forEach((element, i) => {
                        rows += `
                            <tr data='${element.student_id}'>
                                <td>${(i + 1)}</td>
                                <td>${element.name}</td>
                                <td>${element.nim}</td>
                                <td>${element.birthday}</td>
                                <td>
                                    <button class="small update">Update</button>
                                    <button class="small delete danger">Delete</button>
                                </td>
                            </tr>
                        `;
                    });

                    studentDataTable.append(`<tbody>${rows}</tbody>`);

                    // Append event listener to all update and delete button
                    var updateButtons = $(".update");

                    $(".delete").each((i, deleteButton) => {
                        $(deleteButton).on("click", function() {
                            Student.delete(this);
                        });

                        // Since the length of both buttons are the same,
                        // we can reuse this loop
                        $(updateButtons[i]).on("click", function() {
                            Student.showUpdateDialog(this.parentNode.parentNode);
                        });
                    });
                }
            });
        },

        refreshDataAndTable: () => {
            $("#student_data tbody").detach();
            Student.get();
        },

        delete: (button) => {
            var tr = $(button).parent().parent(), id = tr.attr("data");

            overlay.show();

            $.post({
                url: `${api}delete_student`,
                data: {
                    student_id: id
                },
                success: () => tr.fadeOut(500, () => tr.detach()),
                complete: () => {
                    overlay.hide();
            }});
        },

        manipulate: (form, action) => {
            var data = {
                action: (action == undefined) ? "insert" : action,
            }, inputs = Object.values(form.getElementsByTagName("input")), inputNames = ["name", "nim", "birthday"], nimRegex = /^\d+$/, errorElement = $((data.action == "insert") ? ".insert_error" : ".update_error").html("");

            inputs.forEach((input, i) => {
                // Validate NIM
                if(i == 1 && !nimRegex.test(input.value)) {
                    errorElement.html("NIM harus dalam format angka");
                    throw new Error("NIM must be int");
                }

                data[inputNames[i]] = input.value;
            });
            
            overlay.show();
            $.post({
                url: `${api}manipulate_students_data`,
                data: data,
                error: (response) => {
                    if(response.status == 409) errorElement.html("NIM sudah pernah digunakan");
                },
                success: Student.refreshDataAndTable,
                complete: () => {
                    overlay.fadeOut();
                    studentUpdateDialog.fadeOut();
                }
            });
        },

        showUpdateDialog: (data) => {
            var tds = data.children, id = $(data).attr("data"), formInputs = studentUpdateForm[0].getElementsByTagName("input");

            overlay.fadeIn();
            studentUpdateDialog.fadeIn();

            /** Loop through <td>'s, exclude "No" and "Opsi"
            * 1 = nama
            * 2 = nim
            * 3 = tanggal lahir
            */
            for(let i = 1; i < tds.length - 1; i ++) {
                var td = tds[i];

                // Append the existing value
                formInputs[i - 1].value = td.innerHTML;
            }
        }
    };

    $(document).ready(() => {

        // Initialize all reference elements
        [studentUpdateDialog, studentInsetionForm, studentDataTable, refreshButton, overlay, studentUpdateForm] = [".student_update_dialog", "#student_insertion_form", "#student_data", "#refresh_button", ".overlay", "#student_update_form"].map((element) => $(element));

        // Fetch students data at startup
        Student.get();
        overlay.hide();

        $(".close_update_dialog").on("click", () => {
            studentUpdateDialog.fadeOut();
            overlay.fadeOut();
        });

        studentInsetionForm.on("submit", function(e) {
            e.preventDefault();
            Student.manipulate(this);
        });

        studentUpdateForm.on("submit", function(e) {
            e.preventDefault();
            Student.manipulate(this, "update");
        });

        refreshButton.on("click", Student.refreshDataAndTable);
    });

})(window);