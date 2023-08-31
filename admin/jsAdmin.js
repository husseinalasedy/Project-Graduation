
//----- function print info teacher-------
function printTeacherInfo() {
    var name = document.getElementById("name").value;
    var city = document.getElementById("city").value;
    var birth = document.getElementById("birth").value;
    var phone = document.getElementById("phone").value;
    var dateJoin = document.getElementById("dateJoin").value;
    var info =
        "<h3 class='mb-4'>معلومات الاستاذ</h3>" +
        "<p class='mb-3'><strong>اسم الاستاذ:</strong> " + name + "</p>" +
        "<p class='mb-3'><strong>محافظته:</strong> " + city + "</p>" +
        "<p class='mb-3'><strong>عمره:</strong> " + birth + "</p>" +
        "<p class='mb-4'><strong>رقم هاتفه:</strong> " + phone + "</p>"+
        "<p class='mb-3'><strong>تاريخ الانظمام:</strong> " + dateJoin + "</p>" ;

    document.getElementById("content-info").innerHTML = info;
}

//----- function print img teacher-------
function showImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('preview').setAttribute('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

// window.onload = function () {
//     var datetimeInput = document.getElementById("date");
//     var currentDateTime = new Date().toISOString().slice(0, 16);
//     datetimeInput.value = currentDateTime;
// };


