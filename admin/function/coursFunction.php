<?php
//---- to git all data item cours to page showDataCours.php -----
 function dataitemCours($id) {
    include 'globle/conn.php';
    
    $courseData = null;
    $lessonData = array();
    $categor = array();
    $instructors = array();
    $courseID=$id;

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
                        crs.`CoursesID` = $courseID
                    ";
        $sql="SELECT * FROM lessons  WHERE lessons.CoursesID = $courseID";
    
        // تنفيذ الاستعلام
        $result = $conn->query($query);
        $resultlessons = $conn->query($sql);
    
        // التحقق من وجود نتائج
        if ($result->num_rows > 0) {
            // جلب البيانات وتجميعها
            while ($row = $result->fetch_assoc()) {
                // جمع بيانات الكورس (سيتم تكرارها لكل صف)
                if ($courseData === null) {
                    $courseData = $row;
                }
    
            }
    
        }
        // التحقق من وجود نتائج
        if ($resultlessons->num_rows > 0) {
            // جلب البيانات وتجميعها
            while ($row = $resultlessons->fetch_assoc()) {
                // جمع بيانات مقاطع الفيديو المرتبطة بالكورس
                $lessonData[] = array(
                    'LessonsID' => $row['LessonsID'],
                    'Lessons_name' => $row['Lessons_name'],
                    'video_path' => $row['video_path']
                );
            }
    
        }
    
        // جلب بيانات الاصناف من قاعدة البيانات
        $sql5 = "SELECT * FROM `category`";
        $result5 = $conn->query($sql5);
 
         // التحقق من وجود بيانات الأصناف قبل عرضها في النموذج الأول
       
       if ($result5->num_rows > 0) {
           while ($category = $result5->fetch_assoc()) {
              $categor[] = $category;
                     }
         }
    
          // جلب بيانات الاساتذه من قاعدة البيانات
         $sql4 = "SELECT * FROM instructor";
         $result4 = $conn->query($sql4);
        if ($result4->num_rows > 0) {
             while ($instructor = $result4->fetch_assoc()) {
                    $instructors[]= $instructor;
               }
        }
    
     
        $conn->close();

    return array($courseData,$lessonData,$categor,$instructors);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
     include '../globle/conn.php';

 if (isset($_POST['add'])) {
    # code...
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $date = mysqli_real_escape_string($conn, $_POST['date']);
        $price = mysqli_real_escape_string($conn, $_POST['price']);
        $difficulty = mysqli_real_escape_string($conn, $_POST['difficulty']);
        $hours = mysqli_real_escape_string($conn, $_POST['hours']);
        $minutes = mysqli_real_escape_string($conn, $_POST['minutes']);
        $instructor = mysqli_real_escape_string($conn, $_POST['instructor']);
        $category = mysqli_real_escape_string($conn, $_POST['category']);
        $image = $_FILES['fileInput'];
        // check empty or no
        if (empty($name) || empty($description) || empty($date) || empty($price)||empty($difficulty)|| empty($hours)|| empty($minutes)||empty($instructor)||empty($category)||$_FILES['fileInput']['error'] !== UPLOAD_ERR_OK) {
            echo json_encode(['status' => 'error', 'message' => "الرجاء ملء جميع الحقول."]);
            exit();
        }else{
            // time cours
            $Course_duration=$hours.' : '.$minutes;
                // // احفظ المسار النهائي للصورة في قاعدة البيانات
            $targetDirectory = "../uploadsIMG/courseIMG/";
            $targetFileName = uniqid() . '_' . basename($image['name']);
            $targetFilePath = $targetDirectory . $targetFileName;
            $sql = "INSERT INTO courses (course_image,Courses_name,Courses_description,Course_cost,timeCours,difficulty,instructorID,Upload_date,category) VALUES ('$targetFilePath','$name','$description', '$price','$Course_duration','$difficulty', '$instructor','$date','$category')";
            if ($conn->query($sql) === TRUE) {
                move_uploaded_file($image['tmp_name'], '../'.$targetFilePath);
                echo json_encode(['status' => 'success', 'message' => 'تم إدخال البيانات بنجاح.']);
                exit();
            } else {
                 echo json_encode(['status' => 'error', 'message' =>'حدث خطأ أثناء إدخال البيانات.']);
                 exit();
            }
        
        }
 }

 
 if (isset($_POST['uplodvido'])||isset($_POST['addNewVido'])) {
    # code...
        $video_title = mysqli_real_escape_string($conn, $_POST['video-title']);
        $image = $_FILES['video'];

        // check empty or no
        if (empty($video_title) || $_FILES['video']['error'] !== UPLOAD_ERR_OK) {
            echo json_encode(['status' => 'error', 'message' => " الرجاء ملء جميع الحقول."]);
            exit();
        }else{
            if (isset($_POST['addNewVido'])&&!empty($_POST['addNewVido'])) {
               $CoursesID=$_POST['addNewVido'];
            }else{
                 // جلب اخر قيمة
                $query = "SELECT MAX(CoursesID) AS last_added FROM courses";
                // تنفيذ الاستعلام
                $result = $conn->query($query);
                $row = $result->fetch_assoc();
                $CoursesID = $row['last_added'];
            }          
            
            // احفظ المسار النهائي للصورة في قاعدة البيانات
            $targetDirectory = "../uploadsIMG/coursVido/";
            $targetFileName = uniqid() . '_' . basename($image['name']);
            $targetFilePath = $targetDirectory . $targetFileName;
            $sql = "INSERT INTO Lessons (Lessons_name,CoursesID,video_path) VALUES ('$video_title','$CoursesID','$targetFilePath')";
            if ($conn->query($sql) === TRUE) {
                move_uploaded_file($image['tmp_name'], '../'.$targetFilePath);
                echo json_encode(['status' => 'success', 'message' => 'تم إدخال البيانات بنجاح.']);
                exit();
            } else {
                 echo json_encode(['status' => 'error', 'message' =>'حدث خطأ أثناء إدخال البيانات.']);
                 exit();
            }
            $conn->close(); 
        
        }
 }
    
// -------------display data student---------
if (isset($_POST['diplayDataSend'])) {

    // استعلام لاسترداد معلومات الطلاب من قاعدة البيانات
    if (isset($_POST['search']) && $_POST['search'] !=="") {
        $searchTerm=$_POST['search'];
        $sql = "SELECT
        crs.*,
        ins.`InstructorID`,
        ins.`Instructor_name`  
        FROM
            `courses` crs
        LEFT JOIN
            `instructor` ins ON crs.`instructorID` = ins.`InstructorID`
            WHERE crs.Courses_name LIKE '%$searchTerm%' || crs.difficulty LIKE '%$searchTerm%'
        ";

        }else{
            $sql = "SELECT
            crs.*,
            ins.`InstructorID`,
            ins.`Instructor_name`  
            FROM
                `courses` crs
            LEFT JOIN
                `instructor` ins ON crs.`instructorID` = ins.`InstructorID`
            ";
        }
        $result = $conn->query($sql);
        $table='';
        if ($result->num_rows > 0) {
                
                        while ($row = $result->fetch_assoc()) {
                            //count number 
                        $idvido=$row['CoursesID'];
                        $query = "SELECT COUNT(*) AS TotalRows FROM lessons WHERE CoursesID= $idvido";
                        $resultcount = $conn->query($query);

                        // التحقق من وجود نتائج
                        if ($resultcount->num_rows > 0) {
                        // استرجاع النتيجة
                        $count = $resultcount->fetch_assoc();
                        $totalRows = $count["TotalRows"];
                        }
                            # code...
                        $table.='<div class="body_card col ">
                                    <div class="card ">
                                    <p class="nameTeacherCard"><i class="fa-solid fa-graduation-cap ms-2"></i>'.$row['Instructor_name'].'</p>
                                    <a class="btnCoursDelete" onclick="DeleteUser('.$idvido.')"><i class="fa-solid fa-xmark"></i></a>
                                        <a href="showDateCours.php?id='.$row['CoursesID'].'">
                                                <img src="'.$row['course_image'].'" alt="" class="card-img-top">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-3">'.$row['Courses_name'].'</h4>
                                                    <h5 class=" mb-3">'.$row['Course_cost'].' $</h5>
                                                    <p class="level-cours mb-4">درجة الصعوبه : <span class="livel type-level"> '.$row['difficulty'].' </span></p>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <small class="text-muted">'.$row['timeCours'].'<i class="fa-regular fa-clock icon"></i></small>
                                                        <small class="text-muted">'.$totalRows.'<i class="fa-solid fa-circle-play icon"></i></small>
                                                    </div>  
                                                </div>
                                        </a>
                                    </div>
                                </div>';
                }
                echo json_encode(['status' => 'success', 'message' => $table]);
                exit();
                $conn->close();

        }else {
        echo json_encode(['status' => 'success', 'message' => ' <p> لاتوجد بيانات </p>']);
        exit();
    }

}

//------------ delet student ------------
if (isset($_POST['delete'])&& !empty($_POST['delete'])) {
    $ID=$_POST['delete'];
    // get UR img to delete from file 
        $query="SELECT course_image  FROM courses WHERE `courses`.`CoursesID` = $ID";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $URimg=$row['course_image'];
        unlink('../'.$URimg);
    // delete vido of folder 
        $queryvdio="SELECT video_path  FROM lessons WHERE `lessons`.`CoursesID` = $ID";
        $resultvdio = $conn->query($queryvdio);
        if ($resultvdio->num_rows > 0) {
            while ($row = $resultvdio->fetch_assoc()) {
                unlink('../'.$row['video_path']);
            }
        }
            

    $sql = "DELETE FROM courses WHERE `courses`.`CoursesID` = $ID";
             if ($conn->query($sql) === TRUE) {
                  echo json_encode(['status' => 'success', 'message' => 'تم الحذف بنجاح.']);
            } else {
                  echo json_encode(['status' => 'error', 'message' => 'لم يتم الحذف']);
            }
            $conn->close();
}

//------  function to update info cours ------
if (isset($_POST['update'])) {
    # code...
    $id=$_POST['idhiden'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $difficulty = mysqli_real_escape_string($conn, $_POST['difficulty']);
    $hours = mysqli_real_escape_string($conn, $_POST['hours']);
    $minutes = mysqli_real_escape_string($conn, $_POST['minutes']);
    $instructor = trim(mysqli_real_escape_string($conn, $_POST['instructor']));
    $category = trim(mysqli_real_escape_string($conn, $_POST['category']));
    $oldimge=$_POST['oldimg'];
    $image = $_FILES['fileInput'];
    // check empty or no
    if (empty($name) || empty($description) || empty($date) || empty($price)||empty($difficulty)||empty($instructor)||empty($category)) {
        echo json_encode(['status' => 'error', 'message' => "الرجاء ملء جميع الحقول."]);
        exit();
    }else{
    //      // time cours
         $Course_duration=$minutes.' : '.$hours;
        //  if no uplode new img 
         if ($_FILES['fileInput']['error'] !== UPLOAD_ERR_OK) {
            $sql = "update courses set Courses_name='$name',Courses_description='$description',Course_cost='$price',timeCours='$Course_duration',difficulty='$difficulty', instructorID='$instructor',Upload_date='$date',category='$category' WHERE CoursesID=$id";
         }else{
            $targetDirectory = "../uploadsIMG/courseIMG/";
            $targetFileName = uniqid() . '_' . basename($image['name']);
            $targetFilePath = $targetDirectory . $targetFileName;
            move_uploaded_file($image['tmp_name'], '../'.$targetFilePath);
             $sql = "update courses set course_image='$targetFilePath',Courses_name='$name',Courses_description='$description',Course_cost='$price',timeCours='$Course_duration',difficulty='$difficulty', instructorID='$instructor',Upload_date='$date',category='$category' WHERE CoursesID=$id";
             unlink('../'.$oldimge);
         }
           
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['status' => 'success', 'message' => "تم التحديث"]);
        exit();

    } else {
            echo json_encode(['status' => 'error', 'message' => "حدث خطاء"]);
            exit();
    }
        $conn->close();

        }
                
}

