<?php
 include 'globle/conn.php';

   if(isset($_GET['id'])&&!empty($_GET['id'])){
        $CoursesID=$_GET['id'];
    }else{
        // جلب اخر قيمة
        $query = "SELECT MAX(CoursesID) AS last_added FROM courses";
        // تنفيذ الاستعلام
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $CoursesID = $row['last_added'];
    }
    $sql = "SELECT * FROM questions WHERE `questions`.`course_id` ='$CoursesID'";
    $result = $conn->query($sql); 
    if ($result->num_rows > 0) {
        $table='<table class="table">
                    <thead class="header-table">
                        <tr>
                            <th scope="col">التسلسل</th>
                            <th scope="col">السؤال</th>
                            <th scope="col">الخيار 1</th>
                            <th scope="col">الخيار 2</th>
                            <th scope="col">الخيار 3</th>
                            <th scope="col">الجواب</th>
                            <th scope="col" colspan="2"></th>
                        </tr>
                    </thead>';
        $number=1;
        while ($row = $result->fetch_assoc()) {
            $table.='<tr>
            <th scope="row">'.$number.'</th>
            <td>' . $row['question_text'] . '</td>
            <td>' . $row['option1'] . '</td>
            <td>' . $row['option2'] . '</td>
            <td>' . $row['option3'] . '</td>
            <td>' . $row['correct_option'] . '</td>
            <td><a  class="btn btnEdat"   onclick="getdate('. $row['id'] .',)"><i class="fa-solid fa-pen-to-square"></i></a></td>
            <td><a  class="btn btnDelete"  onclick="deleteItem('. $row['id'] .')"><i class="fa-solid fa-trash-can"></i></a></td>
            </tr>';
            $number+=1;
        }
        $table.='</table>';
        
}else{
        $table= '<h5>لاتوجد بيانات </h5>';
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
    <title>الاسئله</title>
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
                    <h3 class="mb-5"> الاسئله </h3>
                </div>
                <!-- form to uplude to test student  -->
                <form method="post" id="formtest" class="formtest">

                    <div class="form-group">
                        <label class="control-label mb-2" for="Question"> السؤال:</label>
                        <input class="form-control  mb-2" type="text" id="Question" name="question" required>
                    </div>
                    <div class="bodyinputquestion row">
                        <div class="form-group col">
                            <label class="control-label mb-2" for="option1">(1)الخيار</label>
                            <input class="form-control  mb-2" type="text" id="option1" name="option1" required>
                        </div>
                        <div class="form-group col">
                            <label class="control-label mb-2" for="option2"> (2)الخيار</label>
                            <input class="form-control  mb-2" id="option2" type="text" name="option2" required>
                        </div>
                        <div class="form-group col">
                            <label class="control-label mb-2" for="option3">(3)الخيار</label>
                            <input class="form-control  mb-3" id="option3" type="text" name="option3" required>
                        </div>
                        <div class="form-group col-sm-12 col-lg-4">
                            <label class="control-label mb-2" for="correct_option"> اختر الجواب الصح:</label>
                            <select class="form-select " id="correct_option" name="correct_option">
                                <option value="option1">الخيار الأول</option>
                                <option value="option2">الخيار الثاني</option>
                                <option value="option3">الخيار الثالث</option>
                            </select>

                        </div>
                    </div>
                    <input type="hidden" id="hiddenID" value="" name="hiddenID">
                    <input id="btnUpdate" type="hidden" class="btn secn" onclick="update()" name="update_question"
                        value="تحديث">
                    <input id="btnadd" type="button" class="btn secn" onclick="add(<?php echo $CoursesID;?>)"
                        name="submit_question" value="رفع السؤال">
                </form>
                <!-- display all date  -->
                <div id="data" style="overflow-x:auto;">
                    
                        <?php echo $table; ?>
                </div>
            </main>
            <script src="jsAdmin.js"></script>
            <script src="Js/question.js"></script>
            <script src="../jsboot/bootstrap.min.js"></script>

</body>

</html>