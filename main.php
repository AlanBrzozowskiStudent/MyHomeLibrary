<?php
session_start();
if (!isset($_SESSION['id'])) {
    // Użytkownik nie jest zalogowany
    header('Location: login.php'); // Przejście do strony logowania
    exit();
}
$pageTitle = 'Twoje konto';
include('header.php');
?>

<section class="container mt-5">
    <div class="row">
        <div class="col-12 text-center">
            <h2 class="mb-4">Witaj, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-md-6">
            <div class="card">
                <div class="card-body">
                    <p>Oto Twoje dane:</p>
                    <ul class="list-unstyled">
                        <li><strong>Imię:</strong> <?php echo htmlspecialchars($_SESSION['name']); ?></li>
                        <li><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['email']); ?></li>
                    </ul>
                </div>
            </div>
            <?php if (isset($_SESSION['error_password'])): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_SESSION['error_password']; ?>
            </div>
            <?php unset($_SESSION['error_password']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['info_password'])): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $_SESSION['info_password']; ?>
            </div>
            <?php unset($_SESSION['info_password']); ?>
            <?php endif; ?>

            <h2 class="text-center">Zmień hasło</h2>
            <form action="change_password.php" method="post" class="text-center">
                <div class="form-group">
                    <label for="currentPassword" class="sr-only">Aktualne hasło:</label>
                    <input type="password" class="form-control form-control-sm mx-auto mb-2" id="currentPassword" name="currentPassword" placeholder="Aktualne hasło" required>
                </div>
                <div class="form-group">
                    <label for="newPassword" class="sr-only">Nowe hasło:</label>
                    <input type="password" class="form-control form-control-sm mx-auto mb-2" id="newPassword" name="newPassword" placeholder="Nowe hasło" required>
                </div>
                <div class="form-group">
                    <label for="confirmNewPassword" class="sr-only">Wpisz ponownie nowe hasło:</label>
                    <input type="password" class="form-control form-control-sm mx-auto mb-2" id="confirmNewPassword" name="confirmNewPassword" placeholder="Potwierdź nowe hasło" required>
                </div>
                <button type="submit" class="btn btn-primary">Zmień hasło</button>
            </form>
        </div>
    </div>
</section>


<?php
include('footer.php');
?>