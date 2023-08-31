window.onload = function () {
    diplayData();
};
//-------------- function search -----------
function searchTeacher() {
    var searchTerm = document.getElementById("searchTeacherIN").value.trim();
    if (searchTerm !== "") {
        // استدعاء الدالة لجلب نتائج البحث من قاعدة البيانات
        diplayData(searchTerm);
    } else {
        // إذا كان حقل البحث فارغًا، عرض الجدول بدون تصفية
        diplayData();
    }
}

//------------ function to selectAll -------
function selectAllCheckboxes() {
    var mainCheckbox = document.querySelector('#main-checkbox');
    var checkboxes = document.querySelectorAll('.delete-checkbox');

    // تحديد جميع الcheckboxes عند تحديد checkbox الرئيسي
    if (mainCheckbox.checked) {
        checkboxes.forEach(function (checkbox) {
            checkbox.checked = true;
        });
    } else {
        // إلغاء تحديد جميع الcheckboxes عند إلغاء تحديد checkbox الرئيسي
        checkboxes.forEach(function (checkbox) {
            checkbox.checked = false;
        });
    }
}
//-------- function hidden massage-------
function showAlert(ClassName) {
    var alertMessage = document.getElementById(ClassName);
    alertMessage.style.display = 'block'; // عرض الرسالة
    setTimeout(function () {
        alertMessage.style.display = 'none'; // إخفاء الرسالة بعد 3 ثوانٍ (يمكنك تعديل الزمن حسب رغبتك)
    }, 3000); // 3000 ميلي ثانية = 3 ثواني
}

// -------- add new student -------------
function addTeacher() {
    submitButtonClick = "true";
    $data_joins = new Date().toISOString().slice(0, 16);
    var studentData = {
        name: document.getElementById('nameteacher').value,
        birth: document.getElementById('birthteacher').value,
        gender: document.getElementById('genderteacher').value,
        email: document.getElementById('emailteacher').value,
        password: document.getElementById('passwordteacher').value,
        phone: document.getElementById('phoneteacher').value,
        data_join: $data_joins,
        // Include the hidden field in the data sent to the server
        submitButtonClicked: submitButtonClick
    };

    // إرسال بيانات الطالب عبر Ajax إلى الخادم
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "./function/teacherFunction.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                console.log(xhr.responseText);
                // ا  بعد نجاح الإضافة
                var response = JSON.parse(xhr.responseText);
                if (response.status === 'success') {
                    document.getElementById('result').innerHTML = '<div class="alert alert-success" role="alert">' + response.message + '</div>';
                    document.getElementById('nameteacher').value = "";
                    document.getElementById('birthteacher').value = "";
                    document.getElementById('genderteacher').value = "";
                    document.getElementById('emailteacher').value = "";
                    document.getElementById('passwordteacher').value = "";
                    document.getElementById('phoneteacher').value = "";
                    diplayData();
                } else {
                    document.getElementById('result').innerHTML = '<div class="alert alert-danger" role="alert">' + response.message + '</div>';
                }
            } else {
                console.log("حدث خطأ في الإضافة:", xhr.status);
            }
        }

    };
    xhr.send(JSON.stringify(studentData));
    showAlert('result');
}

//------- function diplayData student----
function diplayData(search) {
    var diplayData = {
        diplayDataSend: "true",
        searched: search,
    }
    console.log(search);
    // إرسال بيانات الطالب عبر Ajax إلى الخادم
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "./function/teacherFunction.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {

                // ا  بعد نجاح الإضافة
                var response = JSON.parse(xhr.responseText);

                if (response.status === 'success') {
                    document.getElementById('data').innerHTML = response.message;
                } else {
                    document.getElementById('resultDelete').innerHTML = '<div class="alert alert-danger" role="alert">' + response.message + '</div>';
                    showAlert('resultDelete');
                }
            } else {
                console.log("حدث خطأ في الإضافة:", xhr.status);
            }
        }

    };
    xhr.send(JSON.stringify(diplayData));
}

