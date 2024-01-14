<?php
session_start();
require_once 'connect.php';

if (!isset($_SESSION['zalogowany'])) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $offer_id = $_POST['offer_id'];
    
    // Process the form data and update the offer in the database
    $property_type = $_POST['property_type'];
    $address = $_POST['address'];
    $area = $_POST['area'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $contact_email = $_POST['contact_email'];
    $contact_phone = $_POST['contact_phone'];

    // You can update the offer in the database here using an SQL UPDATE query
    try {
        $db = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $db_user, $db_password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Update the offer in the database
        $stmt = $db->prepare("UPDATE offers SET property_type = :property_type, address = :address, area = :area, price = :price, description = :description, contact_email = :contact_email, contact_phone = :contact_phone WHERE id = :id");
        $stmt->bindParam(':property_type', $property_type);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':area', $area);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':contact_email', $contact_email);
        $stmt->bindParam(':contact_phone', $contact_phone);
        $stmt->bindParam(':id', $offer_id);
        $stmt->execute();

        // Handle image uploads (similar to add_offer_handler.php)
        if (isset($_FILES['edit_offer_images'])) {
            // Delete existing images associated with the offer
            $stmt_delete_images = $db->prepare("DELETE FROM offer_images WHERE offer_id = :offer_id");
            $stmt_delete_images->bindParam(':offer_id', $offer_id);
            $stmt_delete_images->execute();
            
            $images = $_FILES['edit_offer_images'];
            $mainImageIndex = isset($_POST['main_image']) ? intval($_POST['main_image']) - 1 : 0;

            for ($i = 0; $i < count($images['name']); $i++) {
                if ($images['error'][$i] == UPLOAD_ERR_OK) {
                    $fileTmpPath = $images['tmp_name'][$i];
                    $fileName = uniqid() . basename($images['name'][$i]);
                    $filePath = 'img/' . $fileName;

                    if (move_uploaded_file($fileTmpPath, $filePath)) {
                        $isMain = ($i === $mainImageIndex) ? 1 : 0;
                        
                        // Insert new images
                        $stmt_img = $db->prepare("INSERT INTO offer_images (offer_id, image_filename, is_main) VALUES (:offer_id, :image_filename, :is_main)");
                        $stmt_img->bindParam(':offer_id', $offer_id);
                        $stmt_img->bindParam(':image_filename', $fileName);
                        $stmt_img->bindParam(':is_main', $isMain);
                        $stmt_img->execute();
                    }
                }
            }
        }
        
        // Assuming the update was successful, set a success message
        $_SESSION['edit_offer_message'] = 'Edycja pomyślna';

        // Redirect back to page_offers.php with the success message
        header('Location: page_offers.php');
        exit();
    } catch (PDOException $e) {
        $_SESSION['edit_offer_message'] = 'Wystąpił błąd podczas edycji oferty: ' . $e->getMessage();
        header('Location: edit_offer.php?id=' . $offer_id);
        exit();
    }
} else {
    $_SESSION['edit_offer_message'] = 'Nie udało się edytować oferty.';
    header('Location: edit_offer.php?id=' . $offer_id);
    exit();
}
?>
