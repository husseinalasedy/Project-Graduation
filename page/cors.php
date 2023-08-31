<?php
$id=$_GET['id'];
include '../admin/globle/conn.php';
      $sql = "SELECT
      crs.*,
      ins.`InstructorID`,
      ins.`Instructor_name`  
      FROM
          `courses` crs
      LEFT JOIN
          `instructor` ins ON crs.`instructorID` = ins.`InstructorID`
    WHERE crs.`category`=$id";
  $result = $conn->query($sql);
  $data='';
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
                  $data.='<div class="body_card col ">
                              <div class="card">
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
          $conn->close();
}else{
    $data='<div class="result"> لاتوجد بيانات في هذا الصنف </div>';
  }
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
    <title>كورسات</title>
</head>

<body>
<?php include '../headerPage/nav.php';?>
    <main class="main-item  container">
        <section>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-4 g-3">
                <?php  echo $data; ?>
            </div>
        </section>
    </main>
        <?php 
        include '../headerPage/footer.php';
    ?>
</body>