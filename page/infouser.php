


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/cssboot/bootstrap.min.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/cssboot/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>التفاصيل</title>
</head>

<body>
<?php include '../headerPage/nav.php';?>
<?php
// require('fpdf.php'); // تأكد من وجود ملف المكتبة FPDF في نفس المجلد
        include '../admin/globle/conn.php';

        if (isset($_SESSION['user_id'])) {
            $id_user = $_SESSION['user_id'];
            $data ="";
            $sql = "SELECT CoursesID FROM enrollments WHERE studentID = $id_user";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $coursids = array(); // إنشاء مصفوفة لتخزين القيم
                while ($row = $result->fetch_assoc()) {
                    $coursids[] = $row["CoursesID"]; // تخزين قيمة CoursesID في المصفوفة
                }
            }
        // تحقق من وجود قيم في المصفوفة قبل استخدامها في الاستعلام
            if (!empty($coursids)) {
                $coursids_string = implode(',', $coursids);
                
                $sql = "SELECT crs.*, ins.`InstructorID`, ins.`Instructor_name` 
                        FROM `courses` crs 
                        LEFT JOIN `instructor` ins ON crs.`instructorID` = ins.`InstructorID`
                        WHERE crs.`CoursesID` IN ($coursids_string)";
                
                $result_courses = $conn->query($sql);
                
                if ($result_courses->num_rows > 0) {
                    while ($row = $result_courses->fetch_assoc()) {
                                    // الجزء المتعلق بعدد الدروس
                            $idvido = $row['CoursesID'];
                            $query = "SELECT COUNT(*) AS TotalRows FROM lessons WHERE CoursesID = $idvido";
                            $resultcount = $conn->query($query);

                            // التحقق من وجود نتائج
                            if ($resultcount->num_rows > 0) {
                                $count = $resultcount->fetch_assoc();
                                $totalRows = $count["TotalRows"];
                            }

                            // بناء بيانات الكارت
                            $data .= '<div class="body_card col ">
                                        <div class="card ">
                                        <p class="nameTeacherCard"><i class="fa-solid fa-graduation-cap ms-2"></i>'.$row['Instructor_name'].'</p>
                                            <a href="item.php?id='.$row['CoursesID'].'">
                                                    <img src="'.$row['course_image'].'" alt="" class="card-img-top">
                                                    <div class="card-body">
                                                        <h4 class="card-title mb-3">'.$row['Courses_name'].'</h4>
                                                        <h5 class=" mb-3">'.$row['Course_cost'].' $</h5>
                                                        <p class="level-cours mb-4">درجة الصعوبه : <span class="livel type-level"> '.$row['difficulty'].' </span></p>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <small class="text-muted">'.$row['timeCours'].'<i class="fa-regular fa-clock"></i></small>
                                                            <small class="text-muted">'.$totalRows.'<i class="fa-solid fa-circle-play"></i></small>
                                                        </div>  
                                                    </div>
                                            </a>
                                        </div>
                                    </div>';
                    }
                } else {
                    echo "لم يتم العثور على سجلات مطابقة.";
                }
            } else {
                echo "لا توجد قيم في المصفوفة.";
            }

            $sql = "SELECT ct.id,ct.enrollmentsID,ct.Certificate, e.enrollmentsID, e.studentID, e.CoursesID,c.Courses_name
            FROM certificate ct
            INNER JOIN enrollments e ON ct.enrollmentsID = e.enrollmentsID 
            INNER JOIN courses c ON e.CoursesID = c.CoursesID
            WHERE  e.studentID=$id_user";
            $result2 = $conn->query($sql);
            $datacertificate=""; 
            if ($result2->num_rows > 0) {
            // إنشاء مصفوفة لتخزين القيم
                while ($row = $result2->fetch_assoc()) {
                    $img = htmlspecialchars($row['Certificate']);
                    if ($img!=null) {
                        $datacertificate.= '<a class="Certificate"  href="certificateIMG.php?id='.$row['id'].'">
                                                <i class="fa-solid fa-certificate"></i>
                                                <h4>'.$row['Courses_name'].'</h4>
                                                <input type="hidden" name="certificate_path" value="path_to_certificate_image.jpg"> 
                                            </a>'; 
                    }
            //
                }
            }


        }
?>

    <main class="main-item  container">
        <section class="sectionCertificate">
            <h2>الشهادات المنجزه</h2>
            <div class="boxCertificate">
               <?php echo $datacertificate; ?>
            </div>
        </section>
        <section class="sectioncoursRegester">
            <h2>الكورسات المسجل به</h2>
            <div class="boxcoursRegester">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-4 g-3">
                    <?php  echo $data; ?>
                </div>
            </div>
        </section>


    </main>
    <?php 
        include '../headerPage/footer.php';
    ?>
    <script src="jsboot/bootstrap.min.js"></script>
</body>

</html>