<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyNewHome - Welcome Page</title>
    <link rel="shortcut icon" type="image/ico" href="./img/house_icon.png">
    <!-- Importy fonty, bootstrap, ikony, css -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,700;1,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,700;1,400&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <!-- Navbar z bootstrapa -->
    <nav class="navbar navbar-expand-lg py-2 sticky-top" style="background-color: #1F8A70;">
        <div class="container">
          <a class="navbar-brand text-light" href="#"><i class="bi bi-house-heart text-light"></i> MyNewHome</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto">
              <a class="nav-link px-lg-3 text-light rounded-pill" href="index.php">Home</a>
                <?php
                  if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true)) // jeśli user jest zalogowany pokaż Twoje konto
                  {
                    echo '<a class="nav-link px-lg-3 text-light rounded-pill" href="page_offers.php">Oferty</a>';
                    echo '<a class="nav-link px-lg-3 text-light rounded-pill" href="main.php">Twoje konto</a>';
                    echo '<a class="nav-link px-lg-3 text-light rounded-pill" href="logout.php">Wyloguj</a>';
                  }
                  else
                  {
                    echo '<a class="nav-link px-lg-3 text-light rounded-pill" href="login.php">Zaloguj lub utwórz konto</a>';
                  }
                ?>
              <a class="nav-link px-lg-3 text-light rounded-pill" href="kontakt.php">Kontakt</a>
            </div>
          </div>
        </div>
    </nav>

    <section id="home" class="home">
        <!-- sekcja home zdjęcie w css -->
        <div class="container h-100 d-flex flex-column justify-content-center align-items-center text-light text-center">
        </div>
    </section>

    <section class="welcome-text d-flex flex-column justify-content-center align-items-center text-center">
      <h4>Czy szukasz idealnej przestrzeni, aby rozpocząć nowy rozdział w swoim życiu?</h4>
      <p class="text-how-it-work">Odkryj prawdziwe miejsce do życia z ofertami domów na MyNewHome!</p>
    </section>

    <section class="how-works-section">
      <div class="row text-center">
        <div class="col-12 col-md-6 col-lg-3 ">
            <div class="how-it-works m-3 p-4 p-lg-5 border text-dark">
            <h3>1</h3>
            <p>Utwórz konto aby mieć dostęp do ofert! </p>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="how-it-works m-3 p-4 p-lg-5 border text-dark">
            <h3>2</h3>
            <p>Przeglądaj oferty nieruchomości.</p>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="how-it-works m-3 p-4 p-lg-5 border text-dark ">
            <h3>3</h3>
            <p>Znajdź wymarzoną nieruchomość.</p>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="how-it-works m-3 p-4 p-lg-5 border text-dark">
            <h3>4</h3>
            <p>Kup i zacznij nowe życie dzięki MyNewHome!</p>
        </div>
      </div>
    </section>

  <section id="example" class="example">
        <!-- sekcja card z bootstrapa -->
        <div class="container py-5 text-center">
            <p class="display-3 orange-color mb-0 text-uppercase">Przykładowe oferty:</p>
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
                <div class="col">
                  <div class="card h-100">
                    <img src="./img/example_photo2.jpg" class="card-img-top" alt="Oferta domu 1">
                    <div class="card-body">
                      <h5 class="card-title">Poznań Jeżyce</h5>
                      <p class="card-text mb-0">65m2</p>
                      <p class="card-text">750 000zł</p>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="card h-100">
                    <img src="./img/example_photo3.jpg" class="card-img-top" alt="Oferta domu 2">
                    <div class="card-body">
                      <h5 class="card-title">Poznań Wilda</h5>
                      <p class="card-text mb-0">35m2</p>
                      <p class="card-text">550 000zł</p>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="card h-100">
                    <img src="./img/example_photo4.jpg" class="card-img-top" alt="Oferta domu 3">
                    <div class="card-body">
                      <h5 class="card-title">Poznań Centrum</h5>
                      <p class="card-text mb-0">75m2</p>
                      <p class="card-text">900 000zł</p>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="card h-100">
                    <img src="./img/example_photo5.jpg" class="card-img-top" alt="Oferta domu 4">
                    <div class="card-body">
                      <h5 class="card-title">Luboń</h5>
                      <p class="card-text mb-0">135m2</p>
                      <p class="card-text">950 000zł</p>
                    </div>
                  </div>
                </div>


              </div>
        </div>
    </section>
  <footer class="bg-dark text-light border-top">
      <p class="text-center mb-0 py-5">&copy; MyNewHome 2024</p>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>