<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/cssboot/bootstrap.min.css">
    <link rel="stylesheet" href="../css/cssboot/style.css">
    <link rel="stylesheet" href="../css/all.min.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الكورس</title>
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
                    <h3 class="mb-5">اشتراك في الكورس</h3>
                    <input type="search" onkeyup="search()" id="searchInput" class="form-control"
                        placeholder="Search..." aria-label="Search">
                </div>
                <!-- form to add and update  -->
                <form method="post" id="formcategory" class="formtest">
                    <div class="row">
                        <div class="form-group col col-lg-4 col-12">
                            <label class="control-label mb-2" for="studentInput">اسم الطالب :</label>
                            <input type="text" class="form-control  mb-1" id="studentInput"
                                placeholder="ادخل اسم الطالب">
                            <ul id="studentAutocompleteList" class="ul-item"></ul>
                        </div>

                        <div class="form-group col col-lg-4 col-12">
                            <label class="control-label mb-2" for="courseInput">اسم الكورس :</label>
                            <input class="form-control  mb-2" type="text" id="courseInput"
                                placeholder="ادخل اسم الكورس">
                            <ul id="courseAutocompleteList" class="ul-item"></ul>
                        </div>
                        <div class="col">
                            <label class="control-label mb-2" for="date">تاريخ الاشتراك:</label>
                            <input class="form-control" type="datetime-local" id="datejoin" name="datejoin">
                        </div>
                    </div>

                    <button type="button" class="btn add col" id="submitButton">اشتراك</button>

                </form>

                <!-- display all date  -->
                <div id="data" style="overflow-x:auto;"></div>
            </main>
        </div>
    </div>


    <script src="jsAdmin.js"></script>
    <script src="Js/Register.js"></script>
    <script src="../jsboot/bootstrap.min.js"></script>

</body>

</html>