// delet vido cours
if (isset($_POST['deleteVido'])&& !empty($_POST['deleteVido']) && isset($_POST['IDCours'])) {
    $IDCours=$_POST['IDCours'];
    // chicke if table have more of value or no 
    $query = "SELECT COUNT(*) AS TotalRows FROM lessons WHERE CoursesID= $IDCours";
    $resultcount = $conn->query($query);
    $row = $resultcount->fetch_assoc();
    // التحقق من وجود نتائج
    if ($row['TotalRows'] > 1) {
         // استرجاع النتيجة
        $ID=$_POST['deleteVido'];
        // delete vido of folder 
        $query="SELECT video_path  FROM lessons WHERE `lessons`.`LessonsID` = $ID";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $URSvido=$row['video_path'];

        $sql = "DELETE FROM lessons WHERE `lessons`.`LessonsID` = $ID";
                 if ($conn->query($sql) === TRUE) {
                     unlink('../'.$URSvido);
                      echo json_encode(['status' => 'success', 'message' => 'تم الحذف بنجاح.']);
                      exit();

                } else {
                      echo json_encode(['status' => 'error', 'message' => 'لم يتم الحذف']);
                      exit();

                }

    }else {
        
        echo json_encode(['status' => 'error', 'message' => 'الجدول يحتوي على قيمة واحدة فقط، لا يمكن حذفها.']);
        exit();
    }
    $conn->close();
  
}

}




?>