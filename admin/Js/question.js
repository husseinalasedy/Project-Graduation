
//-------- function hidden massage-------
function showAlert(ClassName) {
    var alertMessage = document.getElementById(ClassName);
    alertMessage.style.display = 'block'; // عرض الرسالة
    setTimeout(function () {
        alertMessage.style.display = 'none'; // إخفاء الرسالة بعد 3 ثوانٍ (يمكنك تعديل الزمن حسب رغبتك)
    }, 3000); // 3000 ميلي ثانية = 3 ثواني
}
    //     
//------- function diplayData ----
    // function diplayData(id) {
    //     var xhr = new XMLHttpRequest();
    //     xhr.onreadystatechange = function () {
    //         if (xhr.readyState === 4) {
    //             if (xhr.status === 200) {
    //             console.log(xhr.responseText);
    //             var response = JSON.parse(xhr.responseText);
    //            if (response.status === 'success') { 
    //             console.log("hhhhh");
    //                 document.getElementById('data').innerHTML = response.message;
    //             } else {
    //                 document.getElementById('message').innerHTML = '<div class="alert alert-danger" role="alert">' + response.message + '</div>';
    //                 showAlert('message');
    //             }
    //         } else {
    //             console.log("حدث خطأ في الإضافة:", xhr.status);
    //         }
    //     }
    //     };

    //     var params = "getQuestion=" + encodeURIComponent(id);

    //     xhr.open("GET", "./function/functionQuestion.php?" + params, true);
    //     xhr.send();
    // }
//------- function ublode vido----
function add(id) {
    const myForm = document.getElementById('formtest');
    const formData = new FormData(myForm);
    formData.append('add', true);
    formData.append('idCours', id);

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "./function/functionQuestion.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.status === 'success') {
                    myForm.reset();
                        location.reload();
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
                           location.reload();
                         }, 500);
                    } else {
                        document.getElementById('message').innerHTML = '<div class="alert alert-danger" role="alert">' + response.message + '</div>';
                    }
                    showAlert('message');
                }
            };

            xhr.open("POST", "./function/functionQuestion.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("deleteItem=" + encodeURIComponent(itemId));
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
                            document.getElementById('Question').value=response.question_text;
                            document.getElementById('option1').value=response.option1;
                            document.getElementById('option2').value=response.option2;
                            document.getElementById('option3').value=response.option3;
                            document.getElementById('correct_option').value=response.correct_option;
                    } else {
                        document.getElementById('message').innerHTML = '<div class="alert alert-danger" role="alert">' + response.message + '</div>';
                    }
                } else {
                    console.log("حدث خطأ في الإضافة:", xhr.status);
                }
            }
            };

            var params = "get_dateSelection=" + encodeURIComponent(itemId);
            xhr.open("GET", "function/functionQuestion.php?" + params, true);
            xhr.send();
 }
// function to update question
function update() {
    const myForm = document.getElementById('formtest');
    const formData = new FormData(myForm);
    formData.append('update', true);

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "./function/functionQuestion.php", true);
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
                       location.reload();
                     }, 500);
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