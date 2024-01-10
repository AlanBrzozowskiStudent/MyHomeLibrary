<?php
    session_start(); //otwarcie sesji
    require_once "connect.php"; //import logowania do db
    $connection = @new mysqli($host,$db_user, $db_password, $db_name);
    if($connection->connect_errno!=0)
    {
        echo "Error: ".$connection->connect_errno . "Opis: ".$connection->connect_error;
    }
    else
    {
        $tytul = $_POST['tytul'];
        $autor = $_POST['autor'];
        $ocena = $_POST['ocena'];
        $status = $_POST['status'];
        $user_id_sql = $_SESSION['id']; //pobranie id

        // zabezpieczenia przed sql injection
        $tytul = htmlentities($tytul, ENT_QUOTES, "UTF-8");
        $autor = htmlentities($autor, ENT_QUOTES, "UTF-8");
        $ocena = htmlentities($ocena, ENT_QUOTES, "UTF-8");
        $status = htmlentities($status, ENT_QUOTES, "UTF-8");

        if ($result = @$connection->query(sprintf("INSERT INTO books (user_id, tytul, autor, ocena, status) VALUES ('%s','%s', '%s', '%s', '%s')",
        mysqli_real_escape_string($connection,$user_id_sql),
         mysqli_real_escape_string($connection,$tytul),
         mysqli_real_escape_string($connection,$autor),
         mysqli_real_escape_string($connection,$ocena),
         mysqli_real_escape_string($connection,$status))))
        {
            header('Location: library.php');
        } else {
            echo "Błąd podczas dodawania książki: " . $connection->error;
        }
        $connection->close();
    }
?>