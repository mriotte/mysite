<section class="registration">
  <div class="container">
    <h1 class="form-tittle">Registration</h1>
    <form action="" method="POST">
      <div class="main-user-info">
        <div class="user-input-box">
          <label for="login">Login</label>
          <input type="text" id="login" name="login" placeholder="Enter Login">
        </div>

        <div class="user-input-box">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter Email" required>
        </div>

        <div class="user-input-box">
        <label for="phone">Phone Number</label>
        <input type="phone" id="phone" name="phone" placeholder="Enter Phone Number">
        </div>

        <div class="user-input-box">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter Password" required>
        </div>

        <div class="user-input-box">
        <label for="confirm_password">Confirm Password</label>
        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
        </div>
      </div>
      <div class="form-submit-btn">
        <button type="submit" name="register">Register</button>
      </div>
      <?php
      $errorArray = array();
      if(!empty($_POST)){
        if (!preg_match("/^[a-zA-Zа-яА-Я0-9_-]{4,}$/u", $_POST["login"])) {
          $errorArray[] = "Поле Логін має містити не менше 4 літер та містити лише латинські та кириличні літери (великі та малі), цифри, нижнє підкреслення та дефіс";
        }
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
          $errorArray[] = "Введена електронна адреса некоректна";
        }
        if(!empty($_POST["phone"])){
          if(strlen($_POST["phone"]) > 30){
          $errorArray[] = "Телефон повинен містити не більше 30 символів";
        }else if(!preg_match("/^\+?\d{1,4}?[-.\s]?\(?\d{1,3}?\)?[-.\s]?\d{1,4}[-.\s]?\d{1,4}[-.\s]?\d{1,9}$/", $_POST["phone"])){
          $errorArray[] = "Допустимі формати номерів: +380123456789, (012) 3456789, (012) 34-56-789, +38 (012) 34 56 789";
        }
        }
        if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{7,}$/", $_POST["password"])) {
          $errorArray[] = "Поле Пароль має містити не менше 7 літер та містити великі та малі літери, а також цифри";
        }
        if ($_POST["password"] != $_POST["confirm_password"]) {
          $errorArray[] = "Поле Повторіть пароль має співпадати з полем Пароль";
        }
        if(empty($errorArray)){
          $login = $_POST["login"];
          $password = $_POST["password"];
          $hashed_password = password_hash($password, PASSWORD_BCRYPT);
          $phone = $_POST["phone"];
          $email = $_POST["email"];
          $sql = "INSERT INTO users (login, email, password, phone) VALUES ('$login', '$email', '$hashed_password', '$phone')";
          if (mysqli_query($link, $sql)) {
            echo "Дані успішно збережені в базі даних.";
          } else {
            echo "Помилка запису даних до бази даних: " . mysqli_error($link);
          }
          header("Location: index.php?action=registration_successful");
          exit;
        }
        else{
          echo "<ul class=\"error\">";
          foreach($errorArray as $error){
            echo "<li>$error</li>";
          }
          echo "</ul>";
        }
      }
      ?>
    </form>
  </div>
</section>