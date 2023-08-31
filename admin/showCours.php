<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/cssboot/bootstrap.min.css">
    <link rel="stylesheet" href="../css/cssboot/style.css">
    <link rel="stylesheet" href="../css/all.min.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> الكورس</title>
</head>


<body>
<?php include 'globle/header.php';?>
<div class="container-fluid"> 
    <div class="row">
        <?php include 'globle/slider.php';?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div id="resultDelete" class="message"></div>
                <div class="header-offer row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-4 g-lg-0 g-3 ">
                    <h1 class="col titel-infStudent">الكورسات</h1>
                    <form class="col">
                        <input type="search" onkeyup="searchCours()" id="searIput" class="form-control"
                            placeholder="Search..." aria-label="Search">
                    </form>
                    <div class="btn-header col ">
                        <a href="uplodCours.php" class="btn secn">اظافة كورس جديد<i class="fa fa-solid fa-plus"></i></a>
                    </div>

                </div>

                <div id="data" class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-4 g-3">
                

                </div>
        </main>
</div>
</div>  
    <script src="jsAdmin.js"></script>
    <script src="Js/coursdata.js"></script>
    <script src="../jsboot/bootstrap.min.js"></script>

</body>

</html>
