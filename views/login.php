
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

    if (isset($_POST['login'])) {
    $login = mysqli_real_escape_string($link, $_POST['login']);
    $password = mysqli_real_escape_string($link, $_POST['password']);
    $query = "SELECT * FROM users WHERE login='$login'";
    $result = mysqli_query($link, $query);
    $user = mysqli_fetch_assoc($result);
    }
    if (mysqli_num_rows($result) == 1 && password_verify($password, $user['password'])) {
      $_SESSION['login'] = $login;
      $_SESSION['user_id'] = $user['user_id'];
      $_SESSION['is_admin'] = $user['admin'];
      $_SESSION["auth"] = true;
      header("Location: index.php");
      exit();
    } else {
      $error_msg = "Невірний логін або пароль";
    }
    mysqli_close($db);
}

?>
<section class="registration">
  <div class="container">
    <h1 class="form-tittle">Login</h1>
    <form action="" method="POST">
      <div class="main-user-info">
        <div class="user-input-box">
          <label for="login">Login</label>
          <input type="text" id="login" name="login" placeholder="Enter Login" required>
        </div>

        <div class="user-input-box">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter Password" required>
        </div>

      </div>
      <div class="form-submit-btn">
        <button type="submit" name="submit">Login</button>
      </div>

      <?php
      if (isset($error_msg)) {
        echo '<p class="error">' . $error_msg . '</p>';
      }
      ?>

      <a class="login-registration" href="index.php?action=registration">Registration</a>
    </form>
  </div>
</section>