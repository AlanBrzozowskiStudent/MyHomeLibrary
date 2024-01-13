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
            $db = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $db_user, $db_password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $db->prepare("SELECT * FROM offers");
            $stmt->execute();
            $offers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Błąd: " . $e->getMessage();
        }
    ?>

    <section class="example">
        <div class="container py-5 text-center">
            <p class="display-3 orange-color mb-0 ">Wszystkie oferty:</p>
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
            <?php
                foreach ($offers as $offer):
                ?>
                    <div class="col">
                        <div class="card h-100">
                            <img src="./img/example_photo2.jpg" class="card-img-top" alt="Oferta domu 1">
                            <div class="card-body">
                              <h5 class="card-title"><?= $offer['address'] ?></h5>
                              <p class="card-text mb-0"><?= $offer['area'] ?>m2</p>
                              <p class="card-text"><?= number_format($offer['price'], 2, ',', '.') ?> zł</p>
                              <p class="card-text">Rodzaj nieruchomości: <?= $offer['property_type'] ?></p>
                              <p class="card-text">Opis: <?= $offer['description'] ?></p>
                              <p class="card-text">Kontakt - email: <?= $offer['contact_email'] ?></p>
                              <p class="card-text">Kontakt - telefon: <?= $offer['contact_phone'] ?></p>
                            </div>
                        </div>
                    </div>
                <?php
                endforeach;
            ?>
            </div>
        </div>
    </section>


<?php
include('footer.php');
?>