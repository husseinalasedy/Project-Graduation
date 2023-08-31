<?php
  include '../admin/globle/conn.php';
    $id=$_GET['id'];
    $query = "SELECT
                crs.*,
                ins.`Instructor_name`,
                cat.`Name`
                FROM
                    `courses` crs
                JOIN
                    `category` cat ON crs.`category` = cat.`id`
                JOIN
                    `instructor` ins ON crs.`instructorID` = ins.`InstructorID`
                WHERE
                    crs.`CoursesID` = $id";

    $sql="SELECT Lessons_name FROM lessons  WHERE lessons.CoursesID = $id";

    // تنفيذ الاستعلام
    $result = $conn->query($query);
    $resultlessons = $conn->query($sql);
    // التحقق من وجود نتائج
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }
    $datavido = "";
    // التحقق من وجود نتائج
    if ($resultlessons->num_rows > 0) {
     // جلب البيانات وتجميعها
        while ($vido = $resultlessons->fetch_assoc()) {
            $datavido.='<div class="itemVideo"><p class="subject"><i class="fa-solid fa-circle-play ms-3"></i>'.$vido['Lessons_name'].'</p> </div>';
        }

    }
    ?>



<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/cssboot/bootstrap.min.css">
    <link rel="stylesheet" href="../css/cssboot/style.css">
    <link rel="stylesheet" href="../css/all.min.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الكورس</title>
</head>


<body>
    <?php 
        include '../headerPage/nav.php';
        $_SESSION['idCours']=$id;
    ?>
    <main class="main-item container">
        <section class="section-item row row-cols-1  row-cols-lg-2">
            <!--content the page the right  -->
            <div class="col col-12 col-md-10 col-lg-5 mb-5">
                <div class="card">
                    <p class="nameTeacherCard">
                        <i class="fa-solid fa-graduation-cap ms-2"></i>
                        <?php echo $row['Instructor_name']; ?>
                    </p>
                    <img src="<?php echo $row['course_image']; ?>" alt="img" class="card-img-top">
                    <div class="card-body">
                        <h2 class="card-title"> <?php echo $row['Courses_name']; ?></h2>
                        <div class="">
                            <h4 class=" mb-4"><span class="type-level"><?php echo $row['Course_cost']; ?>
                                    $</span></h4>
                            <p class=" mb-3">مستوه : <span
                                    class="livel type-level"><?php echo $row['difficulty']; ?></span></p>
                            <p class="level-cours mb-2">تاريخ الرفع : <span
                                    class="type-level"><?php echo $row['Upload_date']; ?></span></p>
                                    <?php
                                //  check user register or no in cours 
                                        if (isset($_SESSION['user_id'])) {
                                            $id_user=$_SESSION['user_id'];
                                            $sql = "SELECT studentID,CoursesID FROM enrollments WHERE studentID=$id_user && CoursesID=$id";
                                            $result = $conn->query($sql);
                                            if ($result->num_rows > 0) {
                                                echo '<a href="coursvideo.php?id='.$id.'" class="btn secn" type="submit" name="join">عرض الكورس</a>';
                                            }else{
                                                echo '<a href="pyment.php" class="btn" type="submit" name="join">الان انظمام</a>';
                                            }
                                            
                                        }else{
                                             echo '<a href="pyment.php" class="btn" type="submit" name="join">الان انظمام</a>';
                                         }

                                    ?>

                            
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted"><?php echo $row['timeCours']; ?><i
                                        class="fa-regular fa-clock "></i></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-12 col-lg-7">
                <div class="description mb-5">
                    <h2 class="description-titel mb-4">الوصف</h2>
                    <p class="description-content"><?php echo $row['Courses_description']; ?></p>
                </div>

                <div class="lectures ">
                    <h2 class="description-titel mb-4">المواضيع</h2>
                    <?php echo $datavido; ?>
                </div>
            </div>

        </section>
    </main>
    <?php 
        include '../headerPage/footer.php';
    ?>
</body>

</html>