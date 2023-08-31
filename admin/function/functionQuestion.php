<?php
include '../globle/conn.php';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // add question to database
    if (isset($_POST["add"])) {
        $question = mysqli_real_escape_string($conn, $_POST['question']);
        $option1 = mysqli_real_escape_string($conn, $_POST['option1']);
        $option2 = mysqli_real_escape_string($conn, $_POST['option2']);
        $option3 = mysqli_real_escape_string($conn, $_POST['option3']);
        $correct_option = mysqli_real_escape_string($conn, $_POST['correct_option']);
        if (empty($question) || empty($option1) || empty($option2) || empty($option3) || empty($correct_option)) {
            echo json_encode(['status' => 'error', 'message' => "الرجاء ملء جميع الحقول."]);
            exit();
        }else{
            $CoursesID=$_POST['idCours'];
            $sql = "INSERT INTO questions (course_id, question_text,option1,option2,option3,correct_option) VALUES ('$CoursesID', '$question', '$option1', '$option2', '$option3', '$correct_option')";              
            if ($conn->query($sql) === TRUE) {
                echo json_encode(['status' => 'success', 'message' => 'تم إدخال البيانات بنجاح.']);
                exit();
            } else {
                echo json_encode(['status' => 'error', 'message' =>'حدث خطأ أثناء إدخال البيانات.']);
                 exit();
            }
        }
        $conn->close();
    }
    // function to delete question 
    if (isset($_POST['deleteItem']) && !empty($_POST['deleteItem'])) {
        $itemId=$_POST['deleteItem'];
        $sql = "DELETE FROM questions WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $itemId);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'تم الحذف بنجاح.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'لم يتم الحذف']);
        }

        $stmt->close();
        $conn->close();
    }
     // add question to database
    if (isset($_POST["update"])) {
        $ID = mysqli_real_escape_string($conn, $_POST['hiddenID']);
        $question = mysqli_real_escape_string($conn, $_POST['question']);
        $option1 = mysqli_real_escape_string($conn, $_POST['option1']);
        $option2 = mysqli_real_escape_string($conn, $_POST['option2']);
        $option3 = mysqli_real_escape_string($conn, $_POST['option3']);
        $correct_option = mysqli_real_escape_string($conn, $_POST['correct_option']);
        if (empty($question) || empty($option1) || empty($option2) || empty($option3) || empty($correct_option)) {
            echo json_encode(['status' => 'error', 'message' => "الرجاء ملء جميع الحقول."]);
            exit();
        }else{
            $sql = "update questions set question_text='$question',option1='$option1',option2='$option2',option3='$option3',correct_option='$correct_option' WHERE id=$ID";   
            if ($conn->query($sql) === TRUE) {
                echo json_encode(['status' => 'success', 'message' => 'تم تحديث البيانات بنجاح.']);
                exit();
            } else {
                echo json_encode(['status' => 'error', 'message' =>'حدث خطأ أثناء تحديث البيانات.']);
                 exit();
            }
        }
        $conn->close();
    }
}
if ($_SERVER["REQUEST_METHOD"] === "GET") {
   // function to get the date to the form to update 
   if (isset($_GET['get_dateSelection']) && !empty($_GET['get_dateSelection'])) {
        $questionId =$_GET['get_dateSelection'];
        $sql = "SELECT * FROM questions WHERE id = $questionId";
        $result = $conn->query($sql);
        if ($result->num_rows > 0){
            $response = $result->fetch_assoc();
            echo json_encode($response);
    }else {
        echo json_encode(['status' => 'error', 'message' => "حدث خطاء"]);
    }
    $conn->close();

}

}


?>