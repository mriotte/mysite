<?php
if ($_SESSION['is_admin'] != true) {
    header('Location: index.php');
    exit;
}

$tour_id = (int)$_GET['id'];

$sql = "SELECT * FROM tours WHERE tour_id = $tour_id";
$result = mysqli_query($link, $sql);
if ($result->num_rows == 0) {
    echo "<section class=\"registration\">
    <h1 class=\"form-tittle\"><a href=\"index.php?action=main\">Тур не знайдено</a></h1>
</section>";
    exit;
}

$tour = mysqli_fetch_assoc($result);
?>
<section class="registration">
  <div class="container">
    <h1 class="form-tittle">Edit Tour</h1>
    <form action="" method="POST">
      <div class="main-user-info">
        <div class="user-input-box">
          <label for="tour-name">Name</label>
          <input type="text" id="tour-name" name="tour-name" value="<?php echo $tour['name']; ?>" placeholder="Enter Tour name" required>
        </div>

        <div class="user-input-box">
        <label for="destination">Destination</label>
        <input type="text" id="destination" name="destination" value="<?php echo $tour['destination']; ?>" placeholder="Enter Destination" required>
        </div>

        <div class="user-input-box">
        <label for="description">Description</label>
        <input type="text" id="description" name="description" value="<?php echo $tour['description']; ?>" placeholder="Enter Description" required>
        </div>

        <div class="user-input-box">
        <label for="price">Price</label>
        <input type="number" id="price" name="price" value="<?= $tour['price']; ?>" placeholder="Enter Price" required>
        </div>

        <div class="user-input-box">
        <label for="visible">Visibility</label>
        <input type="number" id="visible" name="visible" value="<?= $tour['visible']; ?>" min= 0 max = 1 placeholder="Enter Visibility" required>
        </div>

      </div>
      <div class="form-submit-btn">
        <button type="submit" name="create-tour">Update Tour</button>
      </div>
      <?php
      $errorArray = array();
      if(!empty($_POST)){
        if (!preg_match("/^[a-zA-Zа-яА-Я `-]{4,100}$/u", $_POST["tour-name"])) {
          $errorArray[] = "Поле Назва має містити від 4 до 100 літер та містити лише латинські та кириличні літери (великі та малі), дефіс, апостроф";
        }
        if (!preg_match("/^[a-zA-Zа-яА-Я0-9` -]{4,100}$/u", $_POST["destination"])) {
            $errorArray[] = "Поле Напрямок має містити від 4 до 100 літер та містити лише латинські та кириличні літери (великі та малі), цифри, дефіс, апостроф";
        }
        if (!preg_match("/^[a-zA-Zа-яА-Я0-9. `,-]{50,255}$/u", $_POST["description"])) {
            $errorArray[] = "Поле Опис має містити від 50 до 255 літер та містити лише латинські та кириличні літери (великі та малі), цифри, крапку, кому, дефіс, апостроф";
        }
        if (!preg_match("/^[0-9k]{3,}$/u", $_POST["price"])) {
            $errorArray[] = "Поле ціна має містити від 3 цифр та може містити літеру k";
        }
        if (!preg_match("/^[10]{1}$/u", $_POST["visible"])) {
            $errorArray[] = "Поле видимість може містити лише 0 або 1";
        }
        if(empty($errorArray)){
          $visible = (int)$_POST["visible"];
          $author_id = $_SESSION['user_id'];
          $tour_name = mysqli_real_escape_string($link, $_POST["tour-name"]);
          $destination = mysqli_real_escape_string($link, $_POST["destination"]);
          $description = mysqli_real_escape_string($link, $_POST["description"]);
          $price = (int)$_POST["price"];
          $sql = "UPDATE tours SET name='$tour_name', destination='$destination', description='$description', price='$price', visible='$visible' WHERE tour_id='$tour_id'";
          if (mysqli_query($link, $sql)) {
            echo "Дані успішно збережені в базі даних.";
          } else {
            echo "Помилка запису даних до бази даних: " . mysqli_error($link);
          }
          header("Location: index.php");
          exit();
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