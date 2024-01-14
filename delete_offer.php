<?php
session_start();
require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['offer_id'])) {
    // Obsługa usunięcia oferty po potwierdzeniu
    $offerId = $_POST['offer_id'];
    
    // Upewnij się, że użytkownik jest właścicielem oferty
    $userId = $_SESSION['id'];

    try {
        $db = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $db_user, $db_password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Sprawdź, czy użytkownik jest właścicielem oferty
        $stmt_check_owner = $db->prepare("SELECT user_id FROM offers WHERE id = :offer_id");
        $stmt_check_owner->bindParam(':offer_id', $offerId);
        $stmt_check_owner->execute();
        $result = $stmt_check_owner->fetch(PDO::FETCH_ASSOC);

        if ($result && $result['user_id'] == $userId) {
            // Użytkownik jest właścicielem oferty, więc można ją usunąć
            // Najpierw usuń powiązane obrazy oferty z tabeli offer_images
            $stmt_delete_images = $db->prepare("DELETE FROM offer_images WHERE offer_id = :offer_id");
            $stmt_delete_images->bindParam(':offer_id', $offerId);
            $stmt_delete_images->execute();

            // Następnie usuń ofertę
            $stmt_delete_offer = $db->prepare("DELETE FROM offers WHERE id = :offer_id");
            $stmt_delete_offer->bindParam(':offer_id', $offerId);
            $stmt_delete_offer->execute();

            $_SESSION['success_message'] = 'Ogłoszenie zostało pomyślnie usunięte.';
        } else {
            // Użytkownik nie jest właścicielem oferty
            $_SESSION['error_message'] = 'Nie masz uprawnień do usunięcia tego ogłoszenia.';
        }
    } catch (PDOException $e) {
        // Obsłuż błąd usuwania ogłoszenia
        $_SESSION['error_message'] = 'Wystąpił błąd podczas usuwania ogłoszenia: ' . $e->getMessage();
    } finally {
        $db = null;
    }
} else {
    // Obsłuż przypadki, w których żądanie nie jest typu POST
    $_SESSION['error_message'] = 'Nieprawidłowe żądanie.';
}

// Przekierowanie na stronę page_offers.php
header('Location: page_offers.php');
exit();
?>
