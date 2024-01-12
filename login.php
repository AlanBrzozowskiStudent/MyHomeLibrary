<?php
  session_start();
  $pageTitle = 'Logowanie';
  include('header.php');
  if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true)) // jeśli user jest zalogowany nie pokazuj ekranu logowania
  {
    header('Location: main.php');
    exit();
  }?>
    <form action="login_handler.php" method="post">
      <div class="d-flex justify-content-center align-items-center mb-3">
        <div class="container">
          <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
              <div class="card bg-white">
                <div class="card-body p-5">
                  <form class="mb-3 mt-md-4">
                    <h2 class="fw-bold mb-2 text-uppercase text-center">Logowanie</h2>
                    <div class="mb-3">
                      <label for="email" class="form-label ">Email</label>
                      <input type="email" class="form-control" name="email">
                    </div>
                    <div class="mb-3">
                      <label for="password" class="form-label ">Hasło</label>
                      <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="d-grid">
                      <button class="btn btn-outline-dark" type="submit">Zaloguj</button>
                      <?php
                        if(isset($_SESSION['login_info'])) //jeśli taka zmienna istnieje pokaż dopiero bład
                        echo $_SESSION['login_info'];
                        unset($_SESSION['login_info']);
                      ?>
                    </div>
                  </form>
                  <div class="d-grid mt-3">
  <a href="register.php" class="btn btn-outline-primary">Rejestracja</a>
</div>
                  <div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
<?php
  include('footer.php');
?>