<?php     session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="./css/cssboot/bootstrap.min.css">
    <link rel="stylesheet" href="./css/all.min.css">
    <link rel="stylesheet" href="./css/cssboot/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الصفحة الرئيسية</title>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light bg-light ">
        <div class="container">
            <a class="navbar-brand" href="#">منصتي</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav me-auto ms-3">
                    <a class="level-nav-link nav-link " href="index.php">الصفحة الرئيسية</a>
                    <a class="level-nav-link nav-link" href="#sectionCategory">كورسات</a>
                    <a class="level-nav-link nav-link " href="#we_about">حولنه</a>
                    <?php
                    if (isset($_SESSION['user_id'])) {
                        echo " <a class='level-nav-link nav-link ' href='page/infouser.php'>معلوماتي</a>";  
                    }

                ?>
                </div>
                <div class="boxlinklogin">
                    <?php
                    if (isset($_SESSION['user_id'])) {

                        echo "<a class='  name-user '><i class='fa-solid fa-user'></i>".$_SESSION['name']."</a>";
                        echo "<a class=' btn  active back-user ' href='page/endSetion.php'>تسجيل خروج</a>";
                        
                    }else{
                        echo "<a class='btn btnlogin active m-1' href='page/login.php'> تسجيل</a>";
                    }
                    
                
                ?>
                </div>

            </div>
        </div>
    </nav>
    <main class="main">
        <section class="header">
            <div class="container">
                <div class="contentHeader">
                    <h1 class="titel-header">اطمح، تعلّم، تقدّم</h1>
                    <p class="lead">قم ببناء مهاراتك العمليّة من خلال الالتحاق ببرامج تدريبيّة متطوّرة، واكتسب
                        شهادات تساعدك للدخول في سوق العمل وتطوير مسيرتك المهنية.</p>
                    <a href="#boxinfo" class="btn btn-main ">اكتشف البرامج</a>
                </div>
            </div>
        </section>
        <article id="boxinfo" class="boxinfo">
            <div class="featuresContainer d-flex flex-wrap justify-content-center container ">
                <div class="featureItem  "><img
                        src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAzMCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTI5Ljk1MzEgMTAuMTcxOUwzMCAxMC4zMTI1QzMwIDEwLjM3NSAzMCAxMC40MjE5IDMwIDEwLjQ1MzFDMzAgMTAuNzY1NiAyOS44NDM4IDExIDI5LjUzMTIgMTEuMTU2MkwyNC4wNDY5IDEzLjQwNjJDMjMuOTIxOSAxMy40Njg4IDIzLjgyODEgMTMuNSAyMy43NjU2IDEzLjVDMjMuNDIxOSAxMy41IDIzLjE4NzUgMTMuMzQzOCAyMy4wNjI1IDEzLjAzMTJMMTkuMDMxMiAzLjMyODEyQzE5LjAzMTIgMy4yOTY4NyAxOS4wMzEyIDMuMjUgMTkuMDMxMiAzLjE4NzVMMTguOTg0NCAzLjA0Njg4QzE4Ljk4NDQgMi42NzE4OCAxOS4xNDA2IDIuNDM3NSAxOS40NTMxIDIuMzQzNzVMMjQuOTM3NSAwLjA0Njg3NUMyNC45Njg4IDAuMDQ2ODc1IDI1LjAzMTIgMC4wMzEyNSAyNS4xMjUgMEgyNS4yMTg4QzI1LjU5MzggMCAyNS44MjgxIDAuMTU2MjUgMjUuOTIxOSAwLjQ2ODc1TDI5Ljk1MzEgMTAuMTcxOVpNMTcuODEyNSA0LjMxMjVMMjEuNTE1NiAxMy4xNzE5TDE4LjM3NSAxNC4yNUMxOC4zNzUgMTUuMDMxMiAxOC4xMjUgMTUuNzM0NCAxNy42MjUgMTYuMzU5NEwxOS44NzUgMjMuMDE1NlYyMy4yNUMxOS44NzUgMjMuNzUgMTkuNjI1IDI0IDE5LjEyNSAyNEgxOC4zNzVDMTggMjQgMTcuNzUgMjMuODI4MSAxNy42MjUgMjMuNDg0NEwxNS42NTYyIDE3LjU3ODFDMTUuNTkzOCAxNy41NzgxIDE1LjQ4NDQgMTcuNTkzOCAxNS4zMjgxIDE3LjYyNUMxNS4xNzE5IDE3LjYyNSAxNS4wNjI1IDE3LjYyNSAxNSAxNy42MjVDMTQuOTM3NSAxNy42MjUgMTQuODI4MSAxNy42MjUgMTQuNjcxOSAxNy42MjVDMTQuNTE1NiAxNy41OTM4IDE0LjQwNjIgMTcuNTc4MSAxNC4zNDM4IDE3LjU3ODFMMTIuMzc1IDIzLjQ4NDRDMTIuMjUgMjMuODI4MSAxMiAyNCAxMS42MjUgMjRIMTAuODc1QzEwLjM3NSAyNCAxMC4xMjUgMjMuNzUgMTAuMTI1IDIzLjI1VjIzLjAxNTZMMTIuMzc1IDE2LjM1OTRMMTIuMzI4MSAxNi4zMTI1TDYuMzc1IDE4LjMyODFDNS44NzUgMTguNTE1NiA1LjU0Njg4IDE4LjM5MDYgNS4zOTA2MiAxNy45NTMxTDQuOTY4NzUgMTYuOTY4OEwxLjk2ODc1IDE4LjE4NzVDMS45MDYyNSAxOC4yNSAxLjgxMjUgMTguMjgxMiAxLjY4NzUgMTguMjgxMkMxLjQwNjI1IDE4LjI4MTIgMS4xNzE4OCAxOC4xMjUgMC45ODQzNzUgMTcuODEyNUwwLjA0Njg3NSAxNS41MTU2TDAgMTUuMzc1QzAgMTUuMzEyNSAwIDE1LjI2NTYgMCAxNS4yMzQ0QzAgMTQuOTIxOSAwLjE1NjI1IDE0LjY4NzUgMC40Njg3NSAxNC41MzEyTDMuNDY4NzUgMTMuMzEyNUwzLjA0Njg4IDEyLjMyODFDMi44OTA2MiAxMS44OTA2IDMuMDMxMjUgMTEuNTYyNSAzLjQ2ODc1IDExLjM0MzhMMTcuODEyNSA0LjMxMjVaTTE0LjIwMzEgMTUuMDQ2OUMxNC40MjE5IDE1LjI2NTYgMTQuNjg3NSAxNS4zNzUgMTUgMTUuMzc1QzE1LjMxMjUgMTUuMzc1IDE1LjU3ODEgMTUuMjY1NiAxNS43OTY5IDE1LjA0NjlDMTYuMDE1NiAxNC44MjgxIDE2LjEyNSAxNC41NjI1IDE2LjEyNSAxNC4yNUMxNi4xMjUgMTMuOTM3NSAxNi4wMTU2IDEzLjY3MTkgMTUuNzk2OSAxMy40NTMxQzE1LjU3ODEgMTMuMjM0NCAxNS4zMTI1IDEzLjEyNSAxNSAxMy4xMjVDMTQuNjg3NSAxMy4xMjUgMTQuNDIxOSAxMy4yMzQ0IDE0LjIwMzEgMTMuNDUzMUMxMy45ODQ0IDEzLjY3MTkgMTMuODc1IDEzLjkzNzUgMTMuODc1IDE0LjI1QzEzLjg3NSAxNC41NjI1IDEzLjk4NDQgMTQuODI4MSAxNC4yMDMxIDE1LjA0NjlaIiBmaWxsPSIjMDZDREQwIi8+Cjwvc3ZnPgo="
                        alt="اكتشف" class="featureIcon">
                    <div class="featureContent">
                        <div class="featureTitle">اكتشف</div>
                        <p class="featureDescription">مجموعة كبيرة
                            ومتنوعة من أكثر الدورات والتخصصات كفاءة وجودة.
                        </p>
                    </div>
                </div>
                <div class="featureItem"><img
                        src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAyMCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTE5LjUgMTIuNzVWMThDMTkuNSAxOS42NTYyIDE4LjkwNjIgMjEuMDYyNSAxNy43MTg4IDIyLjIxODhDMTYuNTYyNSAyMy40MDYyIDE1LjE1NjIgMjQgMTMuNSAyNEg3LjU0Njg4QzYuNDg0MzggMjQgNS41MTU2MiAyMy43NSA0LjY0MDYyIDIzLjI1TDEuNTQ2ODggMjEuNjA5NEMwLjUxNTYyNSAyMC45ODQ0IDAgMjAuMDkzOCAwIDE4LjkzNzVWMTYuNDUzMUMwIDE1LjQ4NDQgMC4zNzUgMTQuNzAzMSAxLjEyNSAxNC4xMDk0TDMgMTIuNjA5NFYxNi4xMjVDMyAxNi4zNzUgMy4xMjUgMTYuNSAzLjM3NSAxNi41QzMuNjI1IDE2LjUgMy43NSAxNi4zNzUgMy43NSAxNi4xMjVWMi4yNUMzLjc1IDEuNjI1IDMuOTY4NzUgMS4wOTM3NSA0LjQwNjI1IDAuNjU2MjVDNC44NDM3NSAwLjIxODc1IDUuMzc1IDAgNiAwQzYuNjI1IDAgNy4xNTYyNSAwLjIxODc1IDcuNTkzNzUgMC42NTYyNUM4LjAzMTI1IDEuMDkzNzUgOC4yNSAxLjYyNSA4LjI1IDIuMjVWOC44MTI1QzguNzE4NzUgOC40Mzc1IDkuMjE4NzUgOC4yNSA5Ljc1IDguMjVIMTAuNUMxMS4zMTI1IDguMjUgMTEuOTM3NSA4LjU5Mzc1IDEyLjM3NSA5LjI4MTI1QzEyLjY4NzUgOS4wOTM3NSAxMy4wNjI1IDkgMTMuNSA5SDE0LjI1QzE1LjMxMjUgOSAxNi4wMTU2IDkuNSAxNi4zNTk0IDEwLjVIMTYuNUgxNy4yNUMxNy44NzUgMTAuNSAxOC40MDYyIDEwLjcxODggMTguODQzOCAxMS4xNTYyQzE5LjI4MTIgMTEuNTkzOCAxOS41IDEyLjEyNSAxOS41IDEyLjc1WiIgZmlsbD0iIzA2Q0REMCIvPgo8L3N2Zz4K"
                        alt="التحق" class="featureIcon">
                    <div class="featureContent">
                        <div class="featureTitle">التحق</div>
                        <p class="featureDescription">بأحد البرامج
                            لتنضمّ إلى مجتمع من المتعلّمين الرّاغبين بالتطوّر، مثلك تمامًا.</p>
                    </div>
                </div>
                <div class="featureItem"><img
                        src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjIiIGhlaWdodD0iMjUiIHZpZXdCb3g9IjAgMCAyMiAyNSIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTEuMTU2MjUgNC43NUMwLjcxODc1IDQuNjI1IDAuNSA0LjM3NSAwLjUgNEMwLjUgMy42MjUgMC43MTg3NSAzLjM3NSAxLjE1NjI1IDMuMjVMMTAuMDYyNSAxLjA5Mzc1QzEwLjY4NzUgMC45Mzc1IDExLjMxMjUgMC45Mzc1IDExLjkzNzUgMS4wOTM3NUwyMC44NDM4IDMuMjVDMjEuMjgxMiAzLjM3NSAyMS41IDMuNjI1IDIxLjUgNEMyMS41IDQuMzc1IDIxLjI4MTIgNC42MjUgMjAuODQzOCA0Ljc1TDE3IDUuNjg3NVY4LjVDMTcgMTAuMTU2MiAxNi40MDYyIDExLjU3ODEgMTUuMjE4OCAxMi43NjU2QzE0LjA2MjUgMTMuOTIxOSAxMi42NTYyIDE0LjUgMTEgMTQuNUM5LjM0Mzc1IDE0LjUgNy45MjE4OCAxMy45MjE5IDYuNzM0MzggMTIuNzY1NkM1LjU3ODEyIDExLjU3ODEgNSAxMC4xNTYyIDUgOC41VjUuNjg3NUwyLjU2MjUgNS4wNzgxMlY3LjU2MjVDMi45Mzc1IDcuNzgxMjUgMy4xMjUgOC4wOTM3NSAzLjEyNSA4LjVDMy4xMjUgOC44NDM3NSAyLjk1MzEyIDkuMTU2MjUgMi42MDkzOCA5LjQzNzVMMy4zNTkzOCAxMi4zNDM4QzMuNDIxODggMTIuNzgxMiAzLjI5Njg4IDEzIDIuOTg0MzggMTNIMS4wMTU2MkMwLjcwMzEyNSAxMyAwLjU3ODEyNSAxMi43ODEyIDAuNjQwNjI1IDEyLjM0MzhMMS4zOTA2MiA5LjQzNzVDMS4wNDY4OCA5LjE1NjI1IDAuODc1IDguODQzNzUgMC44NzUgOC41QzAuODc1IDguMDkzNzUgMS4wNjI1IDcuNzgxMjUgMS40Mzc1IDcuNTYyNVY0Ljc5Njg4TDEuMTU2MjUgNC43NVpNMTUuODI4MSAxNS42NzE5QzE3LjQ4NDQgMTYuMjAzMSAxOC44NDM4IDE3LjE3MTkgMTkuOTA2MiAxOC41NzgxQzIwLjk2ODggMTkuOTg0NCAyMS41IDIxLjU3ODEgMjEuNSAyMy4zNTk0QzIxLjUgMjMuNzk2OSAyMS4zMjgxIDI0LjE3MTkgMjAuOTg0NCAyNC40ODQ0QzIwLjY3MTkgMjQuODI4MSAyMC4yOTY5IDI1IDE5Ljg1OTQgMjVIMi4xNDA2MkMxLjcwMzEyIDI1IDEuMzEyNSAyNC44MjgxIDAuOTY4NzUgMjQuNDg0NEMwLjY1NjI1IDI0LjE3MTkgMC41IDIzLjc5NjkgMC41IDIzLjM1OTRDMC41IDIxLjU3ODEgMS4wMzEyNSAxOS45ODQ0IDIuMDkzNzUgMTguNTc4MUMzLjE1NjI1IDE3LjE3MTkgNC41MTU2MiAxNi4yMDMxIDYuMTcxODggMTUuNjcxOUwxMSAyMC41TDE1LjgyODEgMTUuNjcxOVoiIGZpbGw9IiMwNkNERDAiLz4KPC9zdmc+Cg=="
                        alt="تعلّم" class="featureIcon">
                    <div class="featureContent">
                        <div class="featureTitle">تعلّم</div>
                        <p class="featureDescription">مع أكثر المدرّبين
                            كفاءة لتصقل مهاراتك المهنية والعمليّة.</p>
                    </div>
                </div>
                <div class="featureItem"><img
                        src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAyMCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTEuMDkzNzUgMjAuMjk2OUwyLjU5Mzc1IDE2LjQ1MzFDNC4zNDM3NSAxOC4yMDMxIDYuNSAxOS4yMDMxIDkuMDYyNSAxOS40NTMxTDcuNTE1NjIgMjMuMjk2OUM3LjI5Njg4IDIzLjc2NTYgNi45Njg3NSAyNCA2LjUzMTI1IDI0SDYuNDg0MzhDNi4wMTU2MiAyNCA1LjY3MTg4IDIzLjc5NjkgNS40NTMxMiAyMy4zOTA2TDQuNDY4NzUgMjEuNDIxOUwyLjM1OTM4IDIxLjg0MzhDMS44OTA2MiAyMS45MDYyIDEuNTMxMjUgMjEuNzY1NiAxLjI4MTI1IDIxLjQyMTlDMC45Mzc1IDIxLjA3ODEgMC44NzUgMjAuNzAzMSAxLjA5Mzc1IDIwLjI5NjlaTTE1LjI1IDE1Ljg0MzhDMTUgMTYuMzQzOCAxNC43NSAxNi42NTYyIDE0LjUgMTYuNzgxMkMxNC4yNSAxNi45MDYyIDEzLjg1OTQgMTYuOTY4OCAxMy4zMjgxIDE2Ljk2ODhDMTIuNzk2OSAxNi45Mzc1IDEyLjQwNjIgMTYuOTUzMSAxMi4xNTYyIDE3LjAxNTZDMTEuOTY4OCAxNy4wNzgxIDExLjY0MDYgMTcuMjY1NiAxMS4xNzE5IDE3LjU3ODFDMTAuNzAzMSAxNy44NTk0IDEwLjMxMjUgMTggMTAgMThDOS42ODc1IDE4IDkuMjk2ODggMTcuODU5NCA4LjgyODEyIDE3LjU3ODFDOC4zNTkzOCAxNy4yNjU2IDguMDMxMjUgMTcuMDc4MSA3Ljg0Mzc1IDE3LjAxNTZDNy42MjUgMTYuOTUzMSA3LjIxODc1IDE2LjkzNzUgNi42MjUgMTYuOTY4OEM2LjAzMTI1IDE2Ljk2ODggNS42NTYyNSAxNi45MDYyIDUuNSAxNi43ODEyQzUuMjUgMTYuNjU2MiA0Ljk4NDM4IDE2LjM0MzggNC43MDMxMiAxNS44NDM4QzQuNDUzMTIgMTUuMzEyNSA0LjI2NTYyIDE0Ljk4NDQgNC4xNDA2MiAxNC44NTk0QzQuMDE1NjIgMTQuNzM0NCAzLjY4NzUgMTQuNTQ2OSAzLjE1NjI1IDE0LjI5NjlDMi42NTYyNSAxNC4wMTU2IDIuMzQzNzUgMTMuNzUgMi4yMTg3NSAxMy41QzIuMDkzNzUgMTMuMjUgMi4wMzEyNSAxMi44NTk0IDIuMDMxMjUgMTIuMzI4MUMyLjA2MjUgMTEuNzk2OSAyLjA0Njg4IDExLjQwNjIgMS45ODQzOCAxMS4xNTYyQzEuOTIxODggMTAuOTY4OCAxLjczNDM4IDEwLjY0MDYgMS40MjE4OCAxMC4xNzE5QzEuMTQwNjIgOS43MDMxMiAxIDkuMzEyNSAxIDlDMSA4LjY4NzUgMS4xNDA2MiA4LjI5Njg4IDEuNDIxODggNy44MjgxMkMxLjczNDM4IDcuMzU5MzggMS45MjE4OCA3LjAzMTI1IDEuOTg0MzggNi44NDM3NUMyLjA0Njg4IDYuNjI1IDIuMDYyNSA2LjIxODc1IDIuMDMxMjUgNS42MjVDMi4wMzEyNSA1LjAzMTI1IDIuMDkzNzUgNC42NTYyNSAyLjIxODc1IDQuNUMyLjM0Mzc1IDQuMjUgMi42NTYyNSA0IDMuMTU2MjUgMy43NUMzLjY4NzUgMy40Njg3NSA0LjAxNTYyIDMuMjY1NjMgNC4xNDA2MiAzLjE0MDYyQzQuMjY1NjIgMy4wMTU2MiA0LjQ1MzEyIDIuNzAzMTMgNC43MDMxMiAyLjIwMzEyQzQuOTg0MzggMS42NzE4OCA1LjI1IDEuMzQzNzUgNS41IDEuMjE4NzVDNS43NSAxLjA5Mzc1IDYuMTQwNjIgMS4wNDY4NyA2LjY3MTg4IDEuMDc4MTJDNy4yMDMxMiAxLjA3ODEyIDcuNTkzNzUgMS4wNDY4NyA3Ljg0Mzc1IDAuOTg0Mzc1QzguMDMxMjUgMC45MjE4NzUgOC4zNTkzOCAwLjc1IDguODI4MTIgMC40Njg3NUM5LjI5Njg4IDAuMTU2MjUgOS42ODc1IDAgMTAgMEMxMC4zMTI1IDAgMTAuNzAzMSAwLjE1NjI1IDExLjE3MTkgMC40Njg3NUMxMS42NDA2IDAuNzUgMTEuOTY4OCAwLjkyMTg3NSAxMi4xNTYyIDAuOTg0Mzc1QzEyLjM3NSAxLjA0Njg3IDEyLjc4MTIgMS4wNzgxMiAxMy4zNzUgMS4wNzgxMkMxMy45Njg4IDEuMDQ2ODcgMTQuMzQzOCAxLjA5Mzc1IDE0LjUgMS4yMTg3NUMxNC43NSAxLjM0Mzc1IDE1IDEuNjcxODggMTUuMjUgMi4yMDMxMkMxNS41MzEyIDIuNzAzMTMgMTUuNzM0NCAzLjAxNTYyIDE1Ljg1OTQgMy4xNDA2MkMxNS45ODQ0IDMuMjY1NjMgMTYuMjk2OSAzLjQ2ODc1IDE2Ljc5NjkgMy43NUMxNy4zMjgxIDQgMTcuNjU2MiA0LjI1IDE3Ljc4MTIgNC41QzE3LjkwNjIgNC43NSAxNy45NTMxIDUuMTQwNjMgMTcuOTIxOSA1LjY3MTg4QzE3LjkyMTkgNi4yMDMxMiAxNy45NTMxIDYuNTkzNzUgMTguMDE1NiA2Ljg0Mzc1QzE4LjA3ODEgNy4wMzEyNSAxOC4yNSA3LjM1OTM4IDE4LjUzMTIgNy44MjgxMkMxOC44NDM4IDguMjk2ODggMTkgOC42ODc1IDE5IDlDMTkgOS4zMTI1IDE4Ljg0MzggOS43MDMxMiAxOC41MzEyIDEwLjE3MTlDMTguMjUgMTAuNjQwNiAxOC4wNzgxIDEwLjk2ODggMTguMDE1NiAxMS4xNTYyQzE3Ljk1MzEgMTEuMzc1IDE3LjkyMTkgMTEuNzgxMiAxNy45MjE5IDEyLjM3NUMxNy45NTMxIDEyLjk2ODggMTcuOTA2MiAxMy4zNDM4IDE3Ljc4MTIgMTMuNUMxNy42NTYyIDEzLjc1IDE3LjMyODEgMTQuMDE1NiAxNi43OTY5IDE0LjI5NjlDMTYuMjk2OSAxNC41NDY5IDE1Ljk4NDQgMTQuNzM0NCAxNS44NTk0IDE0Ljg1OTRDMTUuNzM0NCAxNC45ODQ0IDE1LjUzMTIgMTUuMzEyNSAxNS4yNSAxNS44NDM4Wk03LjMyODEyIDYuMzc1QzYuNjA5MzggNy4wOTM3NSA2LjI1IDcuOTY4NzUgNi4yNSA5QzYuMjUgMTAuMDMxMiA2LjYwOTM4IDEwLjkyMTkgNy4zMjgxMiAxMS42NzE5QzguMDc4MTIgMTIuMzkwNiA4Ljk2ODc1IDEyLjc1IDEwIDEyLjc1QzExLjAzMTIgMTIuNzUgMTEuOTA2MiAxMi4zOTA2IDEyLjYyNSAxMS42NzE5QzEzLjM3NSAxMC45MjE5IDEzLjc1IDEwLjAzMTIgMTMuNzUgOUMxMy43NSA3Ljk2ODc1IDEzLjM3NSA3LjA5Mzc1IDEyLjYyNSA2LjM3NUMxMS45MDYyIDUuNjI1IDExLjAzMTIgNS4yNSAxMCA1LjI1QzguOTY4NzUgNS4yNSA4LjA3ODEyIDUuNjI1IDcuMzI4MTIgNi4zNzVaTTE3LjQwNjIgMTYuNDUzMUwxOC45MDYyIDIwLjI5NjlDMTkuMTI1IDIwLjcwMzEgMTkuMDYyNSAyMS4wNzgxIDE4LjcxODggMjEuNDIxOUMxOC40Njg4IDIxLjc2NTYgMTguMTA5NCAyMS45MDYyIDE3LjY0MDYgMjEuODQzOEwxNS41MzEyIDIxLjQyMTlMMTQuNTQ2OSAyMy4zOTA2QzE0LjMyODEgMjMuNzk2OSAxMy45ODQ0IDI0IDEzLjUxNTYgMjRIMTMuNDY4OEMxMy4wMzEyIDI0IDEyLjcwMzEgMjMuNzY1NiAxMi40ODQ0IDIzLjI5NjlMMTAuODkwNiAxOS40NTMxQzEzLjQyMTkgMTkuMjM0NCAxNS41OTM4IDE4LjIzNDQgMTcuNDA2MiAxNi40NTMxWiIgZmlsbD0iIzA2Q0REMCIvPgo8L3N2Zz4K"
                        alt="احصل على الشهادة" class="featureIcon">
                    <div class="featureContent">
                        <div class="featureTitle">احصل على الشهادة</div>
                        <p class="featureDescription">لتعزّز
                            فرصك في إطلاق مسيرتك المهنية، أو تنميتها وتطويرها.</p>
                    </div>
                </div>
            </div>
        </article>
        <section id="sectionCategory" class="sectionCategory">
            <div class="container">
            <h2 class="titel">الاصناف</h2>
                <div class="row  row-cols-1 row-cols-md-3 row-cols-lg-4 g-3">
                    <?php
                      include 'admin/globle/conn.php';
                      $sql = "SELECT * FROM category";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                          $number = 1;
                          while ($row = $result->fetch_assoc()) {
                              $id = htmlspecialchars($row['id']);
                              $name = htmlspecialchars($row['Name']);
                              $img = htmlspecialchars($row['img']);
                              echo '<div class="col ">
                                                <div class="boximg shadow ">
                                                    <img src="' . $img . '" alt="">
                                                    <a href="page/cors.php?id='.$id.'">
                                                        <h2>'.$name.'</h2>
                                                    </a>
                                                </div>
                                            </div>';
                          }
                        }else{
                            echo "<center>لاتوجد اصناف</center>";
                        }
                       
                    ?>
                   
                </div>
        </section>
        <section class="footeridex container" id="we_about">
            <img src="img/hero_image.png" alt="">
            <div class="boxAbout">
                <h3>منصتي</h3>
                <p>هي المنصه الاقوه في التدريب والتطوير تعتمد على قواعد التدريس الحديثه وكل ماهو جديد بدوران غنية من المعلومات الحصريا وكل ماهو جديد </p>
                <p>
                أفضل المحاضرين المعتمدين وافضل محاضر اونلاين في كل تخصص بضمان الجودة العالية من الفيديوهات سواء من ناحية الماده العلميه المقدمه في الكورس او من ناحيه جوده التصوير.
                </p>
            </div>
        </section>
    </main>
    <?php 
        include 'headerPage/footer.php';
    ?>
    <script src="jsboot/bootstrap.min.js"></script>
</body>

</html>