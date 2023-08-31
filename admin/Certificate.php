<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/cssboot/bootstrap.min.css">
    <link rel="stylesheet" href="../css/cssboot/style.css">
    <link rel="stylesheet" href="../css/all.min.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الشهادة</title>
</head>
<?php include '../headerPage/head.php';?>

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
                <div id="message" class="message"></div>
                <!-- box header titel  -->
                <div class="boxheader">
                    <h3 class="mb-5">طلبات  الشهايد</h3>
                    <input type="search" onkeyup="search()" id="searchInput" class="form-control"
                        placeholder="Search..." aria-label="Search">
                </div>
                <!-- Modal update -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                                <h5 class="modal-title" id="exampleModalLabel">رفع الشهايد</h5>
                                <h5 class="modal-title" id="exampleModalLabel"></h5>
                            </div>
                            <div class="modal-body">
                                <form id="formcertificate" method="POST" enctype="multipart/form-data">
                                    <div class="form-group ">
                                    <label class="control-label mb-2" for="image"> اختار صورة الشهادة :</label>
                                    <input class="form-control  mb-1" type="file" id="image" name="image"
                                        accept="image/*">
                                </div>
                                </form>
                                <div class="modalFooter ">
                                        <button type="button" onclick="add()"
                                            class="btn add">رفع</button>
                                        <button type="button" id="close" class="btn btn-secondary"
                                            data-bs-dismiss="modal">اغلاق</button>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- display all date  -->
                <div id="data" class="mt-2" style="overflow-x:auto;">

            </div>
            </main>
        </div>
    </div>
    <script src="jsAdmin.js"></script>
    <script src="Js/certificate.js"></script>
    <script src="../jsboot/bootstrap.min.js"></script>

</body>

</html>