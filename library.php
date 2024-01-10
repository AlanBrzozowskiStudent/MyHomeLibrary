<!DOCTYPE html>
<html lang="en">
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
      <p>Twoja Biblioteka!</p>
        <?php
            if ($_SESSION['number_of_books'] > 0)
            {
                echo "<p>Liczba dodanych książek: ".$_SESSION['number_of_books']."</p>";
            } else {
                echo "<p>Nie posiadasz dodanych książek. Dodaj je za pomocą formularza!</p>";
            }
        ?>
    </section>

    <section class="menu">
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <div class="list-group py-5" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active" id="list-home-list" data-bs-toggle="list" href="#list-home" role="tab" aria-controls="list-home">Twoje ksiązki</a>
                    <a class="list-group-item list-group-item-action" id="list-profile-list" data-bs-toggle="list" href="#list-profile" role="tab" aria-controls="list-profile">Dodaj</a>
                    <a class="list-group-item list-group-item-action" id="list-messages-list" data-bs-toggle="list" href="#list-messages" role="tab" aria-controls="list-messages">Usuń</a>
                    <a class="list-group-item list-group-item-action" id="list-settings-list" data-bs-toggle="list" href="#list-settings" role="tab" aria-controls="list-settings">Edytuj</a>
                    </div>
                </div>
                <div class="col-8 py-5" >
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                            <?php
                                require_once "connect.php"; //import logowania do db
                                $connection = @new mysqli($host,$db_user, $db_password, $db_name);
                                if($connection->connect_errno!=0)
                                {
                                    echo "Error: ".$connection->connect_errno . "Opis: ".$connection->connect_error;
                                }
                                else{
                                $user_id_sql = $_SESSION['id']; //pobranie id
                                $sql = "SELECT * FROM books WHERE user_id = $user_id_sql";
                                $result = $connection->query($sql);
                                if ($result->num_rows > 0) {
                                    echo '<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">';
                                    
                                    while ($row = $result->fetch_assoc()) {
                                        $tytul = $row["tytul"];
                                        $autor = $row["autor"];
                                        $ocena = $row["ocena"];
                                        $status = $row["status"];
                                        $book_id = $row["book_id"];
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
                                    }
                                    echo '</div>'; // Zamknięcie div.row
                                    
                                    } else {
                                        echo "Brak danych.";
                                    }
                                }
                                $result->free_result();
                                $connection->close();
                            ?>
                        </div>
                    <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                        <h2>Dodaj książkę</h2>
                        <form action="add_book.php" method="POST">
                            <div class="form-group">
                                <label for="tytul">Tytuł:</label>
                                <input type="text" id="tytul" name="tytul" class="form-control" required  maxlength="50">
                            </div>

                            <div class="form-group">
                                <label for="autor">Autor:</label>
                                <input type="text" id="autor" name="autor" class="form-control" required  maxlength="50">
                            </div>

                            <div class="form-group">
                                <label for="ocena">Ocena:</label>
                                <input type="number" id="ocena" name="ocena" min="1" max="10" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="status">Status przeczytania:</label>
                                <select id="status" name="status" class="form-control" required>
                                    <option value="tak">Tak</option>
                                    <option value="nie">Nie</option>
                                </select>
                            </div>

                            <input class="btn btn-primary" type="submit" value="Dodaj książkę">
                        </form>
                    </div>
                    <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
                        <?php
                                require_once "connect.php"; //import logowania do db
                                $connection = @new mysqli($host,$db_user, $db_password, $db_name);
                                if($connection->connect_errno!=0)
                                {
                                    echo "Error: ".$connection->connect_errno . "Opis: ".$connection->connect_error;
                                }
                                else{
                                $user_id_sql = $_SESSION['id']; //pobranie id
                                
                                $sql = "SELECT * FROM books WHERE user_id = $user_id_sql";
                                $result = $connection->query($sql);
                        
                                if ($result->num_rows > 0) {
                                    echo '<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">';
                                    while ($row = $result->fetch_assoc()) {
                                        $tytul = $row["tytul"];
                                        $autor = $row["autor"];
                                        $ocena = $row["ocena"];
                                        $status = $row["status"];
                                        $book_id = $row["book_id"];
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
                                                    <hr>
                                                        <div class="justify-content-center d-flex">
                                                            <form method="POST" action="delete_book.php">
                                                            <input type="hidden" name="book_id" value="' . $row['book_id'] . '">
                                                            <input class="btn btn-primary" type="submit" value="Usuń">
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>';
                                    }
                                    echo '</div>'; // Zamknięcie div.row
                                    
                                    } else {
                                        echo "Brak danych.";
                                    }
                                }
                                $result->free_result();
                                $connection->close();
                            ?>
               
                    </div>
                    <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
                        <?php
                                require_once "connect.php"; //import logowania do db
                                $connection = @new mysqli($host,$db_user, $db_password, $db_name);
                                if($connection->connect_errno!=0)
                                {
                                    echo "Error: ".$connection->connect_errno . "Opis: ".$connection->connect_error;
                                }
                                else{
                                $user_id_sql = $_SESSION['id']; //pobranie id
                                
                                $sql = "SELECT * FROM books WHERE user_id = $user_id_sql";
                                $result = $connection->query($sql);
                        
                                if ($result->num_rows > 0) {
                                    echo '<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">';
                                    while ($row = $result->fetch_assoc()) {
                                        $tytul = $row["tytul"];
                                        $autor = $row["autor"];
                                        $ocena = $row["ocena"];
                                        $status = $row["status"];
                                        $book_id = $row["book_id"];
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
                                                    <hr>
                                                        <div class="justify-content-center d-flex">
                                                            <form method="POST" action="edit_book.php">
                                                            <input type="hidden" name="book_id" value="' . $row['book_id'] . '">
                                                            <input class="btn btn-primary" type="submit" value="Edytuj">
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>';
                                    }
                                    echo '</div>'; // Zamknięcie div.row
                                    
                                    } else {
                                        echo "Brak danych.";
                                    }
                                }
                                $result->free_result();
                                $connection->close();
                        ?>
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