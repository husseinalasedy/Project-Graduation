<?php
   include 'globle/conn.php';



    // استعلامات الحسابات
    $queryCourses = "SELECT COUNT(*) AS NCourses FROM courses";
    $queryEnrollments = "SELECT COUNT(*) AS NEnrollments FROM enrollments";
    $queryStudents = "SELECT COUNT(*) AS NStudents FROM student";
    $queryInstructors = "SELECT COUNT(*) AS NInstructors FROM instructor";

    // تنفيذ استعلامات الحسابات والحصول على النتائج
    $resultCourses = $conn->query($queryCourses);
    $resultEnrollments = $conn->query($queryEnrollments);
    $resultStudents = $conn->query($queryStudents);
    $resultInstructors = $conn->query($queryInstructors);

    // فحص نتائج الاستعلامات واستخدامها عند الحاجة
    if ($resultCourses && $resultEnrollments && $resultStudents && $resultInstructors) {
        $rowCourses = $resultCourses->fetch_assoc();
        $rowEnrollments = $resultEnrollments->fetch_assoc();
        $rowStudents = $resultStudents->fetch_assoc();
        $rowInstructors = $resultInstructors->fetch_assoc();
        
        $numCourses = $rowCourses['NCourses'];
        $numEnrollments = $rowEnrollments['NEnrollments'];
        $numStudents = $rowStudents['NStudents'];
        $numInstructors = $rowInstructors['NInstructors'];

    } else {
        echo "حدث خطأ أثناء تنفيذ الاستعلامات.";
    }

    // إغلاق الاتصال بقاعدة البيانات عند الانتهاء من الاستفسارات
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/cssboot/bootstrap.min.css">
    <link rel="stylesheet" href="../css/cssboot/style.css">
    <link rel="stylesheet" href="../css/all.min.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الصفحه الرئيسيه</title>
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
                    <article class="boxinfoDdashboard">
                        <a href="showStudent.php" class="box">
                            <h2>الطلاب <i class="fa-solid fa-user-graduate"></i></h2>
                            <p><?php echo $numStudents?></p>
                        </a>
                        <a href="showTeacher.php" class="box">
                            <h2>الاساتذه <i class="fa-solid fa-person-chalkboard"></i></h2>
                            <p><?php echo $numInstructors?></p>
                        </a>
                        <a href="showCours.php" class="box">
                            <h2>الكورست <i class="fa-solid fa-laptop-code"></i></h2>
                            <p><?php echo $numCourses?></p>
                        </a>
                        <a href="RegisterCourse.php" class="box">
                            <h2>المسجلين <i class="fa-solid fa-user"></i></h2>
                            <p><?php echo $numEnrollments?></p>
                        </a>
                        <a class="box">
                            <h2>الشهايد <i class="fa-solid fa-graduation-cap"></i></h2>
                            <p>22</p>
                        </a>
                    </article>
                    <article class="bodycontentAdmin">
                <div id="message" class="message"></div>
                        <!-- form to add and update  -->
                        <form method="post" id="formadmin" class="formadmin">
                            <button id="closeButton" type="button " class="btn-close mb-4" aria-label="Close"></button>
                            <div class="row">
                                <div class="form-group col ">
                                    <label class="control-label mb-2" for="image"> اختار صورةالصنف :</label>
                                    <input class="form-control  mb-1" type="file" id="image" name="image"
                                        accept="image/*">
                                </div>
                                <div class="form-group col-md-3 col-sm-12 ">
                                    <label class="control-label mb-2" for="nameadmin">اسم الادمن :</label>
                                    <input type="text" class="form-control  mb-1" id="nameadmin" name="nameadmin" placeholder=" ادخل الاسم كامل">
                                </div>

                                <div class="form-group col-md-3 col-sm-12 ">
                                    <label class="control-label mb-2" for="username">اسم المستخدم :</label>
                                    <input class="form-control  mb-2" name="username" type="text" id="username"
                                        placeholder="ادخل اسم المستخدم">
                                </div>
                                <div class="form-group col-md-3 col-sm-12">
                                    <label class="control-label mb-2" for="emailadmin">ايميل:</label>
                                    <input class="form-control  mb-2" type="text" name="emailadmin" id="emailadmin"
                                        placeholder="ادخل الايميل ">
                                </div>
                                <div class="form-group  col-md-3 col-sm-12">
                                    <label class="control-label mb-2" for="passwardadmin">الرمز:</label>
                                    <input class="form-control  mb-2" type="text" name="passwardadmin" id="passwardadmin"
                                        placeholder="ادخل الرمز ">
                                </div>
                                <div class="boxadduser col">
                                    <input type="hidden" id="hiddenID" name="hiddenID" value="">
                                    <input type="hidden" id="oldimg" value="" name="oldimg">
                                <input id="btnUpdate" type="hidden" class="btn secn" onclick="update()" name="update_question" value="تحديث">
                                <input id="btnadd" type="button" class="btn add" onclick="add()"name="submit_question" value="اظافه">
                            </div>
                            </div>

                        </form>
                        <div class="boxHeadertableAdmin">
                        <input type="search" onkeyup="search()" id="searchInput" class="iputsearch form-control" placeholder="Search..." aria-label="Search">
                            <button class="btn secn" id="btnshowForm">اظافة ادمن <i class="fa fa-solid fa-plus"></i></button>
                        </div>
                        <!-- display all date  -->
                        
                        <div id="data" class="dataadmin" style="overflow-x:auto;"></div>
                   
                    </article>
                </section>
            </main>
        </div>
    </div>

    <script src="jsAdmin.js"></script>
    <script src="Js/admin.js"></script>
    <script src="../jsboot/bootstrap.min.js"></script>

</body>

</html>