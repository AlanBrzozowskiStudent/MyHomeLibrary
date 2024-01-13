<?php
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

require_once "connect.php";

$connection = new mysqli($host, $db_user, $db_password, $db_name);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmNewPassword = $_POST['confirmNewPassword'];
    
    if ($newPassword !== $confirmNewPassword) {
        // Hasła nie są identyczne
        $_SESSION['error_password'] = 'Proszę wpisać dwa razy to samo hasło.';
        header('Location: main.php');
        exit();
    }

    $userId = $_SESSION['id'];
    // Pobierz aktualne hasło użytkownika z bazy
    $stmt = $connection->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (password_verify($currentPassword, $user['password'])) {
        // Aktualne hasło się zgadza, zaktualizuj hasło w bazie
        $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $updateStmt = $connection->prepare("UPDATE users SET password = ? WHERE id = ?");
        $updateStmt->bind_param("si", $hashedNewPassword, $userId);
        if ($updateStmt->execute()) {
            $_SESSION['info_password'] = 'Hasło zostało pomyślnie zmienione.';
            header('Location: main.php');
        } else {
            $_SESSION['error_password'] = 'Nie udało się zaktualizować hasła.';
            header('Location: main.php');
        }
        $updateStmt->close();
    } else {
        // Aktualne hasło się nie zgadza
        $_SESSION['error_password'] = 'Nieprawidłowe aktualne hasło!';
        header('Location: main.php');
    }

    $stmt->close();
}

$connection->close();
?>