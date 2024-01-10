<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyHomeLibrary - Kontakt</title>
    <link rel="shortcut icon" type="image/ico" href="./img/Paomedia-Small-N-Flat-Book.png">
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
          <a class="navbar-brand text-light" href="#"><i class="bi bi-book text-light"></i> MyHomeLibrary</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto">
              <a class="nav-link px-lg-3 text-light rounded-pill" href="index.php">Home</a>
              <?php
                session_start();
                if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true)) // jeśli user jest zalogowany pokaż Twoje konto
                {
                    echo '<a class="nav-link px-lg-3 text-light rounded-pill" href="library.php">Twoja Biblioteka</a>';
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
    <main>
        <section class="contact py-1">
            <div class="container">
                <div class="text-center py-3">
                    <p class="display-3">Kontakt</p>
                </div>
                <div class="row">
                    <div class="col-md-5 col-lg-4">
                        <div class="border p-5 mb-4 text-center">
                            <h3 class="green-text">Wykonanie strony:</h3>
                            <p>Alan Brzozowski</p>
                            <p class="mt-3 fw-bold text-uppercase green-text">adres</p>
                            <p>ul.Powstańców Wielkopolskich 5</p>
                            <p>61-895 Poznań</p>
                            <p class="mt-3 fw-bold text-uppercase green-text">telefon</p>
                            <p>61 655 33 33</p>
                            <p class="mt-3 fw-bold text-uppercase green-text">e-mail</p>
                            <p>wsb@gmail.com</p>
                        </div>
                    </div>
                    <div class="col-md-7 col-lg-8">
                        <div class="border p-5 mb-4 text-center">
                                <div class="row">
                                <section class="contact-map pb-5">
                                    <div class="container d-flex flex-column align-items-center">
                                        <p >Mapa dojazdu</p>
                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2434.1573905714467!2d16.9207969970614!3d52.40382366199459!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47045b30a95ccbb9%3A0x28d64ae3739ffe0a!2sPowsta%C5%84c%C3%B3w%20Wielkopolskich%205%2C%2061-895%20Pozna%C5%84!5e0!3m2!1spl!2spl!4v1686086377205!5m2!1spl!2spl" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                    </div>
                                </section>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
  <footer class="bg-dark text-light border-top">
    <p class="text-center mb-0 py-5">&copy; MyHomeLibrary 2023</p>
  </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>