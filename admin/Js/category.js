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
    //     
// ------- function diplayData ----
function diplayData() {
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

        var params = "getalldate=" + encodeURIComponent(true);

        xhr.open("GET", "./function/categoryFunction.php?" + params, true);
        xhr.send();
    }
//------- function add ----
function add() {
    const myForm = document.getElementById('formcategory');
    const formData = new FormData(myForm);
    formData.append('add', true);

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "./function/categoryFunction.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.status === 'success') {
                    document.getElementById('message').innerHTML='<div class="alert alert-success" role="alert">' + response.message + '</div>';
                    showAlert('message');
                    myForm.reset();
                    diplayData();
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

            xhr.open("POST",  "./function/categoryFunction.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("deleteItem=" + encodeURIComponent(itemId) + "&img=" + encodeURIComponent(img)); 
        }
}

function getdate(itemId) {

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (typeof response === "object" && response !== null) {
                           document.getElementById('btnadd').setAttribute('type', 'hidden');
                           document.getElementById('btnUpdate').setAttribute('type', 'button');
                           document.getElementById('hiddenID').value=response.id;
                            document.getElementById('titel').value=response.Name;
                            document.getElementById('oldimg').value=response.img;
                    } else {
                        document.getElementById('resultDelete').innerHTML = '<div class="alert alert-danger" role="alert">' + response.message + '</div>';
                    }
                } else {
                    console.log("حدث خطأ في الإضافة:", xhr.status);
                }
            }
            };

            var params = "get_dateSelection=" + encodeURIComponent(itemId);
            xhr.open("GET", "./function/categoryFunction.php?" + params, true);
            xhr.send();
 }
// function to update question
function update() {
    const myForm = document.getElementById('formcategory');
    const formData = new FormData(myForm);
    formData.append('update', true);

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "./function/categoryFunction.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.status === 'success') {
                    myForm.reset();
                    document.getElementById('btnadd').setAttribute('type', 'button');
                    document.getElementById('btnUpdate').setAttribute('type', 'hidden' );
                    document.getElementById('LapseTime').style.display = 'flex';
                    setTimeout(function() {
                        document.getElementById('LapseTime').style.display = 'none';
                        document.getElementById('message').innerHTML='<div class="alert alert-success" role="alert">' + response.message + '</div>';
                        showAlert('message');
                        diplayData();
                     }, 500);
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
