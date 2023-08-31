<?php
include '../globle/conn.php';
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    // function to display all data 
    if (isset($_GET['getalldate'])) {
        # دالة  عرض البيانات
        $table='<table class="table">
        <thead class="header-table">
            <tr>
                <th scope="col">التسلسل</th>
                <th scope="col">اسم الطالب</th>
                <th scope="col">اسم الكورس</th>
                <th scope="col">تاريخ الاشتراك</th>
                <th scope="col">الحاله</th>
                <th scope="col" colspan="2"></th>
            </tr>
        </thead>';
        // استعلام لاسترداد معلومات الطلاب من قاعدة البيانات
        if ($_GET['getalldate']!==""){
            $search=$_GET['getalldate'];
            $sql = "SELECT e.enrollmentsID, e.studentID, e.CoursesID, e.dateRegistration, e.livelCours, s.Name, c.Courses_name
            FROM enrollments e
            INNER JOIN student s ON e.studentID = s.studentID
            INNER JOIN courses c ON e.CoursesID = c.CoursesID
            WHERE s.Name LIKE '%$search%' OR c.Courses_name LIKE '%$search%'";
        }
        else{
            $sql = "SELECT e.enrollmentsID, e.studentID, e.CoursesID, e.dateRegistration, e.livelCours, s.Name, c.Courses_name
                    FROM enrollments e
                    INNER JOIN student s ON e.studentID = s.studentID
                    INNER JOIN courses c ON e.CoursesID = c.CoursesID";
        }
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
                $number=1;
                while ($row = $result->fetch_assoc()) {
                    $table.='<tr>
                    <th scope="row">'.$number.'</th>
                    <td>' . $row['Name'] . '</td>
                    <td>' . $row['Courses_name'] . '</td>
                    <td>' . $row['dateRegistration'] . '</td>
                    <td>' . $row['livelCours'] . '</td>
                    <td><a  class="btn btnDelete" onclick="deleteItem('.$row['enrollmentsID'].')"><i class="fa-solid fa-trash-can"></i></a></td>
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
    if (isset($_POST['queryStudent'])) {
        # code...
        $query = $_POST['queryStudent'];

        $sql = "SELECT studentID,Name FROM student WHERE Name LIKE '%" . $conn->real_escape_string($query) . "%'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<li onclick="getselectionStudent(' . $row["studentID"] . ', \'' . $row["Name"] . '\')" data-id="' . $row["studentID"] . '">' . $row["Name"] . '</li>';
            }
        } else {
            echo "<li >No results found</li>";
        }

        $conn->close();
    }
    if (isset($_POST['queryCourse'])) {
        # code...
        $query = $_POST['queryCourse'];

        $sql = "SELECT CoursesID,Courses_name FROM courses WHERE Courses_name LIKE '%" . $conn->real_escape_string($query) . "%'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<li onclick="getselectionCours(' . $row["CoursesID"] . ', \'' . $row["Courses_name"] . '\')" data-id="' . $row["CoursesID"] . '">' . $row["Courses_name"] . '</li>';
            }
        } else {
            echo "<li>No results found</li>";
        }

        $conn->close();
    }
      // function to add 
    if (isset($_POST["studentId"])&&isset($_POST["courseId"])&&isset($_POST["datejoin"])) {
        // استدعاء المتغيرات
        $studentId = mysqli_real_escape_string($conn, $_POST['studentId']);
        $courseId = mysqli_real_escape_string($conn, $_POST['courseId']);
        $datejoin = mysqli_real_escape_string($conn, $_POST['datejoin']);
       
        if (empty($studentId) || empty($courseId)||empty($datejoin)) {
            echo json_encode(['status' => 'error', 'message' => " الرجاء ملء جميع الحقول."]);
            exit();
        }else{
            // إدخال البيانات إلى قاعدة البيانات
            $sql ="INSERT INTO `enrollments`(`studentID`, `CoursesID`, `dateRegistration`) VALUES ('$studentId','$courseId','$datejoin')";
            // تنفيذ الاستعلام
            if ($conn->query($sql) === TRUE) {
                $conn->close();
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
        $sql = "DELETE FROM enrollments WHERE enrollmentsID = ?";
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
?>