<?php

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
    <title>بيانات الكورس</title>
</head>

<body>
    <?php include 'globle/header.php';
    ?>
  
    <div class="container-fluid">
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
        <div class="row">
            <?php include 'globle/slider.php';
              require './function/coursFunction.php';
              // استدعاء الدالة والحصول على المصفوفتين
              $id=$_GET['id'];
              $data = dataitemCours($id);
          
              // استخدام المصفوفتين المرجعة من الدالة
              $row = $data[0];
              $dataVido = $data[1];
              $categories = $data[2];
              $instructors = $data[3];
              $numberVido = count($dataVido);
              $coursTime=$row['timeCours'];
              $coursTime1 = explode(":",$coursTime);
              $hours= intval($coursTime1[1]);
              $minutes=intval($coursTime1[0]);

        
            ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

                <div id="resultDelete" class="message"></div>
                <!-- Modal update inf cours-->
                <div class="modal fade" id="editeCours" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div id="resultResponsive" class="message"></div>
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                                <h5 class="modal-title" id="exampleModalLabel">تعديل المعلومات</h5>
                            </div>
                            <div class="modal-body">
                                <form id="Coursupdat" class="updatCours" method="post">
                                    <label class="control-label mb-2" for="name">العنوان:</label>
                                    <input class="form-control mb-1" type="text" id="name" name="name"
                                        value="<?php echo $row['Courses_name']; ?>">

                                    <label class="control-label mb-2" for="floatingTextarea">وصف</label>
                                    <textarea class="form-control mb-2" placeholder="Leave a comment here"
                                        id="floatingTextarea" name="description"
                                        max="2000"><?php echo $row['Courses_description'];?></textarea>
                                    <div class="row">
                                        <div class="col  ">
                                            <label class="control-label mb-2" for="course-image"> اختار
                                                صورةالكورس:</label>
                                            <input class="form-control  mb-2" type="file" id="fileInput"
                                                name="fileInput" accept="image/*">
                                            <input type="hidden" name="oldimg"
                                                value="<?php echo $row['course_image']; ?>">

                                            <label class="control-label mb-2" for="date">تاريخ الرفع:</label>
                                            <input class="form-control mb-2" type="datetime-local" id="date" name="date"
                                                value="<?php echo $row['Upload_date']; ?>">

                                            <label class="input-group-text " for="category ">الصنف:</label>
                                            <select class="form-select mb-2" id="category" name="category">
                                                <!-- استعلام SQL لاسترداد أسماء الأساتذة من قاعدة البيانات -->
                                                <?php foreach ($categories as $categoriy) : ?>
                                                <option value="<?php echo $categoriy['id']; ?>"
                                                    <?php if ($categoriy['id'] === $row['category']) echo "selected"; ?>>
                                                    <?php echo $categoriy['Name']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col ">
                                            <label class="control-label mb-2" for="price">السعر:</label>
                                            <input class="form-control mb-2 " type="number" id="price" name="price"
                                                value="<?php echo $row['Course_cost']; ?>">

                                            <label class="control-label mb-2" for="course_duration">مدة الكورس :</label>
                                            <label class="control-label mb-2" for="course_duration">دقايق/ساعات</label>
                                            <div class="d-flex ">
                                                <input class="form-control mb-2 " type="number" name="minutes"
                                                    id="minutes" placeholder="دقايق" value="<?php echo $minutes ?>">
                                                <input class="form-control mb-2 " type="number" name="hours" id="hours"
                                                    placeholder="ساعات" value="<?php echo $hours; ?>">
                                            </div>

                                            <label class="input-group-text " for="difficulty">مستوى الدورة:</label>
                                            <select class="form-select mb-3" id="difficulty" name="difficulty">
                                                <option selected value="سهل"
                                                    <?php if ("سهل"=== $row['difficulty']) echo "selected"; ?>>سهل
                                                </option>
                                                <option value="صعب"
                                                    <?php if ("صعب"  === $row['difficulty']) echo "selected"; ?>>صعب
                                                </option>
                                            </select>

                                        </div>
                                    </div>


                                    <label class="input-group-text" for="instructor">اسم الاستاذ:</label>
                                    <select class="form-select mb-3" id="instructor" name="instructor">

                                        <!-- استعلام SQL لاسترداد أسماء الأساتذة من قاعدة البيانات -->
                                        <?php foreach ($instructors as $instructor) : ?>
                                        <option value="<?php echo $instructor['InstructorID']; ?>"
                                            <?php if ($instructor['InstructorID'] === $row['instructorID']) echo "selected"; ?>>
                                            <?php echo $instructor['Instructor_name']; ?></option>
                                        <?php endforeach; ?>

                                    </select>
                                    <input type="hidden" name="idhiden" value="<?php echo $row['CoursesID'];?>">
                                </form>
                                <div class="modalFooter ">
                                    <button type="button" onclick="updateInfoCours()" class="btn">تحديث</button>
                                    <button type="button" id="close" class="btn btn-secondary"
                                        data-bs-dismiss="modal">اغلاق</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal add new vido -->
                <div class="modal fade" id="addVido" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div id="reslt" class="message"></div>
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                    onclick="refrach()"></button>
                                <h5 class="modal-title" id="exampleModalLabel">تعديل المعلومات</h5>
                            </div>
                            <div class="modal-body">
                                <form id="formVdio">
                                    <div class="form-group">
                                        <label class="control-label mb-2" for="video-title">عنوان الفيديو:</label>
                                        <input class="form-control  mb-2" type="text" id="video-title"
                                            name="video-title" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-2" for="video">رفع الفيديو:</label>
                                        <input class="form-control  mb-2" type="file" id="video" name="video" required>
                                    </div>
                                </form>
                            </div>
                            <div class="modalFooter ">
                                <button type="button" onclick="addvido(<?php echo $row['CoursesID']; ?>)"
                                    class="btn">اظافه</button>
                                <button type="button" id="close" onclick="refrach()" class="btn btn-secondary"
                                    data-bs-dismiss="modal">اغلاق</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- move to page question  -->


                <section class="section-item row row-cols-1 row-cols-md-2">

                    <!--content the page the right  -->
                    <div class="col col-md-4 mb-5">
                        <div class="card">
                            <p class="nameTeacherCard"><i
                                    class="fa-solid fa-graduation-cap ms-2"></i><?php echo $row['Instructor_name']; ?>
                            </p>
                            <img src="<?php echo $row['course_image']; ?>" alt="img" class="card-img-top">
                            <div class="card-body">
                                <h2 class="card-title"> <?php echo $row['Courses_name']; ?></h2>
                                <div class="">
                                    <h4 class=" mb-4"><span class="type-level"><?php echo $row['Course_cost']; ?>
                                            $</span></h4>
                                    <p class=" mb-3">مستوه : <span
                                            class="livel type-level"><?php echo $row['difficulty']; ?></span></p>
                                    <p class="level-cours mb-2">تاريخ الرفع : <span
                                            class="type-level"><?php echo $row['Upload_date']; ?></span></p>
                                    <p class="level-cours mb-2"> الصنف : <span
                                            class="type-level"><?php echo $row['Name']; ?></span></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted"><?php echo $row['timeCours']; ?><i
                                                class="fa-regular fa-clock icon"></i></small>
                                        <small class="text-muted"><?php echo $numberVido; ?><i
                                                class="fa-solid fa-circle-play icon"></i></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--content the page the left  -->
                    <div class="LEFT col col-md-8">
                        <a href="showQuestions.php?id=<?php echo $id; ?>" class=" btn btnAdmin mb-3">اسئلة الامتحان</a>
                        <!-- btn update info cours  -->
                        <button type="button" class="abslut btn secn" data-bs-toggle="modal"
                            data-bs-target="#editeCours"><i class="fa-solid fa-pen-to-square"></i> تعديل</button>
                        <div class="description mb-5">
                            <h2 class="description-titel mb-4">الوصف</h2>
                            <p class="description-content"><?php echo $row['Courses_description']; ?></p>
                        </div>
                        <div class="lectures">
                            <button type="button" class="abslut btn add" data-bs-toggle="modal"
                                data-bs-target="#addVido"><i class="fa-solid fa-pen-to-square"></i> اظافة فيديو</button>
                            <h2 class="description-titel mb-4"> الكورسات (<span><?php echo $numberVido; ?></span>)</h2>
                            <?php foreach ($dataVido as $dataVidos) : ?>
                            <div class="contenerVideo">
                                <p class="subject"><i
                                        class="fa-solid fa-circle-play ms-3 icon"></i><?php echo $dataVidos['Lessons_name']; ?>
                                </p>
                                <a class="deletItem"
                                    onclick="deletVido(<?php echo $dataVidos['LessonsID']; ?>,<?php echo $row['CoursesID']; ?>)"><i
                                        class="fa-solid fa-trash-can"></i></a>
                            </div>

                            <?php endforeach; ?>
                        </div>
                    </div>
                </section>
            </main>
            <script src="jsAdmin.js"></script>
            <script src="Js/coursItem.js"></script>
            <script src="../jsboot/bootstrap.min.js"></script>

</body>

</html>