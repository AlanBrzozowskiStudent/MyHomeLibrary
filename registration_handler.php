<?php
session_start();

require_once "connect.php"; // Import konfiguracji połączenia z bazą danych

$connection = new mysqli($host, $db_user, $db_password, $db_name);

if ($connection->connect_errno) {
    die("Error: " . $connection->connect_errno . " Description: " . $connection->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $connection->real_escape_string($_POST['name']);
    $email = $connection->real_escape_string($_POST['email']);
    $password = $connection->real_escape_string($_POST['password']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $connection->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $hashed_password);
    
    if ($stmt->execute()) {
        $_SESSION['login_info'] = '<span class="mb-0 text-center fs-6" style="color:green">Użytkownik zarejestrowany, można się logować.</span>';;
        header('Location: login.php');
    } else {
        $_SESSION['error'] = 'Rejestracja nie powiodła. Możliwe że użykownik już istnieje.';
        header('Location: register.php');
    }

    $stmt->close();
    $connection->close();
} else {
    
    header('Location: index.php');
    exit;
}
?>