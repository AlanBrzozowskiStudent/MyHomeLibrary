<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyNewHome - Offers Page</title>
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
                  if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true)) // je�li user jest zalogowany poka� Twoje konto
                  {
                    echo '<a class="nav-link px-lg-3 text-light rounded-pill" href="page_offers.php">Oferty</a>';
                    echo '<a class="nav-link px-lg-3 text-light rounded-pill" href="main.php">Twoje konto</a>';
                    echo '<a class="nav-link px-lg-3 text-light rounded-pill" href="logout.php">Wyloguj</a>';
                  }
                  else
                  {
                    echo '<a class="nav-link px-lg-3 text-light rounded-pill" href="login.php">Zaloguj lub utw�rz konto</a>';
                  }
                ?>
              <a class="nav-link px-lg-3 text-light rounded-pill" href="kontakt.php">Kontakt</a>
            </div>
          </div>
        </div>
    </nav>

    <section id="home" class="home">
        <!-- sekcja home zdj�cie w css -->
        <div class="container h-100 d-flex flex-column justify-content-center align-items-center text-light text-center">
        </div>
    </section>

    <section class="welcome-text d-flex flex-column justify-content-center align-items-center text-center">
      <h4>Przegl�daj oferty:</h4>
    </section>

    <section class="welcome-text d-flex flex-column justify-content-center align-items-center text-center">
      <h4>tutaj dodamy: dodaj ofert�, jaka� wyszukiwarka itp</h4>
    </section>



  
  <footer class="bg-dark text-light border-top">
      <p class="text-center mb-0 py-5">&copy; MyNewHome 2024</p>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>