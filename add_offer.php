<?php
session_start();
$pageTitle = 'Dodaj oferte';
include('header.php');
?>


<section id="add_offer" class="add_offer">
     <!-- Wiadomość po dodaniu oferty -->
        <?php if (isset($_SESSION['add_offer_message'])): ?>
            <div class="alert alert-success mt-3">
                <?php 
                echo $_SESSION['add_offer_message']; 
                unset($_SESSION['add_offer_message']); 
                ?>
            </div>
        <?php endif; ?>
    <div class="container mb-3">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card bg-white">
                    <div class="card-body p-5">
                        <h2 class="fw-bold mb-2 text-uppercase text-center">Dodaj ofertę</h2>
                        <form action="add_offer_handler.php" method="post" enctype="multipart/form-data" class="mb-3 mt-md-4">
                            <div class="mb-3">
                                <label for="property_type" class="form-label">Rodzaj nieruchomości:</label>
                                <select name="property_type" class="form-select" required>
                                    <option value="mieszkanie">Mieszkanie</option>
                                    <option value="dom">Dom</option>
                                    <option value="lokal_uslugowy">Lokal usługowy</option>
                                    <option value="dzialka">Działka</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Adres (ulica)</label>
                                <input type="text" class="form-control" name="address" required>
                            </div>
                            <div class="mb-3">
                                <label for="area" class="form-label">Powierzchnia (w m²)</label>
                                <input type="number" class="form-control" name="area" min="1" required>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Cena (w zł)</label>
                                <input type="number" class="form-control" name="price" min="1" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Opis</label>
                                <textarea name="description" class="form-control" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="contact_email" class="form-label">E-mail kontaktowy</label>
                                <input type="email" class="form-control" name="contact_email" required>
                            </div>
                            <div class="mb-3">
                                <label for="contact_phone" class="form-label">Numer telefonu</label>
                                <input type="tel" class="form-control" name="contact_phone" required>
                            </div>
                            <div class="mb-3">
                            <?php for ($i = 1; $i <= 4; $i++): ?>
                                <div class="mb-2">
                                    <label for="offer_image<?php echo $i; ?>" class="form-label">Zdjęcie <?php echo $i; ?>:</label>
                                    <input type="file" class="form-control" name="offer_images[]" accept="image/*" id="offer_image<?php echo $i; ?>" required>
                                    <label class="form-check-label fs-5" for="main_image<?php echo $i; ?>">Czy zdjęcie główne?</label>
                                    <input class="form-check-input" type="radio" name="main_image" id="main_image<?php echo $i; ?>" value="<?php echo $i; ?>" <?php echo $i === 1 ? 'checked' : ''; ?>>
                                </div>
                            <?php endfor; ?>
                            <p class="text-muted fs-6">Proszę dodać wszystkie 4 zdjęcia nieruchomości.</p>
                            <div class="d-grid">
                                <button type="submit" name="submit" class="btn btn-outline-dark">Dodaj ofertę</button>
                            </div>
                            <div class="mb-3">                     

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