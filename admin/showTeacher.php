<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/cssboot/bootstrap.min.css">
    <link rel="stylesheet" href="../css/cssboot/style.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الاساتذه</title>
</head>


<body>
    <?php include 'globle/header.php';?>
    <div class="container-fluid">
        <div class="row">
            <?php include 'globle/slider.php';?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="contener-spinner" id="LapseTime">
                    <div class="loader">
                        <div class="loader-square"></div>
                        <div class="loader-square"></div>
                        <div class="loader-square"></div>
                        <div class="loader-square"></div>
                        <div class="loader-square"></div>
                        <div class="loader-square"></div>
                        <div class="loader-square"></div>
                    </div>
                </div>
                <section>
                    <div id="resultDelete" class="message"></div>
                    <div class="header-offer row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-4 g-lg-0 g-3 ">
                        <h1 class="col titel-infStudent"> معلومات الاساتذه</h1>
                        <form class="col">
                            <input type="search" onkeyup="searchTeacher()" id="searchTeacherIN" class="form-control"
                                placeholder="Search..." aria-label="Search">
                        </form>
                        <div class="btn-header col ">
                            <button type="button" class="btn btnAdmin" data-bs-toggle="modal" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">اظافة استاذ جديد<i
                                    class="fa fa-solid fa-plus"></i></button>
                            <button type="button" onclick="deleteSelectedRecords()" class="btn delet"><i
                                    class="fa fa-regular fa-trash-can"></i></button>


                        </div>

                    </div>

                    <!-- Modal add  -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div id="result"></div>
                            <div class="modal-content">

                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                    <h5 class="modal-title" id="exampleModalLabel">اظافة استاذ جديد</h5>

                                </div>
                                <div class="modal-body">

                                    <form class="formTeacher" method="post">
                                        <label class="control-label form-label" for="nameteacher">الاسم الكامل </label>
                                        <input class="form-control mb-2" id="nameteacher" type="text" name="Name">

                                        <label class="control-label form-label" for="birthteacher">المواليد</label>
                                        <input class="form-control mb-3" id="birthteacher" type="date" name="birth"
                                            value="">

                                        <label class="input-group-text " for="genderteacher">الجنس</label>
                                        <select class="form-select mb-3" id="genderteacher" name="gender">
                                            <option value="ذكر">ذكر</option>
                                            <option value="انثى">انثى</option>
                                        </select>
                                        <label class="control-label form-label" for="emailteacher">البريد
                                            الإلكتروني</label>
                                        <input class="form-control mb-2" id="emailteacher" type="email"
                                            placeholder="fatima.Alfahri@gmail.com" name="email" autocomplete="email">

                                        <label class="control-label form-label" for="passwordteacher">كلمة السر</label>
                                        <input class="form-control mb-2" id="passwordteacher" type="password"
                                            name="password" value="">

                                        <label class="control-label form-label" for="phoneteacher">رقم الهاتف</label>
                                        <input class="form-control" id="phoneteacher" type="tel" name="phone" value="">

                                        <div class="modalFooter ">
                                            <button type="button" onclick="addTeacher()" class="btn add"
                                                name="addstudent">اظافة
                                            </button>
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">اغلاق</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Modal update -->
                    <div class="modal fade" id="editeStudent" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                    <h5 class="modal-title" id="exampleModalLabel">تعديل المعلومات</h5>
                                </div>
                                <div class="modal-body">
                                    <form class="formTeacher" method="post">
                                        <label class="control-label form-label" for="updateName">الاسم الكامل </label>
                                        <input class="form-control mb-2" id="updateName" type="text" name="Name">

                                        <label class="control-label form-label" for="updatebirth">المواليد</label>
                                        <input class="form-control mb-3" id="updatebirth" type="date" name="birth"
                                            value="">

                                        <label class="input-group-text " for="updateGender">الجنس</label>
                                        <select class="form-select mb-3" id="updateGender" name="gender">
                                            <option value="ذكر">ذكر</option>
                                            <option value="انثى">انثى</option>
                                        </select>

                                        <label class="control-label form-label" for="updateEmail">البريد
                                            الإلكتروني</label>
                                        <input class="form-control mb-2" id="updateEmail" type="email"
                                            placeholder="fatima.Alfahri@gmail.com" name="email" autocomplete="email">

                                        <label class="control-label form-label" for="updatePassword">كلمة السر</label>
                                        <input class="form-control mb-2" id="updatePassword" type="text" name="password"
                                            value="">

                                        <label class="control-label form-label" for="updatePhone">رقم الهاتف</label>
                                        <input class="form-control" id="updatePhone" type="tel" name="phone" value="">
                                        <input type="hidden" id="hiddenID" value="">

                                        <div class="modalFooter ">
                                            <button type="button" onclick="updateInfoStudent()"
                                                class="btn add">تحديث</button>
                                            <button type="button" id="close" class="btn btn-secondary"
                                                data-bs-dismiss="modal">اغلاق</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="data" style="overflow-x:auto;"></div>
                </section>
            </main>
            <script src="jsAdmin.js"></script>
            <script src="Js/teacher.js"></script>
            <script src="../jsboot/bootstrap.min.js"></script>

</body>

</html>