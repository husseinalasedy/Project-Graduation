window.onload = function (){
    diplayData();
};
//-------- function hidden massage-------
function showAlert(ClassName) {
    var alertMessage = document.getElementById(ClassName);
    alertMessage.style.display = 'block'; // عرض الرسالة
    setTimeout(function() {
      alertMessage.style.display = 'none'; // إخفاء الرسالة بعد 3 ثوانٍ (يمكنك تعديل الزمن حسب رغبتك)
    }, 3000); // 3000 ميلي ثانية = 3 ثواني
}
//-------------- function search -----------
function searchCours() {
    var searchTerm = document.getElementById("searIput").value.trim();
    if (searchTerm !== "") {
        // استدعاء الدالة لجلب نتائج البحث من قاعدة البيانات
        diplayData(searchTerm);
    } else {
        // إذا كان حقل البحث فارغًا، عرض الجدول بدون تصفية
        diplayData();
    }
}
//------- function diplayData cours----
function diplayData(searchTerm="") {

    const formData = new FormData();
    formData.append('diplayDataSend', true);
    formData.append('search',searchTerm);
 // إرسال بيانات الطالب عبر Ajax إلى الخادم
 const xhr = new XMLHttpRequest();
 xhr.open('POST', './function/coursFunction.php', true);
 xhr.onreadystatechange = function () {
     if (xhr.readyState === XMLHttpRequest.DONE) {
         console.log(xhr.responseText);
         if (xhr.status === 200) {
             const response = JSON.parse(xhr.responseText);
             if (response.status === 'success') {
                 document.getElementById('data').innerHTML=response.message ;
             } else {
                 document.getElementById('resultDelete').innerHTML = '<div class="alert alert-danger" role="alert">' + response.message + '</div>';
                 showAlert('resultDelete');
             }
         }else {
             console.log("حدث خطأ في الإضافة:", xhr.status);
         }
     }
     
 };
 xhr.send(formData);
}
//------- function delete student----
function DeleteUser(deleteid){

 var confirmResult = confirm('هل أنت متأكد من حذف العنصر؟');
 if (confirmResult) {
     const formData = new FormData();
     formData.append('delete', deleteid);
             // إرسال بيانات الطالب عبر Ajax إلى الخادم
             var xhr = new XMLHttpRequest();
             xhr.open("POST", "./function/coursFunction.php", true);
             xhr.onreadystatechange = function() {
                 if (xhr.readyState === 4) {
                     if (xhr.status === 200) {
                         // ا  بعد نجاح الإضافة
                         var response = JSON.parse(xhr.responseText);
                         
                         if (response.status === 'success') {
                             diplayData();
                             document.getElementById('resultDelete').innerHTML='<div class="alert alert-success" role="alert">' + response.message + '</div>';
                         } else {
                             document.getElementById('resultDelete').innerHTML = '<div class="alert alert-danger" role="alert">' + response.message + '</div>';
                         }
                     }else {
                         console.log("حدث خطأ في الإضافة:", xhr.status);
                     }
                 }
                 
             };
             xhr.send(formData);
             showAlert('resultDelete') ;
     }

 }

