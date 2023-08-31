
<!DOCTYPE html>
<html>
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
    <?php  include '../headerPage/nav.php';?>
    <?php
    include '../admin/globle/conn.php';
    $data="";
    if (isset($_SESSION['user_id'])) {
        $courseID=$_GET['id'];
        $sql="SELECT * FROM lessons  WHERE lessons.CoursesID = $courseID";
        $resultlessons = $conn->query($sql);
        if ($resultlessons->num_rows > 0) {
            // جلب البيانات وتجميعها
            $number=1;
            while ($row = $resultlessons->fetch_assoc()) {
                // جمع بيانات مقاطع الفيديو المرتبطة بالكورس
                $data.='<div class="vid">
                <video src="'.$row['video_path'].'" muted></video>
                <div class="boxTitelVideo"><span>#'.$number.'</span><h3>'.$row['Lessons_name'].'</h3></div>
            </div>';
            $number+=1;
            }

        }else{
            $data="لايوجد فيديوات";
        }

    }else{
        header("Location:login.php");
    }

    ?>
    <main class="main-item container">
      <section class="row">
       <div class="col-12 col-md-8 col-sm-12">
        <div class="boxvideo">
            <video class="video"   muted controls></video>
            <h2 class="titel">اسم الفيديو الاول</h2>
        </div>
       </div>
        <div class="boxvideolist col-12 col-md-4 col-sm-12">
            <h2> الفيديوات <i class="fa-solid fa-video"></i></h2>
            <div class="boxvid">
                <?php  echo $data; ?>
            </div>
        </div>
        <a class="btn btnMoveTEST" href="test.php?id=<?php  echo $courseID; ?>">اجراء الامتحان لطلب الشهادة</a>
      </section>
    </main>
    <?php 
        include '../headerPage/footer.php';
    ?>
    <script src="../js/index.js"></script>
    
    <script src="../jsboot/bootstrap.min.js"></script>

</body>

