formcertificate=document.getElementById("formcertificate");
var ID;
window.onload = function (){
    diplayData();
};
//-------- function hidden massage-------
function showAlert(ClassName) {
    var alertMessage = document.getElementById(ClassName);
    alertMessage.style.display = 'block'; // عرض الرسالة
    setTimeout(function () {
        alertMessage.style.display = 'none'; // إخفاء الرسالة بعد 3 ثوانٍ (يمكنك تعديل الزمن حسب رغبتك)
    }, 3000); // 3000 ميلي ثانية = 3 ثواني
}
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

// ------- function diplayData ----
function diplayData(search="") {
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

    var params = "getalldate=" + encodeURIComponent(search);

    xhr.open("GET", "./function/certificateFunction.php?" + params, true);
    xhr.send();
}
// function get id item 
function getid(id){
     ID=id;
} 
//------- function add ----
function add() {
    const formData = new FormData(formcertificate);
    formData.append('add', true);
    formData.append('id', ID);

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "./function/certificateFunction.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log(xhr.responseText);
                const response = JSON.parse(xhr.responseText);
                console.log(response);
                if (response.status === 'success') {
                    document.getElementById('close').click();
                    document.getElementById('message').innerHTML='<div class="alert alert-success" role="alert">' + response.message + '</div>';
                    showAlert('message');
                    diplayData();
                    formadmin.reset();
                } else {
                    document.getElementById('message').innerHTML = '<div class="alert alert-danger" role="alert">' + response.message + '</div>';
                    showAlert('message');
                }

            } else {
                console.error('حدث خطأ أثناء رفع الصورة:', xhr.status);
            }
        }
    };

    xhr.send(formData);
}
// function delete admin 
function deleteItem(itemId,img) {
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

            xhr.open("POST",  "./function/certificateFunction.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("deleteItem=" + encodeURIComponent(itemId) + "&img=" + encodeURIComponent(img)); 
        }
}
