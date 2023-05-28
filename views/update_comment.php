<?php
if ($_SESSION['is_admin'] != true) {
    header('Location: index.php');
    exit;
}

$comment_id = (int)$_GET['id'];

$sql = "SELECT * FROM comments WHERE comment_id = $comment_id";
$result = mysqli_query($link, $sql);
if ($result->num_rows == 0) {
    echo "<section class=\"registration\">
    <h1 class=\"form-tittle\"><a href=\"index.php?action=main\">Комент не знайдено</a></h1>
</section>";
    exit;
}

$comment = mysqli_fetch_assoc($result);
?>
<section class="registration">
  <div class="container">
    <h1 class="form-tittle">Comment</h1>
    <form action="" method="POST">
      <div class="main-user-info">
        <div class="user-input-box">
          <label for="author-name">Name</label>
          <input type="text" id="author-name" name="author-name" value="<?php echo $comment['author_name']; ?>" placeholder="Enter Name" required>
        </div>

        <div class="user-input-box">
        <label for="comment-text">Comment</label>
        <input type="text" id="comment-text" name="comment-text" value="<?php echo $comment['comment']; ?>" placeholder="Enter Comment" required>
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
            $comment_id = (int)$_GET['id'];
            $author_name = mysqli_real_escape_string($link, $_POST["author-name"]);
            $comment = mysqli_real_escape_string($link, $_POST["comment-text"]);
          $sql = "UPDATE comments SET author_name='$author_name', comment='$comment' WHERE comment_id='$comment_id'";
          if (mysqli_query($link, $sql)) {
            echo "Дані успішно збережені в базі даних.";
          } else {
            echo "Помилка запису даних до бази даних: " . mysqli_error($link);
          }
          header("Location: tours.php");
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