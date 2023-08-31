<?php
    include '../globle/conn.php';
  
//-------------- function to fliter input------------- 
    function validateStudentData($studentData) {      
        // التحقق من أن الحقول ليست فارغة
        if (empty($studentData['name']) || empty($studentData['gender']) || empty($studentData['gender']) ||
            empty($studentData['email']) || empty($studentData['password']) || empty($studentData['phone'])) {
            return ['status' => 'error', 'message' =>  "الرجاء ملء جميع الحقول."];
        }
            // التحقق من صحة عنوان البريد الإلكتروني
        if (!filter_var(trim($studentData['email']), FILTER_VALIDATE_EMAIL)){
            return ['status' => 'error', 'message' => "الرجاء إدخال عنوان بريد إلكتروني صالح."];
        }
                            
         // التحقق من صحة كلمة المرور
        $password =trim($studentData['password']);
        if (strlen($password) < 8) {
            return ['status' => 'error', 'message' => 'كلمة المرور يجب ان تكون على الاقل 8'];
        } elseif (!preg_match('/[A-Z]/', $password) && !preg_match('/[a-z]/', $password)) {
            return ['status' => 'error', 'message' => 'يجب أن تحتوي كلمة المرور على حرف كبير وحرف صغير.'];
        } elseif (!preg_match('/[0-9]/', $password)) {
            return ['status' => 'error', 'message' => 'يجب أن تحتوي كلمة المرور على رقم واحد على الأقل.'];
        }
                            
                            // $conn->close();
        // التحقق من أن رقم الهاتف يحتوي على أرقام فقط وأن طوله 8 أرقام على الأقل
       if (!preg_match('/^\d{11,}$/',trim($studentData['phone']))) {
            return ['status' => 'error', 'message' => "الرجاء إدخال رقم هاتف صحيح يحتوي على 8 أرقام على الأقل."];
       }
         return ['status' => 'success', 'message' => 'تم التحقق بنجاح.'];
                    
    
    }

