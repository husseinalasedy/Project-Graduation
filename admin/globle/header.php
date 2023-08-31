<?php
  session_start();
   if (isset($_SESSION['admin_id'])) {
    include 'globle/conn.php';
    $idAdmin=$_SESSION['admin_id'];
        $sql = "SELECT * FROM admin where id=$idAdmin";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $Name = htmlspecialchars($row['Name']);
        $img = htmlspecialchars($row['img']);
       }else {
        header("Location: ../page/login.php");
       }
?>
<header class="headerAdmin  navbar-dark sticky-top bg-dark  shadow">
    <div class="headercontent container-fluid">
        <button class="navbar-toggler  d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="عرض/إخفاء لوحة التنقل">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="titelHeader">
            <img src="<?php echo $img;?>" alt="">
            <h3><?php echo $Name;?></h3>
        </div>
    </div>
</header>