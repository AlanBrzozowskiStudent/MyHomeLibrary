<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyHomeLibrary - Twoja Biblioteka</title>
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

    <?php
        // wyświetl ile user ma ksiązek na podstawie user_id
        require_once "connect.php"; //import logowania do db
        $connection = @new mysqli($host,$db_user, $db_password, $db_name);
        if($connection->connect_errno!=0)
        {
            echo "Error: ".$connection->connect_errno . "Opis: ".$connection->connect_error;
        }
        else{
            $user_id_sql = $_SESSION['id'];
            $sql = "SELECT COUNT(*) AS number_of_books FROM books WHERE user_id = '$user_id_sql'";
            $result = $connection->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $_SESSION['number_of_books'] = $row['number_of_books']; //przypisz liczbę książek do sesji
            } else {
                echo "<p>Nie posiadasz dodanych książek. Dodaj je za pomocą formularza!</p>";
            }
        }
    ?>

    <section class="welcome-text d-flex flex-column justify-content-center align-items-center text-center">
      <p>Twoja Biblioteka! - Edycja ksiązki</p>

    </section>

    <section class="menu">
        <div class="container">
            <div class="row">
                <div class="col-4 justify-content-center align-items-center text-center">
                    <p>Tryb edycji Ksiązki</p>
                    <?php
                        require_once "connect.php"; //import logowania do db
                        $connection = @new mysqli($host,$db_user, $db_password, $db_name);
                        if($connection->connect_errno!=0)
                        {
                            echo "Error: ".$connection->connect_errno . "Opis: ".$connection->connect_error;
                        }
                        else
                        {
                            $book_id = $_POST['book_id'];
                            $sql = "SELECT * FROM books WHERE book_id = $book_id";
                            $result = $connection->query($sql);

                            // Wyświetlenie danych książki
                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $tytul = $row["tytul"];
                                $autor = $row["autor"];
                                $ocena = $row["ocena"];
                                $status = $row["status"];
                                if($status == 0 ){
                                    $status_text = 'Nie';
                                } else {
                                    $status_text = 'Tak';
                                }
                                echo '<div class="col">
                                                <div class="card h-100">
                                                    <img src="./img/book_standard.jpg" class="card-img-top" alt="domyślna_okładka">
                                                    <div class="card-body">
                                                    <h3 class="card-title text-center">' . $tytul . '</h3>
                                                    <hr>
                                                    <p class="card-text text-center">' . $autor . '</p>
                                                    <hr>
                                                    <p class="card-text text-center">Przeczytana: ' . $status_text . '</p>
                                                    <hr>
                                                    <p class="card-text text-center">Ocena: ' . $ocena . '/10</p>
                                                    </div>
                                                </div>
                                            </div>';

                            } else {
                                echo "Nie znaleziono książki o podanym identyfikatorze.";
                            }
                            
                            $connection->close();
                        }

                    
                    ?>
                </div>
                <div class="col-8">
                    <?php
                        if($status == 0 ){
                            $status_text = 'Nie';
                        } else {
                            $status_text = 'Tak';
                        }
                        // Formularz do edycji danych książki
                        echo '<form action="update.php" method="POST" class="py-3">';
                        echo '<input type="hidden" name="book_id" value="' . $book_id . '">';
                        echo '<div class="form-group">';
                        echo '<label for="title">Tytuł:</label>';
                        echo '<input type="text" name="title" id="title" maxlength="50" value="' . $tytul . '" class="form-control"><br>';
                        echo '</div>';
                        echo '<div class="form-group">';
                        echo '<label for="author">Autor:</label>';
                        echo '<input type="text" name="author" id="author" maxlength="50" value="' . $autor . '" class="form-control"><br>';
                        echo '</div>';
                        echo '<div class="form-group">';
                        echo '<label for="rating">Ocena:</label>';
                        echo '<input type="number" name="rating" min="1" max="10" id="rating" value="' . $ocena . '" class="form-control"><br>';
                        echo '</div>';
                        echo '<div class="form-group">';
                        echo '<label for="read_status">Status przeczytania:</label>';
                        echo '<select name="read_status" id="read_status" class="form-control">';
                        echo '<option value="0" ' . ($status == 0 ? 'selected' : '') . '>Nie</option>';
                        echo '<option value="1" ' . ($status == 1 ? 'selected' : '') . '>Tak</option>';
                        echo '</select>';
                        echo '</div>';
                        echo '<div class="text-center">';
                        echo '<input class="btn btn-primary mr-2" type="submit" value="Zapisz zmiany">';
                        echo '<a class="btn btn-primary" href="library.php" role="button">Anuluj</a>';
                        echo '</div>';
                        echo '</form>';
                    ?>

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