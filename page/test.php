<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/cssboot/bootstrap.min.css">
    <link rel="stylesheet" href="../css/cssboot/style.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اختبار</title>
</head>


<body>
    <?php 
        include '../headerPage/nav.php';
    include '../admin/globle/conn.php';
    $show=true;
    $result="";
    $CoursesID=$_SESSION['idCours'];
    $userid=$_SESSION['user_id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idregester = "SELECT enrollmentsID as id  FROM enrollments  WHERE studentID=$userid && CoursesID=$CoursesID";
            $idregester_result = $conn->query($idregester);
            $row = $idregester_result->fetch_assoc();
            $idregestercours= $row['id'];

            if (isset($_POST['submit_answers'])) {
                if (!isset($_POST['user_answers']) && empty($_POST['user_answers'])) {
                    $result='<div class="alert alert-warning" role="alert">يجب تحديدالاجابه</div>';
                }else{
                    $user_answers = $_POST['user_answers'];
                    $show=false;
                    // الخطوة 3: الحصول على الإجابات الصحيحة من قاعدة البيانات للدورة المحددة
                    $course_id =$_POST['idcours'];
                    $correct_answers_query = "SELECT id, correct_option FROM questions WHERE course_id = '$course_id'";
                    $correct_answers_result = $conn->query($correct_answers_query);
                    
                    $correct_answers = array();
                    while ($row = $correct_answers_result->fetch_assoc()) {
                        $correct_answers[$row['id']] = $row['correct_option'];
                    }

                    // الخطوة 4: تقييم الاختبار
                    $score = 0;
                    foreach ($user_answers as $question_id => $user_answer) {
                        if (isset($correct_answers[$question_id]) && $user_answer === $correct_answers[$question_id]) {
                            $score++;
                        }
                    }

                    $total_questions = count($correct_answers);
                    $percentage = ($score / $total_questions) * 100;
                    if ($percentage>=50) {
                            $sql="update enrollments set livelCours='مكمل' WHERE studentID=$userid && CoursesID=$CoursesID";
                            $conn->query($sql);
                            $sql="SELECT `id` FROM `certificate` WHERE enrollmentsID=$idregestercours";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                $result= '<h4>تم طلب الشهادة مسبقا<i class="fa-solid fa-triangle-exclamation"></i></h4>';
                       
                            }else{
                                $sql="INSERT INTO certificate (enrollmentsID,exam_degree) VALUES ('$idregestercours','$percentage')";
                                $conn->query($sql);
                                $conn->close();
                                $result= '<h4>تم ارسال طلب الشهادة</h4>';
                            }
                        }else{
                            $result= '<h4>لم يتم ارسال طلب الشهادة بسبب نتيجة الاختبار اقل من 50</h4>';
                        }

                $result.= '<div class="resultTest"><h2>نتيجة الاختبار</h2>
                    <p>عدد الأسئلة الصحيحة: '.$score.'</p>
                    <p>إجمالي عدد الأسئلة: '.$total_questions.'</p>
                    <p>نسبة النجاح: '.$percentage.'%</p>
                    </div>';
                }

                    
            }
        }
    ?>

    <main class="main-item container">
        <div class="boxtest">
            <?php   
           if ($show) {
            echo $result;
                echo' <h2>الاختبار لمنح الشهادة <i class="fa-solid fa-graduation-cap"></i></h2>
                    <form action="'.$_SERVER['PHP_SELF'].'" method="post">
                        <div>';
                            $sql = "SELECT * FROM questions WHERE `questions`.`course_id` =$CoursesID";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
               
                                    while ($row = $result->fetch_assoc()) {
                                        echo'  <div class="question">
                                                            <h3>' . $row['question_text'] . '</h3>
                                                            <div class="optionsFund">
                                                                <div class="boxradio">
                                                                    <input class="form-check-input" type="radio"  name="user_answers['. $row['id'] .']" value="option1" id="flexRadioDefault1'.$row['id'].'">
                                                                    <label class="form-check-label" for="flexRadioDefault1'.$row['id'].'">
                                                                    '.$row['option1'].'
                                                                    </label>
                                                                </div>
                                                                <div class="boxradio">
                                                                    <input class="form-check-input" type="radio" name="user_answers['.$row['id'].']" value="option2" id="flexRadioDefault1'.$row['id'].'">
                                                                    <label class="form-check-label" for="flexRadioDefault1'.$row['id'].'">
                                                                    '.$row['option2'].'
                                                                    </label>
                                                                </div>
                                                                <div class="boxradio">
                                                                    <input class="form-check-input" type="radio" name="user_answers['.$row['id'].']" value="option3" id="flexRadioDefault1'.$row['id'].'">
                                                                    <label class="form-check-label" for="flexRadioDefault1'.$row['id'].'">'.$row['option3'].'</label>
                                                                </div>
                                                            </div>
                                                    </div>';

                                    }
                                }else{
                                    echo '<div class="result"> لاتوجد بيانات في هذا الصنف </div>';
                                }   
                    echo'         </div>
                    <div class="boxbtn"> 
                        <input type="hidden" name="idcours" value="'.$CoursesID.'">
                        <button class="btn" type="submit" name="submit_answers"> ار سال<i class="fa-solid fa-cloud-arrow-up"></i></button>
                    </div>
                    </form>';
            }else{
                echo $result;
            }

        ?>

        </div>
    </main>
    <footer>

        <div class="footer-content">

            <h3>Footer Example</h3>

            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam vitae felis scelerisque, gravida sapien
                non, cursus augue. Aenean id pretium turpis. Suspendisse eros nunc, sollicitudin nec.</p>

            <ul class="socials">

                <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>

                <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>

                <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>

                <li><a href="#"><i class="fa-solid fa-envelope"></i></a></li>

                <li><a href="#"><i class="fa-solid fa-phone"></i></a></li>

            </ul>

        </div>

    </footer>

</body>

</html>