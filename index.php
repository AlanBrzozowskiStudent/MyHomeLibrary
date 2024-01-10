<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyHomeLibrary - Home</title>
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

    <section class="welcome-text d-flex flex-column justify-content-center align-items-center text-center">
      <p>Twoja aplikacja do zarządzania domową biblioteką!</p>
      <p class="text-how-it-work">Jak to działa?</p>
    </section>

    <section class="how-works-section">
      <div class="row text-center">
        <div class="col-12 col-md-6 col-lg-3 ">
            <div class="how-it-works m-3 p-4 p-lg-5 border text-dark">
            <h3>1</h3>
            <p>Utwórz konto aby zapisywać swój postęp! </p>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="how-it-works m-3 p-4 p-lg-5 border text-dark">
            <h3>2</h3>
            <p>Dodaj swoją kolekcję książek do konta</p>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="how-it-works m-3 p-4 p-lg-5 border text-dark ">
            <h3>3</h3>
            <p>Przeczytaj, oceń, zapisz ulubione cytaty</p>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="how-it-works m-3 p-4 p-lg-5 border text-dark">
            <h3>4</h3>
            <p>Wybierz następną pozycję z MyHomeLibrary!</p>
            </div>
        </div>
      </div>
    </section>

  <section id="example" class="example">
        <!-- sekcja card z bootstrapa -->
        <div class="container py-5 text-center">
            <p class="display-3 orange-color mb-0 text-uppercase">Przykład</p>
            <p class="py-3">Twojej domowej kolekcji!</p>
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
                <div class="col">
                  <div class="card h-100">
                    <img src="./img/quo-vadis.png" class="card-img-top" alt="Okladka książki Quo Vadis">
                    <div class="card-body">
                      <h5 class="card-title">Quo Vadis</h5>
                      <p class="card-text mb-0">Autor:Henryk Sienkiewicz</p>
                      <p class="card-text">Ocena:8/10</p>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="card h-100">
                    <img src="./img/html5-i-css3-definicja-nowoczesnosci.png" class="card-img-top" alt="Okladka książki HTML5 i CSS3. Definicja nowoczesności">
                    <div class="card-body">
                      <h5 class="card-title">Definicja nowoczesności</h5>
                      <p class="card-text mb-0">Autor:Mazur Dawid</p>
                      <p class="card-text">Ocena:6/10</p>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="card h-100">
                    <img src="./img/atomic-habits.png" class="card-img-top" alt="Okladka książki Atomic Habits">
                    <div class="card-body">
                      <h5 class="card-title">Atomic Habits</h5>
                      <p class="card-text mb-0">Autor:Clear James</p>
                      <p class="card-text">Ocena:10/10</p>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="card h-100">
                    <img src="./img/21-lekcji.png" class="card-img-top" alt="Okladka książki 21 lekcji na XXI wiek">
                    <div class="card-body">
                      <h5 class="card-title">21 lekcji na XXI wiek</h5>
                      <p class="card-text mb-0">Autor:Harari Yuval Noah</p>
                      <p class="card-text">Ocena:8/10</p>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </section>
  <footer class="bg-dark text-light border-top">
      <p class="text-center mb-0 py-5">&copy; MyHomeLibrary 2023</p>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>