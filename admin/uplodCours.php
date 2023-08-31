<?php
   include 'globle/conn.php';

                // جلب بيانات الاساتذه من قاعدة البيانات
                $sql = "SELECT * FROM instructor";
                $result = $conn->query($sql);
                // تحقق من وجود بيانات الأصناف قبل عرضها في النموذج الأول
                $instructors = [];
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $instructors[] = $row;
                    }
                }

                // جلب بيانات الاصناف من قاعدة البيانات
                $sql = "SELECT * FROM category";
                $result = $conn->query($sql);

                // تحقق من وجود بيانات الأصناف قبل عرضها في النموذج الأول
                $categories = [];
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $categories[] = $row;
                    }
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
    <title>رفع الكورس</title>
</head>


<body>
    <?php include 'globle/header.php';?>
    <div class="container-fluid">
        <div class="row">
            <?php include 'globle/slider.php';?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    <!-- header  -->
                    <div class="header-offer">
                        <h1 class="col titel-infStudent">إنشاء كورس جديد</h1>
                        <a id="showCours" href="showCours.php" class="btn secn">عرض الكورسات</a>
                    </div>
                    <div class="adminForm">
                        <!-- result responsive -->
                        <div id="message" class="message"></div>
                        <!-- form uplude cours  -->
                        <form id="formcours">
                            <label class="control-label mb-2" for="name">العنوان:</label>
                            <input class="form-control mb-1" type="text" id="name" name="name">

                            <label class="control-label mb-2" for="floatingTextarea">وصف</label>
                            <textarea class="form-control mb-2" placeholder="Leave a comment here" id="floatingTextarea"
                                name="description" max="2000"></textarea>
                            <div class="row">
                                <div class="col  ">
                                    <label class="control-label mb-2" for="course-image"> اختار صورةالكورس:</label>
                                    <input class="form-control  mb-2" type="file" id="fileInput" name="fileInput"
                                        accept="image/*">

                                    <label class="control-label mb-2" for="date">تاريخ الرفع:</label>
                                    <input class="form-control mb-2" type="datetime-local" id="date" name="date">

                                    <label class="input-group-text " for="category ">الصنف:</label>
                                    <select class="form-select mb-2" id="category" name="category">
                                        <!-- استعلام SQL لاسترداد أسماء الأساتذة من قاعدة البيانات -->
                                        <?php foreach ($categories as $categoriy) : ?>
                                        <option value="<?php echo $categoriy['id']; ?>">
                                            <?php echo $categoriy['Name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col ">
                                    <label class="control-label mb-2" for="price">السعر:</label>
                                    <input class="form-control mb-2 " type="number" id="price" name="price">

                                    <label class="control-label mb-2" for="course_duration">مدة الكورس (بالساعات
                                        والدقائق):</label>
                                    <div class="d-flex ">
                                        <input class="form-control mb-2 " type="number" name="minutes" id="minutes"
                                            placeholder="دقايق" max="60">
                                        <input class="form-control mb-2 " type="number" name="hours" id="hours"
                                            placeholder="ساعات" min="0" max="5">
                                    </div>

                                    <label class="input-group-text " for="difficulty">مستوى الدورة:</label>
                                    <select class="form-select mb-3" id="difficulty" name="difficulty">
                                        <option selected value="سهل">سهل</option>
                                        <option value="صعب">صعب</option>
                                    </select>

                                </div>
                            </div>


                            <label class="input-group-text" for="instructor">اسم الاستاذ:</label>
                            <select class="form-select mb-3" id="instructor" name="instructor">

                                <!-- استعلام SQL لاسترداد أسماء الأساتذة من قاعدة البيانات -->
                                <?php foreach ($instructors as $instructor) : ?>
                                <option value="<?php echo $instructor['InstructorID']; ?>">
                                    <?php echo $instructor['Instructor_name']; ?></option>
                                <?php endforeach; ?>

                            </select>



                            <button type="button" onclick="uploadImage()" class="btn add">إنشاء الكورس <i
                                    class="fa fa-solid fa-plus"></i></button>
                        </form>
                        <!-- form uplude vido to cours  -->
                        <form id="formcoursVdio">
                            <div class="form-group">
                                <label class="control-label mb-2" for="video-title">عنوان الفيديو:</label>
                                <input class="form-control  mb-2" type="text" id="video-title" name="video-title" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-2" for="video">رفع الفيديو:</label>
                                <input class="form-control  mb-2" type="file" id="video" name="video" required>
                            </div>
                            <button type="button" onclick="uploadvido()" class="btn add">رفع فيديو <i
                                    class="fa fa-solid fa-plus"></i></button>
                            <button id="next" class="btn secn" onclick="nextup()">انشاء اسئلة للامتحان</button>
                            <button id="back" class="btn secn" onclick="backup()">رفع كورس اخر </button>
                        </form>

                    </div>
        </div>
 </main>
        <script src="jsAdmin.js"></script>
        <script src="Js/uplodCours.js"></script>
        <script src="../jsboot/bootstrap.min.js"></script>

</body>

</html>