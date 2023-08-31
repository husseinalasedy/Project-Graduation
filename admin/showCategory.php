<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/cssboot/bootstrap.min.css">
    <link rel="stylesheet" href="../css/cssboot/style.css">
    <link rel="stylesheet" href="../css/all.min.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الاصناف</title>
</head>


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
                    <h3 class="mb-5"> الاصناف </h3>
                </div>
                <!-- form to add and update  -->
                <form method="post" id="formcategory" class="formtest">
                 <div class="row">
                 <div class="form-group col col-lg-6 col-12">
                        <label class="control-label mb-2" for="titel">العنوان:</label>
                        <input class="form-control mb-1" type="text" id="titel" name="titel">
                    </div>
                 <div class="form-group col ">
                        <label class="control-label mb-2" for="image"> اختار صورةالصنف :</label>
                        <input class="form-control  mb-1" type="file" id="image" name="image"
                            accept="image/*">
                    </div>
                 </div>
                    <input type="hidden" id="hiddenID" value="" name="hiddenID">
                    <input type="hidden" id="oldimg" value="" name="oldimg">
                    <input id="btnUpdate" type="hidden" class="btn secn" onclick="update()" name="update_question"
                        value="تحديث">
                    <input id="btnadd" type="button" class="btn add" onclick="add()"name="submit_question" value="رفع الصنف">
                </form>

                <!-- display all date  -->
                <div id="data" style="overflow-x:auto;"></div>
            </main>
        </div>
    </div>


    <script src="jsAdmin.js"></script>
    <script src="Js/category.js"></script>
    <script src="../jsboot/bootstrap.min.js"></script>

</body>

</html>