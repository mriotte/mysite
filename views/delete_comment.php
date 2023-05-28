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
    <h1 class=\"form-tittle\"><a href=\"index.php?action=main\">Коментар не знайдено</a></h1>
</section>";
    exit;
}
else{
    $sql = "DELETE FROM comments WHERE comment_id = $comment_id";
    if (mysqli_query($link, $sql)) {
        echo "<section class=\"registration\">
    <h1 class=\"form-tittle\"><a href=\"index.php?action=main\">Коментар успішно видалено</a></h1>
</section>";
    } else {
        echo "Помилка видалення коментаря: " . mysqli_error($link);
    }
}
?>
