<?php
session_start();
$pageTitle = 'Edytuj ofertę';
include('header.php');
require_once 'connect.php';

if (!isset($_SESSION['zalogowany'])) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $offer_id = $_GET['id'];
    
    // Fetch the offer data including images from the database
    try {
        $db = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $db_user, $db_password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $db->prepare("SELECT o.*, i.image_filename FROM offers o LEFT JOIN offer_images i ON o.id = i.offer_id WHERE o.id = :id");
        $stmt->bindParam(':id', $offer_id);
        $stmt->execute();
        $offer = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$offer) {
            // Offer not found, handle this as needed (e.g., redirect to an error page)
        }
    } catch (PDOException $e) {
        echo "Błąd: " . $e->getMessage();
    }
} else {
    // Handle cases where the offer ID is not provided in the URL
    // You might want to show an error message or redirect to an error page
}

// Ensure that all four images are uploaded by the user
$existingImages = [];
if (!empty($offer['image_filename'])) {
    $existingImages[] = $offer['image_filename'];
}

?>

<section id="edit_offer" class="edit_offer">
    <!-- Form for editing the offer -->
    <div class="container mb-3">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card bg-white">
                    <div class="card-body p-5">
                        <h2 class="fw-bold mb-2 text-uppercase text-center">Edytuj ofertę</h2>
                        <form action="edit_offer_handler.php" method="post" enctype="multipart/form-data" class="mb-3 mt-md-4">
                            <!-- Property Type -->
                            <div class="mb-3">
                                <label for="property_type" class="form-label">Rodzaj nieruchomości:</label>
                                <select name="property_type" class="form-select" required>
                                    <option value="mieszkanie" <?= ($offer['property_type'] == 'mieszkanie') ? 'selected' : '' ?>>Mieszkanie</option>
                                    <option value="dom" <?= ($offer['property_type'] == 'dom') ? 'selected' : '' ?>>Dom</option>
                                    <option value="lokal_uslugowy" <?= ($offer['property_type'] == 'lokal_uslugowy') ? 'selected' : '' ?>>Lokal usługowy</option>
                                    <option value="dzialka" <?= ($offer['property_type'] == 'dzialka') ? 'selected' : '' ?>>Działka</option>
                                </select>
                            </div>

                            <!-- Address -->
                            <div class="mb-3">
                                <label for="address" class="form-label">Adres (ulica)</label>
                                <input type="text" class="form-control" name="address" value="<?= htmlspecialchars($offer['address']) ?>" required>
                            </div>

                            <!-- Area -->
                            <div class="mb-3">
                                <label for="area" class="form-label">Powierzchnia (w m²)</label>
                                <input type="number" class="form-control" name="area" min="1" value="<?= htmlspecialchars($offer['area']) ?>" required>
                            </div>

                            <!-- Price -->
                            <div class="mb-3">
                                <label for="price" class="form-label">Cena (w zł)</label>
                                <input type="number" class="form-control" name="price" min="1" value="<?= htmlspecialchars($offer['price']) ?>" required>
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Opis</label>
                                <textarea name="description" class="form-control" required><?= htmlspecialchars($offer['description']) ?></textarea>
                            </div>

                            <!-- Contact Email -->
                            <div class="mb-3">
                                <label for="contact_email" class="form-label">E-mail kontaktowy</label>
                                <input type="email" class="form-control" name="contact_email" value="<?= htmlspecialchars($offer['contact_email']) ?>" required>
                            </div>

                            <!-- Contact Phone -->
                            <div class="mb-3">
                                <label for="contact_phone" class="form-label">Numer telefonu</label>
                                <input type="tel" class="form-control" name="contact_phone" value="<?= htmlspecialchars($offer['contact_phone']) ?>" required>
                            </div>

                            <!-- Upload Images -->
                            <?php for ($i = 1; $i <= 4; $i++): ?>
                                <div class="mb-2">
                                    <label for="edit_offer_image<?= $i ?>" class="form-label">Zdjęcie <?= $i ?>:</label>
                                    <input type="file" class="form-control" name="edit_offer_images[]" accept="image/*" id="edit_offer_image<?= $i ?>" required>
                                    <input type="hidden" name="existing_images[]" value="<?= isset($existingImages[$i - 1]) ? $existingImages[$i - 1] : '' ?>">
                                </div>
                            <?php endfor; ?>
                            <p class="text-muted fs-6">Proszę dodać wszystkie 4 zdjęcia nieruchomości.</p>

                            <!-- Submit Button -->
                            <div class="d-grid">
                                <input type="hidden" name="offer_id" value="<?= $offer_id ?>">
                                <button type="submit" name="submit" class="btn btn-outline-dark">Zapisz zmiany</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include('footer.php');
?>
