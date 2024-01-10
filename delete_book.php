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
        $book_id = $_POST['book_id'];
        $sql = "DELETE FROM books WHERE book_id = '$book_id'";
        if ($connection->query($sql) === TRUE) {
            header('Location: library.php');
        } else {
            echo "Wystąpił błąd podczas usuwania książki: " . $connection->error;
        }
        $connection->close();
    }
?>