<?php
session_start();
$pageTitle = 'Rejestracja';
include('header.php');
// Sprawdzamy, czy użytkownik jest już zalogowany, jeśli tak, przekierowujemy go do strony głównej
if (isset($_SESSION['zalogowany']) && $_SESSION['zalogowany'] == true) {
    header('Location: main.php');
    exit();
}

// Wyświetlamy komunikat o błędzie, jeśli istnieje
if (isset($_SESSION['error'])) {
    echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error'] . '</div>';
    unset($_SESSION['error']); // Usuwamy zmienną sesyjną, aby błąd wyświetlił się tylko raz
}
?>

<section id="register" class="register">
    <div class="container mb-3">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card bg-white">
                    <div class="card-body p-5">
                        <h2 class="fw-bold mb-2 text-uppercase text-center">Rejestracja</h2>
                        <form action="registration_handler.php" method="post" class="mb-3 mt-md-4">
                            <div class="mb-3">
                                <label for="name" class="form-label">Imię</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Hasło</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-outline-dark">Zarejestruj się</button>
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