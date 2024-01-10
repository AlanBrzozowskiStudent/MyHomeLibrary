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
        $email = $_POST['email']; //pobranie
        $password = $_POST['password'];
        // zabezpieczenia przed sql injection
        $email = htmlentities($email, ENT_QUOTES, "UTF-8");
        $password = htmlentities($password, ENT_QUOTES, "UTF-8");
        if ($result = @$connection->query(sprintf("SELECT * from users where email='%s' and password='%s'", mysqli_real_escape_string($connection,$email),
        mysqli_real_escape_string($connection,$password))))
        {
            $how_many = $result->num_rows;
            if($how_many > 0)
            {
                $_SESSION['zalogowany'] = true; //flaga dla zalogowanego usera
                $row = $result->fetch_assoc();
                $_SESSION['id'] = $row['id'];
                $_SESSION['email'] = $row['email']; //zmienna do sesji aby dzielić zmienną z innymi stronami
                $_SESSION['name'] = $row['name'];
                $_SESSION['password'] = $row['password'];
                unset($_SESSION['blad']); //usunięcie
                $result->free_result();
                header('Location: main.php'); // przekierowanie na strone główną zalogowaną 
            }
            else{
                $_SESSION['blad'] = '<span class="mb-0 text-center" style="color:red"> Niepoprawny login lub hasło. </span>';
                header('Location: login.php');
            }
        }
        $connection->close();
    }
?>