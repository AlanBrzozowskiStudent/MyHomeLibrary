<?php
session_start();

require_once "connect.php"; // Import konfiguracji połączenia z bazą danych

$connection = new mysqli($host, $db_user, $db_password, $db_name);

if ($connection->connect_errno) {
    die("Error: " . $connection->connect_errno . " Description: " . $connection->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $connection->real_escape_string($_POST['email']);
    $password = $connection->real_escape_string($_POST['password']);

    $stmt = $connection->prepare("SELECT id, name, email, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['zalogowany'] = true;

            header('Location: index.php');
        } else {
            $_SESSION['login_info'] = 'Niepoprawne hasło.';
            header('Location: login.php');
        }
    } else {
        $_SESSION['login_info'] = 'Nie znaleziono użytkownika o podanym adresie e-mail.';
        header('Location: login.php');
    }

    $stmt->close();
    $connection->close();
} else {
    header('Location: index.php');
    exit;
}
?>