//------- function delete student----
function DeleteUser(deleteid) {

    var confirmResult = confirm('هل أنت متأكد من حذف العنصر؟');
    if (confirmResult) {
        var deleteData = {
            delete: deleteid
        }
        // إرسال بيانات الطالب عبر Ajax إلى الخادم
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "./function/teacherFunction.php", true);
        xhr.setRequestHeader("Content-Type", "application/json");

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    // ا  بعد نجاح الإضافة
                    var response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {

                        document.getElementById('LapseTime').style.display = 'flex';
                        setTimeout(function () {
                            document.getElementById('LapseTime').style.display = 'none';
                            diplayData();
                            document.getElementById('resultDelete').innerHTML = '<div class="alert alert-success" role="alert">' + response.message + '</div>';
                            showAlert('message');
                        }, 500);
                    } else {
                        document.getElementById('resultDelete').innerHTML = '<div class="alert alert-danger" role="alert">' + response.message + '</div>';
                    }
                } else {
                    console.log("حدث خطأ في الإضافة:", xhr.status);
                }
            }

        };
        xhr.send(JSON.stringify(deleteData));
        showAlert('resultDelete');

    }
}

//------ function get data to update ---------
function GetData(studentid) {
    var StudentId = {
        studentids: studentid
    }
    // إرسال بيانات الطالب عبر Ajax إلى الخادم
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "./function/teacherFunction.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                // ا  بعد نجاح الإضافة
                var response = JSON.parse(xhr.responseText);
                if (typeof response === "object" && response !== null) {
                    document.getElementById('hiddenID').value = response.InstructorID;
                    document.getElementById('updateName').value = response.Instructor_name;
                    document.getElementById('updatebirth').value = response.Instructor_birth;
                    document.getElementById('updateGender').value = response.gender;
                    document.getElementById('updateEmail').value = response.email;
                    document.getElementById('updatePassword').value = response.password;
                    document.getElementById('updatePhone').value = response.phone;
                } else {
                    document.getElementById('resultDelete').innerHTML = '<div class="alert alert-danger" role="alert">' + response.message + '</div>';
                    showAlert('resultDelete');
                }

            } else {
                console.log("حدث خطأ في الإضافة:", xhr.status);
            }
        }

    };
    xhr.send(JSON.stringify(StudentId));

}

//------  function to update info student ------
function updateInfoStudent() {
    var StudentId = {
        name: document.getElementById('updateName').value,
        idtoUpdate: document.getElementById('hiddenID').value,
        birth: document.getElementById('updatebirth').value,
        gender: document.getElementById('updateGender').value,
        email: document.getElementById('updateEmail').value,
        password: document.getElementById('updatePassword').value,
        phone: document.getElementById('updatePhone').value,
    };
    // إرسال بيانات الطالب عبر Ajax إلى الخادم
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "./function/teacherFunction.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.status === 'success') {
                    const updateElement = document.getElementById('close').click();
                    document.getElementById('LapseTime').style.display = 'flex';
                    setTimeout(function () {
                        document.getElementById('LapseTime').style.display = 'none';
                        diplayData();
                        document.getElementById('resultDelete').innerHTML = '<div class="alert alert-success" role="alert">' + response.message + '</div>';
                        showAlert('message');
                    }, 500);

                } else {
                    document.getElementById('resultDelete').innerHTML = '<div class="alert alert-danger" role="alert">' + response.message + '</div>';
                }
            } else {
                console.log("حدث خطأ في الإضافة:", xhr.status);
            }
        }

    };
    xhr.send(JSON.stringify(StudentId));
    showAlert('resultDelete');

}



function deleteSelectedRecords() {
    var confirmResult = confirm('هل أنت متأكد من حذف العنصر؟');
    if (confirmResult) {
        // الحصول على جميع عناصر الـ checkbox المحددة
        var selectedRecords = [];
        var checkboxes = document.getElementsByClassName('delete-checkbox');

        // جمع القيم المحددة لعلامات التحديد checkbox
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                selectedRecords.push(checkboxes[i].value);
            }
        }
        var selected = {
            selectedRecord: selectedRecords,
        }
        // إرسال بيانات الطالب عبر Ajax إلى الخادم
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "./function/teacherFunction.php", true);
        xhr.setRequestHeader("Content-Type", "application/json");

        xhr.onreadystatechange = function () {

            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        document.getElementById('LapseTime').style.display = 'flex';
                        setTimeout(function () {
                            document.getElementById('LapseTime').style.display = 'none';
                            diplayData();
                            document.getElementById('resultDelete').innerHTML = '<div class="alert alert-success" role="alert">' + response.message + '</div>';
                            showAlert('message');
                        }, 500);

                    } else {
                        document.getElementById('resultDelete').innerHTML = '<div class="alert alert-danger" role="alert">' + response.message + '</div>';
                        showAlert('resultDelete');
                    }
                } else {
                    console.log("حدث خطأ في الإضافة:", xhr.status);
                }
            }

        };
        xhr.send(JSON.stringify(selected));
    }


}