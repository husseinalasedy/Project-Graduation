       <!-------- code php ------------->
       <?php
       include '../admin/globle/conn.php';
       $result="";
       
             if (isset($_POST['sign'])) {
                $username =trim(mysqli_real_escape_string($conn, $_POST['username']));
                $password =trim(mysqli_real_escape_string($conn, $_POST['password']));
                if (empty($username)||empty($password)) {
                   $result= "<div class='alert alert-danger' role='alert'>يجب ملء الحقول</div>";
                }else{
                // if check admin 
                if (isset($_POST["admin"])) {
                            // استعلام SQL لاسترداد بيانات المستخدم
                            $sql = "SELECT * FROM admin WHERE userName = '$username' && password='$password'";
                            $result = $conn->query($sql);
                            $conn->close();
                            if ($result->num_rows > 0) {
                                $admin = $result->fetch_assoc();
                                session_start();
                                    // تم تسجيل الدخول بنجاح
                                        $_SESSION['admin_id'] = $admin['id'];
                                        $_SESSION['admin_name'] = $admin['userName'];
                                        // توجيه المستخدم إلى الصفحة المناسبة بعد تسجيل الدخول
                                        header("Location: ../admin/dashboard.php");
                                        
                            } else {
                                $result= "<div class='alert alert-danger' role='alert'>كلمة المرور او سم المستخدم غير صحيحة.!</div>";
                            }
                }else{
                             // استعلام SQL لاسترداد بيانات المستخدم
                             $sql = "SELECT * FROM student WHERE username = '$username' && password='$password'";
                             $result = $conn->query($sql);
                             $conn->close();
                             if ($result->num_rows > 0) {
                                 $user = $result->fetch_assoc();
                                 session_start();
                                     // تم تسجيل الدخول بنجاح
                                         $_SESSION['user_id'] = $user['studentID'];
                                         $_SESSION['name'] = $user['username'];
             
                                         // توجيه المستخدم إلى الصفحة المناسبة بعد تسجيل الدخول
                                         header("Location: ../index.php");
                                         
                             } else {
                                 $result= "<div class='alert alert-danger' role='alert'>كلمة المرور او سم المستخدم غير صحيحة.!</div>";
                             }
                         }
                }
                 
                 
                   
             }

                            //  ---------- انشاء حساب جديد
              if(isset($_POST["login"])){
                    echo '<style>#form1 { display: none; }</style>';
                    echo '<style>#form2 { display: block; }</style>';
        
                                // استدعاء المتغيرات
                    $name =trim(mysqli_real_escape_string($conn, $_POST['Name']));
                    $username =trim(mysqli_real_escape_string($conn, $_POST['username']));
                    $birth = mysqli_real_escape_string($conn, $_POST['birth']);
                    $gender =mysqli_real_escape_string($conn, $_POST['gender']);
                    $email =trim(mysqli_real_escape_string($conn, $_POST['email']));
                    $password =trim(mysqli_real_escape_string($conn, $_POST['password']));
                    $phone  =trim(mysqli_real_escape_string($conn, $_POST['phone']));

                    if (empty($name)||empty($username)||empty($birth)||empty($gender)||empty($email)||empty($password)||empty($phone)) {
                        $result= "<div class='alert alert-danger' role='alert'>يجب ملء الحقول</div>";
                        exit();
                     }

                                // استعلام SQL لاسترداد بيانات المستخدم
                     $sql = "SELECT * FROM student WHERE username = '$username'";
                     $result2 = $conn->query($sql);
        
                    if ($result2->num_rows > 0) {
                        $result= "<div class='alert alert-danger' role='alert'>اسم المستخدم مكرر. الرجاء اختيار اسم مستخدم آخر.</div>";
                     }else{
        
                            if (strlen($password) < 8) {
                                $result=  "<div class='alert alert-danger' role='alert'>يجب أن تحتوي كلمة المرور على 8 أحرف على الأقل.</div>";
                            }
                            elseif(!preg_match('/[A-Z]/', $password) && !preg_match('/[a-z]/', $password)) {
                                $result=  "<div class='alert alert-danger' role='alert'>يجب أن تحتوي كلمة المرور على حرف كبير وحرف صغير.</div>";
                            }
                            elseif(!preg_match('/[0-9]/', $password)) {
                                $result=  "<div class='alert alert-danger' role='alert'>يجب أن تحتوي كلمة المرور على رقم واحد على الأقل.</div>";
                            }else{
                                                        // إدخال البيانات إلى قاعدة البيانات
                                $sql = "INSERT INTO student (Name,gender,email,password,phone,birth,username) VALUES ('$name','$gender','$email','$password','$phone','$birth','$username')";
                                if ($conn->query($sql) === TRUE) {
                                                            
                                } else {
                                    $result=  "<div class='alert alert-danger' role='alert'>حدث خطاء $conn->error!</div>";
                                }
                                $conn->close();
                                echo '<style>#form2 { display: none; }</style>';
                                echo '<style>#form1 { display: block; }</style>';
                             }          
                     }
                }
        
         
         ?>
       <!---------- end code php ------->
       <!DOCTYPE html>
       <html lang="en">

       <head>
           <meta charset="UTF-8">
           <meta http-equiv="X-UA-Compatible" content="IE=edge">
           <link rel="stylesheet" href="../css/cssboot/bootstrap.min.css">
           <link rel="stylesheet" href="../css/cssboot/style.css">
           <link rel="stylesheet" href="../css/all.min.css">
           <meta name="viewport" content="width=device-width, initial-scale=1.0">
           <title>تسجيل</title>
       </head>


       <body>
           <nav class="navbar navbar-expand-md navbar-light bg-light shadow">
               <div class="container">
                   <a class="navbar-brand" href="#">منصتي</a>
                   <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                       data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                       aria-label="Toggle navigation">
                       <span class="navbar-toggler-icon"></span>
                   </button>
                   <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                       <div class="navbar-nav me-auto ms-3">
                           <a class="level-nav-link nav-link " href="../index.php">الصفحة الرئيسية</a>
                           <a class="level-nav-link nav-link" href="../index.php#sectionCategory">كورسات</a>
                           <a class="level-nav-link nav-link " href="../index.php#we_about">حولنه</a>
                       </div>
                   </div>
               </div>
           </nav>
           <main class="main-login container">
               <div class="login">
                   <div class="login-form" id="form1">
                       <!-- print result  -->
                       <?php echo $result; ?>
                       <div class="form-header">
                           <h1 class="form-title__header">سجل الدخول لحسابك</h1>
                           <p><span class="text">ليس لديك حساب على إدراك؟</span>
                               <a class="cliceLogin" href="#">أنشىء حسابك</a>
                           </p>
                       </div>
                       <form class="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                           <div class="pb-4">
                               <label class="control-label form-label" for="text">اسم المستخدام </label>
                               <input class="form-control" id="text" type="text" name="username">
                           </div>
                           <div class="pb-2">
                               <label class="control-label form-label" for="password1">كلمة السر</label>
                               <input class="form-control" id="password1" type="password" name="password">
                               <p>٦ أحرف على الأقل</p>
                           </div>
                           <div class="">
                               <input class="form-check-input" type="checkbox" name="admin" value=""
                                   id="flexCheckDefault">
                               <label class="form-check-label" for="flexCheckDefault">
                                   مشرف
                               </label>
                           </div>
                           <button type="submit" class="btn btn-from" name="sign">تسجيل الدخول</button>
                       </form>
                   </div>
               </div>

               <div class="login-in" id="form2">
                   <div class="formRegester">
                       <!-- print result  -->
                       <?php echo $result; ?>

                       <div class="form-header">
                           <h1 class="form-title__header">أنشىء حسابك</h1>
                           <p><span class="text ">هل لديك حساب ؟</span>
                               <a class="cliceLogin2">تسجيل الدخول</a>
                           </p>
                       </div>
                       <form class="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                           <div class="row">
                               <div class="col-12 col-md-6 col-sm-12">
                                   <div class="pb-3 ">
                                       <label class="control-label form-label" for="text">الاسم الكامل </label>
                                       <input class="form-control" id="text" type="text" name="Name">
                                   </div>
                                   <div class="pb-3 ">
                                       <label class="control-label form-label" for="text">الاسم الكامل </label>
                                       <input class="form-control" id="text" type="text" name="Name">
                                   </div>
                                   <div class="pb-3">
                                       <label class="control-label form-label" for="email">البريد الإلكتروني</label>
                                       <input class="form-control" id="email" type="email"
                                           placeholder="fatima.Alfahri@gmail.com" name="email" autocomplete="email">
                                   </div>
                                   <div class="pb-3">
                                       <label class="control-label form-label" for="text3">رقم الهاتف</label>
                                       <input class="form-control" id="text3" type="number" name="phone" value="">
                                   </div>
                               </div>
                               <div class="col">
                                   <div class="pb-3 ">
                                       <label class="control-label form-label" for="text2">المواليد</label>
                                       <input class="form-control" id="text2" type="date" name="birth" value="">
                                   </div>
                                   <div class="pb-3 ">
                                       <label class="control-label form-label" for="text">اسم المستخدام </label>
                                       <input class="form-control" id="text" type="text" name="username">
                                   </div>
                                   <div>
                                       <label class="control-label form-label" for="password">كلمة السر</label>
                                       <input class="form-control" id="password" type="password" name="password"
                                           value="">
                                       <p>٦ أحرف على الأقل</p>
                                   </div>
                                   <div class="pb-4">
                                       <label class="control-label form-label" for="inputGroupSelect01">الجنس</label>
                                       <select class="form-select" id="inputGroupSelect01" name="gender">
                                           <option value="ذكر">ذكر</option>
                                           <option value="انثى">انثى</option>
                                       </select>
                                   </div>

                               </div>

                           </div>

                           <input type="submit" class="btn btn-from" name="login" value='تسجيل الدخول'>
                       </form>
                   </div>
               </div>
           </main>
           <script src="../js/index.js"></script>
           <script src="../jsboot/bootstrap.min.js"></script>

       </body>

       </html>