//-------- function hidden massage-------
function showAlert(ClassName) {
    var alertMessage = document.getElementById(ClassName);
    alertMessage.style.display = 'block'; // عرض الرسالة
    setTimeout(function() {
      alertMessage.style.display = 'none'; // إخفاء الرسالة بعد 3 ثوانٍ (يمكنك تعديل الزمن حسب رغبتك)
    }, 3000); // 3000 ميلي ثانية = 3 ثواني
  }

//   Go back to add a new course
function backup(){
    location.reload();
}
function nextup(){
    const myForm = document.getElementById('formtest').style.display="block";
    const myForm2=document.getElementById('formcoursVdio').style.display="none";
}
//------- function uplode cours----
function uploadImage() {
    const myForm = document.getElementById('formcours');
    const myForm2=document.getElementById('formcoursVdio');

    const formData = new FormData(myForm);
    formData.append('add', true);

    // formData.append('image', imageInput.files[0]);

    const xhr = new XMLHttpRequest();
    xhr.open('POST', './function/coursFunction.php', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.status === 'success') {
                    document.getElementById('message').innerHTML='<div class="alert alert-success" role="alert">' + response.message + '</div>';
                    document.getElementById('showCours').style.display="none";
                    myForm.reset();
                    myForm.style.display='none';
                    myForm2.style.display='block';
                } else {
                    document.getElementById('message').innerHTML = '<div class="alert alert-danger" role="alert">' + response.message + '</div>';
                }
                showAlert('message');

            } else {
                console.error('حدث خطأ أثناء رفع الصورة:', xhr.status);
            }
        }
    };

    xhr.send(formData);
}

//------- function ublode vido----
function uploadvido() {
    const myForm = document.getElementById('formcoursVdio');

    const formData = new FormData(myForm);
    formData.append('uplodvido', true);


    const xhr = new XMLHttpRequest();
    xhr.open('POST', './function/coursFunction.php', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.status === 'success') {
                    document.getElementById('message').innerHTML='<div class="alert alert-success" role="alert">' + response.message + '</div>';
                    document.getElementById('back').style.display="block";
                    document.getElementById('next').style.display="block";
                    document.getElementById('showCours').style.display="block";
                    myForm.reset();
                } else {
                    document.getElementById('message').innerHTML = '<div class="alert alert-danger" role="alert">' + response.message + '</div>';
                }
                showAlert('message');

            } else {
                console.error('حدث خطأ أثناء رفع الصورة:', xhr.status);
            }
        }
    };

    xhr.send(formData);
}



