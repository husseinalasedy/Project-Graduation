<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block  sidebar collapse shadow">

    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="dashboard.php">
                    <i class="fa-solid fa-house ms-3"></i>
                    الصفحة الرئسية
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="showStudent.php">
                    <i class="fa-solid fa-user-graduate ms-3"></i>
                    الطلاب
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="showTeacher.php">
                    <i class="fa-solid fa-person-chalkboard ms-3"></i>
                    الاساتذه
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="showCours.php">
                    <i class="fa-solid fa-laptop-code ms-3"></i>
                    كورسات
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="RegisterCourse.php">
                    <i class="fa-solid fa-user ms-3"></i>
                    المسجلين
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="showCategory.php">
                    <i class="fa-solid fa-graduation-cap ms-3"></i>
                    الاصناف
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link " href="Certificate.php">

                    <i class="fa-solid fa-graduation-cap ms-3  position-relative"></i>
                    طلبات الشهايد
                    <?php
                    include 'conn.php';
                    $sql = "SELECT COUNT(*) as null_count FROM certificate WHERE Certificate IS NULL";
                    $result = $conn->query($sql);

                    if ($result === false) {
                        echo "حدث خطأ أثناء تنفيذ الاستعلام: " . $conn->error;
                    } else {
                        $row = $result->fetch_assoc();
                        echo ' <span class="  badge rounded-pill bg-danger">
                                    '.$row['null_count'].'
                               </span>';
                    }

                    // إغلاق الاتصال بقاعدة البيانات
                    $conn->close();

                ?>
                </a>

            </li>
        </ul>

    </div>
</nav>