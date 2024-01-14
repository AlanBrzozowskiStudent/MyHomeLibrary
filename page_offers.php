<?php
session_start();
$pageTitle = 'Oferty';
include('header.php');
?>

<!-- Przycisk dodawania oferty -->
<div class="container my-3">
    <!-- Flexbox do organizacji przycisku i formularza -->
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <!-- Przycisk do dodawania oferty -->
        <a href="add_offer.php" class="btn btn-secondary mb-2" role="button">Dodaj ofertę</a>
        
        <!-- Formularz wyszukiwania -->
        <form action="page_offers.php" method="get" class="w-100 w-lg-auto">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Szukaj nieruchomości..." aria-label="Szukaj nieruchomości">
                <button class="btn btn-primary" type="submit">Szukaj</button>
            </div>
        </form>
    </div>
</div>

        <?php
        require_once 'connect.php';
        try {
            $searchKeyword = $_GET['search'] ?? null;
            $db = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $db_user, $db_password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Doprecyzowanie zapytania jeśli przeszukiwanie jest wprowadzone
            $sql = "SELECT offers.*, offer_images.image_filename FROM offers LEFT JOIN offer_images ON offers.id = offer_images.offer_id AND offer_images.is_main = 1";
            if ($searchKeyword) {
                $sql .= " WHERE offers.description LIKE :search or offers.property_type LIKE :search or offers.address LIKE :search";
            }
            $stmt = $db->prepare($sql);
            if ($searchKeyword) {
                $searchTerm = '%'.$searchKeyword.'%';
                $stmt->bindParam(':search', $searchTerm);
            }
            $stmt->execute();
            $offers = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo '
            <div class="container py-5 text-center">
            <p class="display-5 orange-color mb-0 ">Wszystkie oferty:</p>
                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">';
                        foreach ($offers as $offer):
                        ?>
                            <div class="col mb-4">
                                <div class="card h-100">
                                    <!-- Zdjęcie główne oferty lub obraz placeholder, jeśli brak zdjęcia -->
                                    <img src="<?= $offer['image_filename'] ? 'img/'.$offer['image_filename'] : './img/placeholder.jpg' ?>" class="card-img-top" alt="Zdjęcie <?= $offer['address'] ?>">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= htmlspecialchars($offer['address']) ?></h5>
                                        <p class="card-text mb-0"><?= htmlspecialchars($offer['area']) ?>m2</p>
                                        <p class="card-text"><?= htmlspecialchars(number_format($offer['price'], 2, ',', '.')) ?> zł</p>
                                        <p class="card-text">Rodzaj nieruchomości: <?= htmlspecialchars($offer['property_type']) ?></p>
                                        <p class="card-text">Opis: <?= htmlspecialchars($offer['description']) ?></p>
                                        <p class="card-text">Kontakt - email: <?= htmlspecialchars($offer['contact_email']) ?></p>
                                        <p class="card-text">Kontakt - telefon: <?= htmlspecialchars($offer['contact_phone']) ?></p>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalOfferImages<?= $offer['id'] ?>">
                                        Pokaż wszystkie zdjęcia
                                        </button>
                                        <!-- Modal do wyświetlania zdjęć oferty -->
                                        <div class="modal fade" id="modalOfferImages<?= $offer['id'] ?>" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"">Zdjęcia oferty: <?= htmlspecialchars($offer['address']) ?></h5>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij kartę</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php
                                                        $stmt_images = $db->prepare("SELECT image_filename FROM offer_images WHERE offer_id = :offer_id");
                                                        $stmt_images->bindParam(':offer_id', $offer['id']);
                                                        $stmt_images->execute();
                                                        $images = $stmt_images->fetchAll(PDO::FETCH_ASSOC);

                                                        foreach ($images as $img) {
                                                            echo '<img src="img/' . htmlspecialchars($img['image_filename']) . '" class="d-block w-100 mb-2" alt="...">';
                                                        }
                                                        ?>
                                                        <div class="text-end">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij kartę</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endforeach;
            } catch (PDOException $e) {
                echo "Błąd: " . $e->getMessage();
            }
            
                echo'</div>';
        echo'</div>';
    



include('footer.php');
?>