if ($_SERVER["REQUEST_METHOD"] === "POST") {
         $studentData = json_decode(file_get_contents("php://input"), true);
// --------------add new student------------
        if (isset($studentData['submitButtonClicked'])) {
            $validationResult = validateStudentData($studentData);
            if ($validationResult['status'] === 'error') {
                echo json_encode(['status' => 'error', 'message' => $validationResult['message']]);
            } else {
                                // التحقق من غير تكرارية البريد الإلكتروني واسم الطالب في قاعدة البيانات
                    $email = trim($studentData['email']);
                    $name = trim($studentData['name']);
                    $username =trim($studentData['username']);
                    $sql1 = "SELECT * FROM student WHERE email ='$email'";
                    $result = $conn->query($sql1);
                    $sql2 = "SELECT * FROM student WHERE Name ='$name'";
                    $result2 = $conn->query($sql2);

                    $checkUsernameQuery = "SELECT * FROM student WHERE username = '$username'";
                    $usernameResult = $conn->query($checkUsernameQuery);
                    if ($usernameResult->num_rows > 0) {
                        $conn->close();
                        echo json_encode(['status' => 'error', 'message' => "اسم المستخدم مكرر. الرجاء اختيار اسم مستخدم آخر."]);
                        exit();
                    }

                                
                    if ($result->num_rows > 0 || $result2->num_rows > 0) {
                        echo json_encode(['status' => 'error', 'message' => ' مسجل مسبق ']);
                    }else {
                            $name = trim($studentData['name']);
                            $birth = $studentData['birth'];
                            $gender = $studentData['gender'];
                            $email = trim($studentData['email']);
                            $password = trim($studentData['password']);
                            $phone = trim($studentData['phone']);
                            $data_join=trim($studentData['data_join']);
                                # query student...
                                $sql = "INSERT INTO student (Name, gender,email,password,phone,birth,data_join,username) VALUES ('$name', '$gender', '$email', '$password', '$phone', '$birth','$data_join','$username')";
                  
                                
                            
                            if ($conn->query($sql) === TRUE) {
                                echo json_encode(['status' => 'success', 'message' => 'تم إدخال البيانات بنجاح.']);
                            } else {
                                echo json_encode(['status' => 'error', 'message' => 'حدث خطأ أثناء إدخال البيانات.']);
                            }
                            
                            $conn->close();
                    }
                        
            }
        }       

// -------------display data student---------
        if (isset($studentData['diplayDataSend'])) {
                # دالة  عرض البيانات
                $table='<table class="table">
                <thead class="header-table">
                    <tr>
                    <th scope="col"><input id="main-checkbox" class="form-check-input" type="checkbox" value="" onclick="selectAllCheckboxes()" ></th>
                        <th scope="col">التسلسل</th>
                        <th scope="col">الاسم</th>
                        <th scope="col">اسم المستخدام</th>
                        <th scope="col">الجنس</th>
                        <th scope="col">المواليد</th>
                        <th scope="col">الايميل</th>
                        <th scope="col">الهاتف</th>
                        <th scope="col">تاريخ الانظمام</th>
                        <th scope="col" colspan="2"></th>
                    </tr>
                </thead>';
                // استعلام لاسترداد معلومات الطلاب من قاعدة البيانات
                if (isset($studentData['searched']) && $studentData['searched']!==""){
                    $searchTerm=$studentData['searched'];
                    $sql = "SELECT * FROM student WHERE `student`.`Name` LIKE '%$searchTerm%'";
                }
                else{
                    $sql = "SELECT * FROM student ORDER BY 'Name'";
                }
                $result = $conn->query($sql);
                $number=1;
                while ($row = $result->fetch_assoc()) {
                    $table.='<tr>
                    <td><input class="form-check-input delete-checkbox" type="checkbox" value="'.$row['studentID'].'"  ></td>
                    <th scope="row">'.$number.'</th>
                    <td>' . $row['Name'] . '</td>
                    <td>' . $row['username'] . '</td>
                    <td>' . $row['gender'] . '</td>
                    <td>' . $row['birth'] . '</td>
                    <td>' . $row['email'] . '</td>
                    <td>' . $row['phone'] . '</td>
                    <td>' . $row['data_join'] . '</td>
                    <td><a  class="btn btnEdat"  data-bs-toggle="modal" data-bs-target="#editeStudent" onclick="GetData('.$row['studentID'].')"><i class="fa-solid fa-pen-to-square"></i></a></td>
                    <td><a  class="btn btnDelete"  onclick="DeleteUser('.$row['studentID'].')"><i class="fa-solid fa-trash-can"></i></a></td>
                    </tr>';
                    $number+=1;
                }
                $table.='</table>';
                echo json_encode(['status' => 'success', 'message' => $table]);
                $conn->close();
        }

//------------ delet student ------------
        if (isset($studentData['delete'])) {
            $IDstuden=$studentData['delete'];
            $sql = "DELETE FROM student WHERE `student`.`studentID` = $IDstuden";
                     if ($conn->query($sql) === TRUE) {
                          echo json_encode(['status' => 'success', 'message' => 'تم الحذف بنجاح.']);
                    } else {
                          echo json_encode(['status' => 'error', 'message' => 'لم يتم الحذف']);
                    }
                    $conn->close();
        }

//---------- get data student to update inf---------
        if (isset($studentData['studentids'])) {
                $ID=$studentData['studentids'];
                $sql = "SELECT * FROM student WHERE `student`.`studentID` = $ID";
                $result = $conn->query($sql);

                if ($result->num_rows > 0){
                    $response = $result->fetch_assoc();
                    echo json_encode($response);
               }else {
                echo json_encode(['status' => 'error', 'message' => "حدث خطاء"]);
               }
               $conn->close();
        }

//------  function to update info student ------
       if (isset($studentData['idtoUpdate'])) {
            $validationResult = validateStudentData($studentData);
            if ($validationResult['status'] === 'error') {
                echo json_encode(['status' => 'error', 'message' => $validationResult['message']]);
            } else {
                    $ID=$studentData['idtoUpdate'];
                    $name=trim($studentData['name']);
                    $username=trim($studentData['username']);
                    $gender=$studentData['gender'];
                    $birth=$studentData['birth'];
                    $email=trim($studentData['email']);
                    $password=trim($studentData['password']);
                    $phone=trim($studentData['phone']);

               
                
                    $sql44="update student set Name='$name',gender='$gender',email='$email',password='$password',phone='$phone',birth='$birth',username='$username' WHERE studentID=$ID";
                    if ($conn->query($sql44) === TRUE) {
                        echo json_encode(['status' => 'success', 'message' => "تم التحديث"]);
                    } else {
                            echo json_encode(['status' => 'error', 'message' => "حدث خطاء"]);
                    }
                        $conn->close();
                }
                        
       }

  // التحقق من وجود بيانات محددة لحذفها
  if (isset($studentData['selectedRecord'])) {
        // التحقق من أنه تم تحديد سجلات للحذف
        if (!empty($studentData['selectedRecord'])) {
            // تحويل القيم المحددة إلى مجموعة من الأرقام المفصولة بفواصل (1, 2, 3, ...)
                    $recordIDs = implode(", ", $studentData['selectedRecord']);

                    // استعلام DELETE لحذف العناصر المحددة من الجدول (استبدل "اسم_الجدول" بالجدول الفعلي)
                    $sql = "DELETE FROM student WHERE studentID IN ($recordIDs)";

                    if ($conn->query($sql) === TRUE) {
                        echo json_encode(['status' => 'success', 'message' => 'تم الحذف بنجاح.']);
                } else {
                        echo json_encode(['status' => 'error', 'message' => 'لم يتم الحذف']);
                }
                $conn->close();
            } else {
                echo json_encode(['status' => 'error', 'message' => "لم يحدد عنصر"]);
            }
    }



}


?>