<?php
session_start();

  // zabezpieczenie jeœli nie zalogowany nie da siê zobaczyæ main.php
  if (!isset($_SESSION['zalogowany']))
  {
    header('Location: index.php');
    exit();
  }

    // Za³aduj dane do po³¹czenia z bazy danych z pliku `connect.php`
    require_once 'connect.php';

    $userId = $_SESSION['id'];
    $success = false;

    // Sprawdzanie metody post
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Pobieranie danych z formularza
        $propertyType = $_POST['property_type'] ?? '';
        $address = $_POST['address'] ?? '';
        $area = $_POST['area'] ?? '';
        $price = $_POST['price'] ?? '';
        $description = $_POST['description'] ?? '';
        $contactEmail = $_POST['contact_email'] ?? '';
        $contactPhone = $_POST['contact_phone'] ?? '';

        // Otworzenie po³¹czenia z baz¹ danych
        try {
            $db = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $db_user, $db_password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            

            // Przygotowanie zapytania
            $stmt = $db->prepare("INSERT INTO offers (user_id, property_type, address, area, price, description, contact_email, contact_phone) VALUES (:user_id, :property_type, :address, :area, :price, :description, :contact_email, :contact_phone)");

            // Powi¹zanie zmiennych i wykonanie zapytania
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':property_type', $propertyType, PDO::PARAM_STR);
            $stmt->bindParam(':address', $address, PDO::PARAM_STR);
            $stmt->bindParam(':area', $area);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':contact_email', $contactEmail, PDO::PARAM_STR);
            $stmt->bindParam(':contact_phone', $contactPhone, PDO::PARAM_STR);

            // Wykonanie zapytania
            $stmt->execute();
            $success = true;

        } catch (PDOException $e) {
            // Logowanie b³êdów
            // error_log($e->getMessage());

            // Przechowanie komunikatu o b³êdzie w sesji, do wyœwietlenia dla u¿ytkownika
            $_SESSION['add_offer_message'] = 'Wyst¹pi³ b³¹d podczas dodawania oferty: ' . $e->getMessage();
            header('Location: kontakt.php');
            exit();
        }
    }

// Przekierowanie z powrotem do formularza z odpowiedni¹ wiadomoœci¹
if ($success) {
    $_SESSION['add_offer_message'] = 'Pozytywnie dodano ofertê.';
    header('Location: add_offer.php');
    exit();
}