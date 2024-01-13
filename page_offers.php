<?php
session_start();
$pageTitle = 'Oferty';
include('header.php');
?>

    <section class="welcome-text d-flex flex-column justify-content-center align-items-center text-center">
        <a href="add_offer.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Dodaj oferte</a>
    </section>

    <section class="welcome-text d-flex flex-column justify-content-center align-items-center text-center">
                <form action="page_offers.php" method="get">
            <!-- Przyk�ad prostej wyszukiwarki po rodzaju nieruchomo�ci (mo�esz rozszerzy� o wi�cej parametr�w) -->
            <input type="text" name="search" placeholder="Szukaj nieruchomo�ci..." />
            <button type="submit" class="btn btn-primary">Szukaj</button>
        </form>
    </section>

        <?php
        require_once 'connect.php';
        try {
            $searchKeyword = $_GET['search'] ?? null;
            $db = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $db_user, $db_password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Doprecyzowanie zapytania je�li przeszukiwanie jest wprowadzone
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
                        <!-- Zdj�cie g��wne oferty lub obraz placeholder, je�li brak zdj�cia -->
                        <img src="<?= $offer['image_filename'] ? 'img/'.$offer['image_filename'] : './img/placeholder.jpg' ?>" class="card-img-top" alt="Zdj�cie <?= $offer['address'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($offer['address']) ?></h5>
                            <p class="card-text mb-0"><?= htmlspecialchars($offer['area']) ?>m2</p>
                            <p class="card-text"><?= htmlspecialchars(number_format($offer['price'], 2, ',', '.')) ?> z�</p>
                            <p class="card-text">Rodzaj nieruchomo�ci: <?= htmlspecialchars($offer['property_type']) ?></p>
                            <p class="card-text">Opis: <?= htmlspecialchars($offer['description']) ?></p>
                            <p class="card-text">Kontakt - email: <?= htmlspecialchars($offer['contact_email']) ?></p>
                            <p class="card-text">Kontakt - telefon: <?= htmlspecialchars($offer['contact_phone']) ?></p>
                        </div>
                    </div>
                </div>
            <?php
            endforeach;
        } catch (PDOException $e) {
            echo "B��d: " . $e->getMessage();
        }
        ?>
            </div>
        </div>
    </section>


<?php
include('footer.php');
?>