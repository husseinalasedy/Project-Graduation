<?php
session_start();
include '../admin/globle/conn.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}

$id=$_GET['id'];
 $sql = "SELECT Certificate FROM certificate WHERE  id=$id";
  $result2 = $conn->query($sql);
  $img=""; 
  $row = $result2->fetch_assoc();
  $img = $row['Certificate'];    
  
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/cssboot/bootstrap.min.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/cssboot/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الشهادة</title>
</head>

<body>
    <div class="boxdownlod">
        <img id="certificateIMG" src="<?php  echo $img; ?>" alt="صورة">
    <button class="btn" id="downloadButton"  onclick="down()">تحميل الصورة</button>
    </div>
    <script src="../js/index.js"></script>
</body>

</html>