<?php
include '../globle/conn.php';
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    // function to display all data 
    if (isset($_GET['getalldate'])) {
        $table = '<table class="table">
                    <thead class="header-table">
                        <tr>
                            <th scope="col">التسلسل</th>
                            <th scope="col">الصنف</th>
                            <th scope="col">الصوره 1</th>
                            <th scope="col" colspan="2"></th>
                        </tr>
                    </thead>';
        
        // استعلام لاسترداد معلومات  من قاعدة البيانات
        $sql = "SELECT * FROM category";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $number = 1;
            while ($row = $result->fetch_assoc()) {
                $id = htmlspecialchars($row['id']);
                $name = htmlspecialchars($row['Name']);
                $img = htmlspecialchars($row['img']);
                
                $table .= '<tr>
                                <th scope="row">' . $number . '</th>
                                <td>' . $name . '</td>
                                <td><img class="imgCategory" src="../' . $img . '" alt=""></td>
                                <td><a  class="btn btnEdat"   onclick="getdate('.$id.')"><i class="fa-solid fa-pen-to-square"></i></a></td>
                                <td><a  class="btn btnDelete"  onclick="deleteItem('.$id.', \''.$img.'\')"><i class="fa-solid fa-trash-can"></i></a></td>
                            </tr>';
                
                $number += 1;
            }
            $table .= '</table>';
            echo json_encode(['status' => 'success', 'message' => $table]);
        } else {
            echo json_encode(['status' => 'success', 'message' => 'لاتوجد بيانات ']);
        }
        $conn->close();
        
    }
      // function to get the date to the form to update 
   if (isset($_GET['get_dateSelection']) && !empty($_GET['get_dateSelection'])) {
        $questionId =$_GET['get_dateSelection'];
        $sql = "SELECT * FROM category WHERE id = $questionId";
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
            $titel = mysqli_real_escape_string($conn, $_POST['titel']);
            $image = $_FILES['image'];
            $targetDirectory = "uploadsIMG/categoryIMG/";
            $targetFileName = uniqid() . '_' . basename($image['name']);
            $targetFilePath = $targetDirectory . $targetFileName;

            if (empty($titel) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
                echo json_encode(['status' => 'error', 'message' => " الرجاء ملء جميع الحقول."]);
                exit();
            }else{
                // إدخال البيانات إلى قاعدة البيانات
                $sql = "INSERT INTO category (name,img) VALUES ('$titel','$targetFilePath')";
                        // تنفيذ الاستعلام
                        if ($conn->query($sql) === TRUE) {
                            $conn->close();
                            move_uploaded_file($image['tmp_name'], '../../'.$targetFilePath);
                            echo json_encode(['status' => 'success', 'message' => 'تم إدخال البيانات بنجاح.']);
                            exit();
                        } else {
                             echo json_encode(['status' => 'error', 'message' =>'حدث خطأ أثناء إدخال البيانات.']);
                             exit();
                        }
                        
            }              

    }
      // function to delete  
    if (isset($_POST['deleteItem']) && !empty($_POST['deleteItem'])) {
        $itemId=$_POST['deleteItem'];
        $imgsrc=$_POST['img'];
        // التحقق من ارتباطه 
        $sql="SELECT category FROM courses WHERE courses.category=$itemId";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo json_encode(['status' => 'error', 'message' => 'هذا الصنف مرتبط بكورس لايمكن حذفه']);
            $conn->close();
        }else{
            unlink('../../'.$imgsrc);
            $sql = "DELETE FROM category WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $itemId);
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
     // update date 
    if (isset($_POST["update"])) {
        $ID = mysqli_real_escape_string($conn, $_POST['hiddenID']);
        $oldimge = mysqli_real_escape_string($conn, $_POST['oldimg']);
        $titel = mysqli_real_escape_string($conn, $_POST['titel']);
        $image = $_FILES['image'];
        if (empty($titel)) {
            echo json_encode(['status' => 'error', 'message' => "الرجاء ملء جميع الحقول."]);
            exit();
        }else{
            if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
                $sql = "update category set Name='$titel' WHERE id= $ID";
             }else{
                $targetDirectory = "uploadsIMG/categoryIMG/";
                $targetFileName = uniqid() . '_' . basename($image['name']);
                $targetFilePath = $targetDirectory . $targetFileName;
                move_uploaded_file($image['tmp_name'], '../../'.$targetFilePath);
                 $sql = "update category set Name='$titel',img='$targetFilePath' WHERE id=$ID";
                 unlink('../../'.$oldimge);
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

    }
