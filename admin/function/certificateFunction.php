<?php
include '../globle/conn.php';
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    // function to display all data 
        if (isset($_GET['getalldate'])) {
            if ($_GET['getalldate']!==""){
                $search=$_GET['getalldate'];
                $sql = "SELECT ct.*, e.enrollmentsID, e.studentID, e.CoursesID,s.Name, c.Courses_name
                FROM certificate ct
                INNER JOIN enrollments e ON ct.enrollmentsID = e.enrollmentsID 
                INNER JOIN student s ON e.studentID = s.studentID
                INNER JOIN courses c ON e.CoursesID = c.CoursesID
                WHERE s.Name=$search || c.Courses_name=$search ";
            }else {
                $sql = "SELECT ct.*, e.enrollmentsID, e.studentID, e.CoursesID,s.Name, c.Courses_name
                FROM certificate ct
                INNER JOIN enrollments e ON ct.enrollmentsID = e.enrollmentsID 
                INNER JOIN student s ON e.studentID = s.studentID
                INNER JOIN courses c ON e.CoursesID = c.CoursesID";
            }
        
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $table='<table class="table">
                <thead class="header-table">
                    <tr>
                        <th scope="col">التسلسل</th>
                        <th scope="col">اسم الطالب</th>
                        <th scope="col">اسم الكورس</th>
                        <th scope="col" colspan="2"></th>
                    </tr>
                </thead>';
                
                    $number=1;
                    while ($row = $result->fetch_assoc()) {
                        $Name = htmlspecialchars($row['Name']);
                        $Courses_name = htmlspecialchars($row['Courses_name']);
                        $id = htmlspecialchars($row['id']);
                        $img = htmlspecialchars($row['Certificate']);
                        if ($img==null) {
                            $value='button';
                            $text="";
                        }else{
                            $value='hidden';
                            $text="تم الرفع";
                        }
                        $table.='<tr>
                        <th scope="row">'.$number.'</th>
                        <td>' . $Name . '</td>
                        <td>' .$Courses_name . '</td>
                        <td><input type='.$value.' class="btn secn" onclick="getid('.$id.')" data-bs-toggle="modal" data-bs-target="#exampleModal" value="رفع الشهادة">
                        '.$text.'
                 
                        </td>
                        <td><a  class="btn btnDelete"  onclick="deleteItem('.$id.', \''.$img.'\')"><i class="fa-solid fa-trash-can"></i></a></td>
                        </tr>';
                        
                        $number+=1;
                    }
                    $table.='</table>';
                    echo json_encode(['status' => 'success', 'message' => $table]);
            } else {
                    echo json_encode(['status' => 'success', 'message' => 'لاتوجد بيانات ']);
            }
                $conn->close();
  
        }   
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // function to add 
    if (isset($_POST["add"]) && isset($_POST["id"])) {
        // استدعاء المتغيرات
        $id=$_POST['id'];
        $image = $_FILES['image'];
        $targetDirectory = "../uploadsIMG/certificateIMG/";
        $targetFileName = uniqid() . '_' . basename($image['name']);
        $targetFilePath = $targetDirectory . $targetFileName;

        if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
            echo json_encode(['status' => 'error', 'message' => " الرجاء تحديد الصوره."]);
            exit();
        }else{
                // إدخال البيانات إلى قاعدة البيانات
                $sql="update certificate set Certificate='$targetFilePath' WHERE id=$id ";
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
            // function to delete  
    if (isset($_POST['deleteItem']) && !empty($_POST['deleteItem'])) {
        $itemId=$_POST['deleteItem'];
        $imgsrc=$_POST['img'];
        $sql = "DELETE FROM certificate WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $itemId);
        // unlink('../'.$imgsrc);
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