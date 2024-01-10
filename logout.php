<?php
    // skrypt do wylogowania
    session_start();
    session_unset();
    header('Location: login.php')
?>