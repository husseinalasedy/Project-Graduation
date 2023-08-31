btnclose=document.getElementById("closeButton");
formadmin=document.getElementById("formadmin");
btnshowForm=document.getElementById("btnshowForm");


window.onload = function (){
    diplayData();
};



btnshowForm.addEventListener("click",showform);
btnclose.addEventListener("click",hiddenform);


function showform() {
    // on click close hide form admin 
    formadmin.style.display =  'block' ;
    btnshowForm.style.display =  'none' ;
}

function hiddenform() {
    // on click close hide form admin 
    formadmin.style.display="none";
    btnshowForm.style.display =  'block' ;
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

        xhr.open("GET", "./function/adminfuction.php?" + params, true);
        xhr.send();
    }
//------- function add ----
function add() {
    const formData = new FormData(formadmin);
    formData.append('add', true);

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "./function/adminfuction.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log(xhr.responseText);
                const response = JSON.parse(xhr.responseText);
                console.log(response);
                if (response.status === 'success') {
                    console.log('ssssss');
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

//function to get data to update 
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
                   document.getElementById('oldimg').value=response.img;
                    document.getElementById('nameadmin').value=response.Name;
                    document.getElementById('username').value=response.userName;
                    document.getElementById('emailadmin').value=response.email	;
                    document.getElementById('passwardadmin').value=response.password;
                    showform();
            } else {
                document.getElementById('message').innerHTML = '<div class="alert alert-danger" role="alert">' + response.message + '</div>';
            }
        } else {
            console.log("حدث خطأ في الإضافة:", xhr.status);
        }
    }
    };

    var params = "getTOupdate=" + encodeURIComponent(itemId);
    xhr.open("GET", "./function/adminfuction.php?" + params, true);
    xhr.send();
}

// function to update question
function update() {
    const formData = new FormData(formadmin);
    formData.append('update', true);

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "./function/adminfuction.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.status === 'success') {
                    formadmin.reset();
                    document.getElementById('LapseTime').style.display = 'flex';
                    setTimeout(function() {
                        hiddenform();
                        document.getElementById('btnadd').setAttribute('type', 'button');
                        document.getElementById('btnUpdate').setAttribute('type', 'hidden' );
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

            xhr.open("POST",  "./function/adminfuction.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("deleteItem=" + encodeURIComponent(itemId) + "&img=" + encodeURIComponent(img)); 
        }
}
