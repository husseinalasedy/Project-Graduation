
function showAlert(ClassName) {
    var alertMessage = document.getElementById(ClassName);
    alertMessage.style.display = 'block'; // عرض الرسالة
    setTimeout(function() {
      alertMessage.style.display = 'none'; // إخفاء الرسالة بعد 3 ثوانٍ (يمكنك تعديل الزمن حسب رغبتك)
    }, 3000); // 3000 ميلي ثانية = 3 ثواني
}
//------  function to update info cours ------
function updateInfoCours(){
    const Formmy = document.getElementById('Coursupdat');
    const formData = new FormData(Formmy);
    formData.append('update',true);
     
// إرسال بيانات الطالب عبر Ajax إلى الخادم
const xhr = new XMLHttpRequest();
xhr.open('POST', './function/coursFunction.php', true);
xhr.onreadystatechange = function () {
if (xhr.readyState === XMLHttpRequest.DONE) {
    if (xhr.status === 200) {
     var response = JSON.parse(xhr.responseText);
     if (response.status === 'success'){
         document.getElementById('LapseTime').style.display = 'flex';
         setTimeout(function() {
            location.reload();
          }, 1000);
     } else {
         document.getElementById('resultResponsive').innerHTML = '<div class="alert alert-danger" role="alert">' + response.message + '</div>';
         showAlert('resultResponsive') ;
     }
 }else {
     console.log("حدث خطأ في الإضافة:", xhr.status);
 }
}

};
    xhr.send(formData);

}

function deletVido(id,idcours){
    var confirmResult = confirm('هل أنت متأكد من حذف العنصر؟');
    if (confirmResult) {
        const formData = new FormData();
        formData.append('deleteVido', id);
        formData.append('IDCours', idcours);
                // إرسال بيانات الطالب عبر Ajax إلى الخادم
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "./function/coursFunction.php", true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {
                            // ا  بعد نجاح الإضافة
                            var response = JSON.parse(xhr.responseText);
                            
                            if (response.status === 'success') {
                                location.reload();
                            } else {
                                document.getElementById('resultDelete').innerHTML = '<div class="alert alert-danger" role="alert">' + response.message + '</div>';
                                showAlert('resultDelete') ;
                            }
                        }else {
                            console.log("حدث خطأ في الإضافة:", xhr.status);
                        }
                    }
                    
                };
                xhr.send(formData);

        }
}
//------- function ublode vido----
function addvido(id) {
    const myForm = document.getElementById('formVdio');

    const formData = new FormData(myForm);
    formData.append('addNewVido', id);

    const xhr = new XMLHttpRequest();
    xhr.open('POST', './function/coursFunction.php', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.status === 'success') {
                    document.getElementById('reslt').innerHTML='<div class="alert alert-success" role="alert">' + response.message + '</div>';
                    myForm.reset();
                } else {
                    document.getElementById('reslt').innerHTML = '<div class="alert alert-danger" role="alert">' + response.message + '</div>';
                }
                showAlert('reslt');

            } else {
                console.error('حدث خطأ أثناء رفع الصورة:', xhr.status);
            }
        }
    };

    xhr.send(formData);
}
// when click btn close form add new vido 
function refrach(){
        location.reload();
    
}
