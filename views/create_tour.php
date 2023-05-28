<section class="registration">
  <div class="container">
    <h1 class="form-tittle">Add Tour</h1>
    <form action="" method="POST">
      <div class="main-user-info">
        <div class="user-input-box">
          <label for="tour-name">Name</label>
          <input type="text" id="tour-name" name="tour-name" placeholder="Enter Tour name" required>
        </div>

        <div class="user-input-box">
        <label for="destination">Destination</label>
        <input type="text" id="destination" name="destination" placeholder="Enter Destination" required>
        </div>

        <div class="user-input-box">
        <label for="description">Description</label>
        <input type="text" id="description" name="description" placeholder="Enter Description" required>
        </div>

        <div class="user-input-box">
        <label for="price">Price</label>
        <input type="text" id="price" name="price" placeholder="Enter Price" required>
        </div>

      </div>
      <div class="form-submit-btn">
        <button type="submit" name="create-tour">Add Tour</button>
      </div>
      <?php
      $errorArray = array();
      if(!empty($_POST)){
        if (!preg_match("/^[a-zA-Zа-яА-Я `-]{4,100}$/u", $_POST["tour-name"])) {
          $errorArray[] = "Поле Назва має містити від 4 до 100 літер та містити лише латинські та кириличні літери (великі та малі), дефіс, апостроф";
        }
        if (!preg_match("/^[a-zA-Zа-яА-Я0 -9`-]{4,100}$/u", $_POST["destination"])) {
            $errorArray[] = "Поле Напрямок має містити від 4 до 100 літер та містити лише латинські та кириличні літери (великі та малі), цифри, дефіс, апостроф";
        }
        if (!preg_match("/^[a-zA-Zа-яА-Я0-9.` ,-]{50,255}$/u", $_POST["description"])) {
            $errorArray[] = "Поле Опис має містити від 50 до 255 літер та містити лише латинські та кириличні літери (великі та малі), цифри, крапку, кому, дефіс, апостроф";
        }
        if (!preg_match("/^[0-9k]{3,}$/u", $_POST["price"])) {
            $errorArray[] = "Поле ціна має містити від 3 цифр та може містити літеру k";
        }
        if(empty($errorArray)){
          $visible = $_SESSION['is_admin'];
          $author_id = $_SESSION['user_id'];
          $tour_name = mysqli_real_escape_string($link, $_POST["tour-name"]);
          $destination = mysqli_real_escape_string($link, $_POST["destination"]);
          $description = mysqli_real_escape_string($link, $_POST["description"]);
          $price = (int)$_POST["price"];
          $sql = "INSERT INTO tours (visible, author_id, name, destination, description, price) VALUES ('$visible', '$author_id', '$tour_name', '$destination', '$description', '$price')";
          if (mysqli_query($link, $sql)) {
            echo "Дані успішно збережені в базі даних.";
          } else {
            echo "Помилка запису даних до бази даних: " . mysqli_error($link);
          }
          header("Location: index.php");
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