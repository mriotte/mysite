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
else{
    $sql = "DELETE FROM tours WHERE tour_id = $tour_id";
    if (mysqli_query($link, $sql)) {
        echo "<section class=\"registration\">
    <h1 class=\"form-tittle\"><a href=\"index.php?action=main\">Тур успішно видалено</a></h1>
</section>";
    } else {
        echo "Помилка видалення туру: " . mysqli_error($link);
    }
}
?>
