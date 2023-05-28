<section class="registration">
  <div class="container">
    <h1 class="form-tittle">Comment</h1>
    <form action="" method="POST">
      <div class="main-user-info">
        <div class="user-input-box">
          <label for="author-name">Name</label>
          <input type="text" id="author-name" name="author-name" placeholder="Enter Name" required>
        </div>

        <div class="user-input-box">
        <label for="comment-text">Comment</label>
        <input type="text" id="comment-text" name="comment-text" placeholder="Enter Comment" required>
        </div>

      </div>
      <div class="form-submit-btn">
        <button type="submit" name="comment">Comment</button>
      </div>
      <?php
      $errorArray = array();
      if(!empty($_POST)){
        if (!preg_match("/^[a-zA-Zа-яА-Я `-]{4,50}$/u", $_POST["author-name"])) {
          $errorArray[] = "Поле Ім'я має містити від 4 до 50 літер та містити лише латинські та кириличні літери (великі та малі), дефіс, апостроф";
        }
        if (!preg_match("/^[a-zA-Zа-яА-Я0-9. `,]{5,255}$/u", $_POST["comment-text"])) {
            $errorArray[] = "Поле Коментар має містити від 4 до 255 літер та містити лише латинські та кириличні літери (великі та малі), цифри, дефіс, апостроф";
        }
        if(empty($errorArray)){
          $tour_id = (int)$_GET['id'];
          $author_id = $_SESSION['user_id'];
          $author_name = mysqli_real_escape_string($link, $_POST["author-name"]);
          $comment = mysqli_real_escape_string($link, $_POST["comment-text"]);
          $sql = "INSERT INTO comments (author_id, author_name, tour_id, comment) VALUES ('$author_id', '$author_name', '$tour_id', '$comment')";
          if (mysqli_query($link, $sql)) {
            echo "Коментар успішно додано";
          } else {
            echo "Не вдалось додати коментар" . mysqli_error($link);
          }
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

