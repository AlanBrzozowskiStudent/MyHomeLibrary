<?php
session_start();

// zabezpieczenie jeśli nie zalogowany nie da się zobaczyć main.php
if (!isset($_SESSION['zalogowany'])) {
    header('Location: index.php');
    exit();
}

require_once 'connect.php';

$userId = $_SESSION['id'];
$success = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $propertyType = $_POST['property_type'] ?? '';
    $address = $_POST['address'] ?? '';
    $area = $_POST['area'] ?? '';
    $price = $_POST['price'] ?? '';
    $description = $_POST['description'] ?? '';
    $contactEmail = $_POST['contact_email'] ?? '';
    $contactPhone = $_POST['contact_phone'] ?? '';

    try {
        $db = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $db_user, $db_password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $db->prepare("INSERT INTO offers (user_id, property_type, address, area, price, description, contact_email, contact_phone) VALUES (:user_id, :property_type, :address, :area, :price, :description, :contact_email, :contact_phone)");
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':property_type', $propertyType);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':area', $area);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':contact_email', $contactEmail);
        $stmt->bindParam(':contact_phone', $contactPhone);
        
        $stmt->execute();
        $lastOfferId = $db->lastInsertId();
        $success = true;

        // Jeżeli oferta została dodana, przesyłamy zdjęcia.
        if ($success && isset($_FILES['offer_images'])) {
            $images = $_FILES['offer_images'];
            $mainImageIndex = isset($_POST['main_image']) ? intval($_POST['main_image']) - 1 : 0;

            for ($i = 0; $i < count($images['name']); $i++) {
                if ($images['error'][$i] == UPLOAD_ERR_OK) {
                    $fileTmpPath = $images['tmp_name'][$i];
                    $fileName = uniqid() . basename($images['name'][$i]);
                    $filePath = 'img/' . $fileName;

                    if (move_uploaded_file($fileTmpPath, $filePath)) {
                        $isMain = ($i === $mainImageIndex) ? 1 : 0;
                        
                        $stmt_img = $db->prepare("INSERT INTO offer_images (offer_id, image_filename, is_main) VALUES (:offer_id, :image_filename, :is_main)");
                        $stmt_img->bindParam(':offer_id', $lastOfferId);
                        $stmt_img->bindParam(':image_filename', $fileName);
                        $stmt_img->bindParam(':is_main', $isMain);
                        $stmt_img->execute();
                    }
                }
            }
        }

    } catch (PDOException $e) {
        $_SESSION['add_offer_message'] = 'Wystąpił błąd podczas dodawania oferty: ' . $e->getMessage();
        $db = null; // Zamykamy połączenie z bazą danych
        header('Location: add_offer.php');
        exit();
    } finally {
        $db = null; // Zawsze zamykamy połączenie z bazą danych
    }
}

if ($success) {
    $_SESSION['add_offer_message'] = 'Pozytywnie dodano ofertę';
    header('Location: add_offer.php');
    exit();
}