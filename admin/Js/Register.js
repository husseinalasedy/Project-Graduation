const studentInput = document.getElementById('studentInput');
const studentList = document.getElementById('studentAutocompleteList');
const courseInput = document.getElementById('courseInput');
const courseList = document.getElementById('courseAutocompleteList');
const submitButton = document.getElementById('submitButton');
const myForm = document.getElementById('formcategory');
const result = document.getElementById('message');

window.onload = function (){
    diplayData();
};
//-------------- function search -----------
function search() {
    var searchTerm = document.getElementById("searchInput").value.trim();
    if (searchTerm !== "") {
        // استدعاء الدالة لجلب نتائج البحث من قاعدة البيانات
        diplayData(searchTerm);
    } else {
        // إذا كان حقل البحث فارغًا، عرض الجدول بدون تصفية
        diplayData();
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

// get data student after input from database 
studentInput.addEventListener('input', function () {
    const inputValue = studentInput.value.toLowerCase();
    if (inputValue === '') {
        //---- when input empty--------
        studentInput.removeAttribute('data-selected-id');
        studentList.innerHTML = '';
    } else {
        // ... كود البحث وعرض النتائج هنا ...
        const xhr = new XMLHttpRequest();
        xhr.open('POST', "./function/RegisterFunction.php", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                studentList.innerHTML = xhr.responseText;
            }
        };

        xhr.send('queryStudent=' + encodeURIComponent(inputValue));
    }
});
// get data cours after input from database 
courseInput.addEventListener('input', function () {
    const inputValue = courseInput.value.toLowerCase();
    if (inputValue === '') {
        //---- when input empty--------
        courseInput.removeAttribute('data-selected-id');
        courseList.innerHTML = '';
    } else {
        // ... كود البحث وعرض النتائج هنا ...
        const xhr = new XMLHttpRequest();
        xhr.open('POST', "./function/RegisterFunction.php", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                courseList.innerHTML = xhr.responseText;
            }
        };

        xhr.send('queryCourse=' + encodeURIComponent(inputValue));
    }
});
// Emptying the field of values ​​when mouse clicked outside the field 
document.addEventListener('click', function (event) {
    if (!studentInput.contains(event.target)) {
        studentList.innerHTML = '';
    }

    if (!courseInput.contains(event.target)) {
        courseList.innerHTML = '';
    }

});

// get data student after select and display in input 
function getselectionStudent(id, name) {

    const selectedId = id
    const selectedName = name
    studentInput.value = selectedName;
    studentInput.setAttribute('data-selected-id', selectedId);
    studentList.innerHTML = '';

}
// get data cours after select and display in input 
function getselectionCours(id, name) {
    const selectedId = id;
    const selectedName = name;
    courseInput.value = selectedName;
    courseInput.setAttribute('data-selected-id', selectedId);
    courseList.innerHTML = '';
}

//-----Function when the button is pressed----
submitButton.addEventListener('click', function () {
    const selectedStudentId = studentInput.getAttribute('data-selected-id');
    const selectedCourseId = courseInput.getAttribute('data-selected-id');
    const datejoin = document.getElementById('datejoin').value;

    if (selectedStudentId && selectedCourseId && datejoin) {
        sendSelectedDataToDatabase(selectedStudentId, selectedCourseId, datejoin);
    } else {
        result.innerHTML = '<div class="alert alert-danger" role="alert">رجاء حدد الحقول</div>';
        showAlert('message');
    }
});
//-----white event when click button ----
function sendSelectedDataToDatabase(studentId, courseId, datejoin) {
    // ... كود إرسال البيانات إلى قاعدة البيانات هنا ...
    const xhr = new XMLHttpRequest();
    xhr.open('POST', "./function/RegisterFunction.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.status === 'success') {
                message.innerHTML = '<div class="alert alert-success" role="alert">' + response.message + '</div>';
                showAlert('message');
                myForm.reset();
                diplayData();
            } else {
                message.innerHTML = '<div class="alert alert-danger" role="alert">' + response.message + '</div>';
                showAlert('message');
            }
        }
    };

    const data = 'studentId=' + encodeURIComponent(studentId) + '&courseId=' + encodeURIComponent(courseId) + '&datejoin=' + encodeURIComponent(datejoin);
    xhr.send(data);
}

// ------- function diplayData ----
function diplayData(sarch="") {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
           if (response.status === 'success') { 
                document.getElementById('data').innerHTML = response.message;
            } else {
                document.getElementById('message').innerHTML = '<div class="alert alert-danger" role="alert">' + response.message + '</div>';
                showAlert('message');
            }
        } else {
            console.log("حدث خطأ في الإضافة:", xhr.status);
        }
    }
    };

    var params = "getalldate=" + encodeURIComponent(sarch);

    xhr.open("GET", "./function/RegisterFunction.php?" + params, true);
    xhr.send();
}
// function to delete 
function deleteItem(itemId) {
    var confirmResult = confirm('هل أنت متأكد من حذف العنصر؟');
 if (confirmResult) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        document.getElementById('LapseTime').style.display = 'flex';
                        setTimeout(function() {
                            document.getElementById('LapseTime').style.display = 'none';
                            diplayData();
                            document.getElementById('message').innerHTML='<div class="alert alert-success" role="alert">' + response.message + '</div>';
                            showAlert('message');
                         }, 500);
                        
                    } else {
                        document.getElementById('message').innerHTML = '<div class="alert alert-danger" role="alert">' + response.message + '</div>';
                        showAlert('message');
                    }
                }
            };

            xhr.open("POST",  "./function/RegisterFunction.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("deleteItem=" + encodeURIComponent(itemId));
        }
}