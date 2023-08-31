<?php
// بدء الجلسة (في حالة لم تكن بدأت بالفعل)
session_start();
    // إزالة جميع المتغيرات الخاصة بالجلسة
    $_SESSION = array();

    // تدمير الجلسة
    session_destroy();

    header("Location:login.php");

?>