<?php
include '../globle/conn.php';
function check($username,$emailadmin,$passwardadmin){
    global $conn;
    $checkUsernameQuery = "SELECT * FROM admin WHERE userName = '$username'";
    $usernameResult = $conn->query($checkUsernameQuery);
    if ($usernameResult->num_rows > 0) {
        $conn->close();
        return ['status' => 'error', 'message' => "اسم المستخدم مكرر. الرجاء اختيار اسم مستخدم آخر."];
    }
    // التحقق من البريد الإلكتروني
    if (!filter_var($emailadmin, FILTER_VALIDATE_EMAIL)) {
        return ['status' => 'error', 'message' => "البريد الإلكتروني غير صالح."];
    }
    if (strlen($passwardadmin) < 8 ||
        !preg_match("#[0-9]+#", $passwardadmin) ||
        !preg_match("#[A-Z]+#", $passwardadmin) ||
        !preg_match("#[a-z]+#", $passwardadmin)) {
        return ['status' => 'error', 'message' => "كلمة المرور ضعيفة. تأكد من استخدام حروف كبيرة وصغيرة وأرقام ورموز خاصة، وأن طولها لا يقل عن 8 أحرف."];
    }
    return ['status' => 'success', 'message' => 'تم التحقق بنجاح.'];
}
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    // function to display all data 
        if (isset($_GET['getalldate'])) {
            # دالة  عرض البيانات
            $table='<table class="table">
            <thead class="header-table">
                <tr>
                    <th scope="col">التسلسل</th>
                    <th scope="col">الصورة</th>
                    <th scope="col">اسم </th>
                    <th scope="col">اسم المستخدم</th>
                    <th scope="col" colspan="2">ايميل</th>
                    <th scope="col" ></th>
                </tr>
            </thead>';
            // استعلام لاسترداد معلومات الطلاب من قاعدة البيانات
            if ($_GET['getalldate']!==""){
                $search=$_GET['getalldate'];
                $sql = "SELECT * FROM admin WHERE admin.Name LIKE '%$search%' OR admin.userName LIKE '%$search%'";
            }
            else{
                $sql = "SELECT * FROM admin";
            }
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                    $number=1;
                    while ($row = $result->fetch_assoc()) {
                        $id = htmlspecialchars($row['id']);
                        $Name = htmlspecialchars($row['Name']);
                        $userName = htmlspecialchars($row['userName']);
                        $email = htmlspecialchars($row['email']);
                        $img = htmlspecialchars($row['img']);
                        
                        $table .= '<tr>
                                        <th scope="row">' . $number . '</th>
                                        <td><img class="imgCategory" src="' . $img . '" alt=""></td>
                                        <td>' . $Name . '</td>
                                        <td>' . $userName . '</td>
                                        <td >' . $email . '</td>
                                        <td><a  class="btn btnEdat"   onclick="getdate('.$id.')"><i class="fa-solid fa-pen-to-square"></i></a><a  class="btn btnDelete"  onclick="deleteItem('.$id.', \''.$img.'\')"><i class="fa-solid fa-trash-can"></i></a></td>
                                    </tr>';
                        
                        $number += 1;
                    }
                    $table.='</table>';
                    echo json_encode(['status' => 'success', 'message' => $table]);
                } else {
                    echo json_encode(['status' => 'success', 'message' => 'لاتوجد بيانات ']);
                }
                $conn->close();
    }
        // function to get the date to the form to update 
        if (isset($_GET['getTOupdate']) && !empty($_GET['getTOupdate'])) {
            $id =$_GET['getTOupdate'];
            $sql = "SELECT * FROM admin WHERE id = $id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0){
                $response = $result->fetch_assoc();
                $conn->close();
                echo json_encode($response);
                exit();
            }else {
                echo json_encode(['status' => 'error', 'message' => "حدث خطاء"]);
                exit();
            }

    }
  
}   
if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // function to add 
        if (isset($_POST["add"])) {
            // استدعاء المتغيرات
            $nameadmin = mysqli_real_escape_string($conn, $_POST['nameadmin']);
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $emailadmin = mysqli_real_escape_string($conn, $_POST['emailadmin']);
            $passwardadmin = mysqli_real_escape_string($conn, $_POST['passwardadmin']);
            $image = $_FILES['image'];
            $targetDirectory = "../uploadsIMG/adminIMG/";
            $targetFileName = uniqid() . '_' . basename($image['name']);
            $targetFilePath = $targetDirectory . $targetFileName;

            if (empty($nameadmin) ||empty($username) ||empty($emailadmin) ||empty($passwardadmin) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
                echo json_encode(['status' => 'error', 'message' => " الرجاء ملء جميع الحقول."]);
                exit();
            }else{
                $checkResult = check($username, $emailadmin, $passwardadmin);
                if ($checkResult['status'] === 'error') {
                    echo json_encode($checkResult);
                    exit();
                }else{
                      // إدخال البيانات إلى قاعدة البيانات
                $sql = "INSERT INTO admin (Name,userName,email,password,img) VALUES ('$nameadmin','$username','$emailadmin','$passwardadmin','$targetFilePath')";
                // تنفيذ الاستعلام
                if ($conn->query($sql) === TRUE) {
                    $conn->close();
                    move_uploaded_file($image['tmp_name'], '../'.$targetFilePath);
                    echo json_encode(['status' => 'success', 'message' => 'تم إدخال البيانات بنجاح.']);
                    exit();
                } else {
                    echo json_encode(['status' => 'error', 'message' =>'حدث خطأ أثناء إدخال البيانات.']);
                    exit();
                }
                }
                
            }              

    }
    // update date 
    if (isset($_POST["update"])) {
        $id = mysqli_real_escape_string($conn, $_POST['hiddenID']);
        $oldimg = mysqli_real_escape_string($conn, $_POST['oldimg']);
        $nameadmin = mysqli_real_escape_string($conn, $_POST['nameadmin']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $emailadmin = mysqli_real_escape_string($conn, $_POST['emailadmin']);
        $passwardadmin = mysqli_real_escape_string($conn, $_POST['passwardadmin']);
        $image = $_FILES['image'];
        if (empty($nameadmin) ||empty($username) ||empty($emailadmin) ||empty($passwardadmin)) {
            echo json_encode(['status' => 'error', 'message' => " الرجاء ملء جميع الحقول."]);
            exit();
        }else{
                // if dont went chang img 
            if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
                $sql = "update admin set Name='$nameadmin',userName='$username',email='$emailadmin',password='$passwardadmin' WHERE id=$id";
            }else{
                // if went chang img 
                $targetDirectory = "../uploadsIMG/categoryIMG/";
                $targetFileName = uniqid() . '_' . basename($image['name']);
                $targetFilePath = $targetDirectory . $targetFileName;
                $targetDirectory = "../uploadsIMG/adminIMG/";
                $sql = "update admin set Name='$nameadmin',userName='$username',email='$emailadmin',password='$passwardadmin',img='$targetFilePath' WHERE id=$id";
                unlink('../'.$oldimg);
            }
            if ($conn->query($sql) === TRUE) {
                $conn->close();
                echo json_encode(['status' => 'success', 'message' => "تم تحديث البيانات بنجاح. "]);
                exit();
        
            } else {
                    echo json_encode(['status' => 'error', 'message' => "حدث خطأ أثناء تحديث البيانات. "]);
                    exit();
            }
            
        }
    }

        // function to delete  
    if (isset($_POST['deleteItem']) && !empty($_POST['deleteItem'])) {
        $itemId=$_POST['deleteItem'];
        $imgsrc=$_POST['img'];
        $sql = "DELETE FROM admin WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $itemId);
        unlink('../'.$imgsrc);
        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            echo json_encode(['status' => 'success', 'message' => 'تم الحذف بنجاح.']);
            exit();
        } else {
            echo json_encode(['status' => 'error', 'message' => 'لم يتم الحذف']);
            exit();
        }

    }


}
?>