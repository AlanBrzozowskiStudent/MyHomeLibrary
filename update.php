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
// Sprawdzenie czy formularz został przesłany
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookId = $_POST["book_id"];
    $title = $_POST["title"];
    $author = $_POST["author"];
    $rating = $_POST["rating"];
    $readStatus = $_POST["read_status"];

    $sql = "UPDATE books SET tytul = '$title', autor = '$author', ocena = '$rating', status = '$readStatus' WHERE book_id = $bookId";

    if ($connection->query($sql) === TRUE) {
        //echo "Dane książki zostały zaktualizowane.";
        header('Location: library.php');
    } else {
        echo "Błąd podczas aktualizacji danych książki: " . $connection->error;
    }
}
$connection->close();
}
