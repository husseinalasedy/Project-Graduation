<nav class="navbar navbar-expand-md navbar-light bg-light">
        <div class="container">
        <a class="navbar-brand" href="#">منصتي</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav me-auto ms-3">
                    <a class="level-nav-link nav-link " href="../index.php">الصفحة الرئيسية</a>
                    <a class="level-nav-link nav-link" href="../index.php#sectionCategory">كورسات</a>
                    <a class="level-nav-link nav-link " href="../index.php#we_about">حولنه</a>
                </div>
                <?php
                    session_start(); 
                    if (isset($_SESSION['user_id'])) {
                        echo " <a class='level-nav-link nav-link ' href='infouser.php'>معلوماتي</a>";  
                    }

                ?>
                </div>
                <div class="boxlinklogin">
                    <?php
                    if (isset($_SESSION['user_id'])) {

                        echo "<a class='  name-user '><i class='fa-solid fa-user'></i>".$_SESSION['name']."</a>";
                        echo "<a class=' btn  active back-user ' href='endSetion.php'>تسجيل خروج</a>";
                        
                        
                    }else{
                        echo "<a class='btn  active m-1' href='login.php'> تسجيل</a>";
                    }
                    
                
                ?>
           
            </div>
        </div>
    </nav>


    