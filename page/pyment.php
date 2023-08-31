<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/cssboot/bootstrap.min.css">
    <link rel="stylesheet" href="../css/cssboot/style.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الدفع الالكتروني</title>
</head>


<body>
    <?php
        include '../admin/globle/conn.php';
        include '../headerPage/nav.php';
       if (isset($_SESSION['user_id'])) {
        if (isset($_POST['btnpyment'])) {
            $studentId =$_SESSION['user_id'];
            $courseId = $_SESSION['idCours'];
            $currentDateTime = date("Y-m-d H:i:s");
            $datejoin =$currentDateTime;
            if (empty($studentId) || empty($courseId)||empty($datejoin)) {
                header("Location: cors.php");
            }else{
                // إدخال البيانات إلى قاعدة البيانات
                $sql ="INSERT INTO `enrollments`(`studentID`, `CoursesID`, `dateRegistration`) VALUES ('$studentId','$courseId','$datejoin')";
                // تنفيذ الاستعلام
                if ($conn->query($sql) === TRUE) {
                    $conn->close();
                    header("Location: coursvideo.php?id='.$courseId.'");
                    exit();
                } else {
                    header("Location: pyment.php");
                }
                
            }              

        }
       }else{
        header("Location: login.php");
       }
    
    ?>
    <main class="main-pyment container">
        <form class="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="row gy-3">
                <h2 class="form-titel">الدفع الالكتروني <i class="bi bi-credit-card-2-back"></i></h2>
                <div class="col-12">
                    <label for="cc-name" class="form-label">الاسم على البطاقة</label>
                    <input type="text" class="form-control" id="cc-name" placeholder="" required="">
                    <small class="text-muted">الاسم الكامل كما هو معروض على البطاقة</small>
                </div>

                <div class="col-12">
                    <label for="cc-number" class="form-label">رقم البطاقة</label>
                    <input type="number" class="form-control" id="cc-number" placeholder="1234 5678 9012 3456">
                </div>

                <div class="col-md-6">
                    <label for="cc-expiration" class="form-label">تاريخ انتهاء الصلاحية</label>
                    <input type="date" class="form-control" id="cc-expiration" placeholder="">
                </div>

                <div class="col-md-6">
                    <label for="cc-cvv" class="form-label">الرمز الثلاثي (CVV)</label>
                    <input type="text" class="form-control" id="cc-cvv" placeholder="">
                </div>
            </div>
            <button class="btn" type="submit" name="btnpyment">دفع</button>
        </form>
    </main>
    <?php 
        include '../headerPage/footer.php';
    ?>
</body>

</html>