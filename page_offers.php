<?php
session_start();
$pageTitle = 'Oferty';
include('header.php');
?>

    <section class="welcome-text d-flex flex-column justify-content-center align-items-center text-center">
        <a href="add_offer.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Dodaj oferte</a>
    </section>

    <section class="welcome-text d-flex flex-column justify-content-center align-items-center text-center">
        <h2>Tutaj może jakaś wyszukiwarkażżżżżżżżżz:zz</h2>
    </section>

        <?php
        require_once 'connect.php';
        try {
            $searchKeyword = $_GET['search'] ?? null;
            $db = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $db_user, $db_password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Doprecyzowanie zapytania jeśli przeszukiwanie jest wprowadzone
            $sql = "SELECT offers.*, offer_images.image_filename FROM offers LEFT JOIN offer_images ON offers.id = offer_images.offer_id AND offer_images.is_main = 1";
            if ($searchKeyword) {
                $sql .= " WHERE offers.property_type LIKE :search";
            }
            $stmt = $db->prepare($sql);
            if ($searchKeyword) {
                $searchTerm = '%'.$searchKeyword.'%';
                $stmt->bindParam(':search', $searchTerm);
            }
            $stmt->execute();
            $offers = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
                        </div>
                    </div>
                </div>
            <?php
            endforeach;
        } catch (PDOException $e) {
            echo "Błąd: " . $e->getMessage();
        }
        ?>
            </div>
        </div>
    </section>


<?php
include('footer.php');
?>