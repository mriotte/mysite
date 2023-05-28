<?php
$tour_id = (int)$_GET['id'];

$sql = "SELECT * FROM tours WHERE tour_id = $tour_id AND visible = ";
$result = mysqli_query($link, $sql);
if ($result->num_rows == 0 ) {
    echo "<section class=\"registration\">
    <h1 class=\"form-tittle\"><a href=\"index.php?action=main\">Тур не знайдено</a></h1>
</section>";
    exit;
}

$row = mysqli_fetch_assoc($result);
    echo '<section class="destinations">
    <h1>Tour №' . $tour_id . '</h1>';
        echo '<div class="row">';
        echo '<div class="dest-col">';
        echo '<h3>' . $row['name'] . '</h3>';
        echo '<h4>'. $row['price'] .'$</h4>';
        echo '<h4>'. $row['destination'] .'</h4>';
        echo '<p>'. $row['description'] .'</p>';
        echo '</div>';
    echo '</div>
    </section>';

    if (isset($_SESSION["auth"])) {
        require_once("views/comment.php");
    }
?>
<?php
$sql = "SELECT * FROM comments WHERE tour_id = $tour_id ORDER BY date DESC";


$result = mysqli_query($link, $sql);

if ($result->num_rows > 0) {
    echo '<section class="destinations">
    <h1>Comments</h1>
    <p>Clients says</p>';

    echo '<div class="row">';

    $counter = 0;
    while ($row = $result->fetch_assoc()) {
        echo '<div class="dest-col">';
        echo '<h3>' . $row['author_name'] . '</h3>';
        echo '<p>'. $row['comment'] .'</p>';

        if(isset($_SESSION['is_admin'])&&$_SESSION['is_admin']){
            echo '<a href="index.php?action=update_comment&id=' . $row['comment_id'] . '" class="edit-link">Edit</a>';
            echo '<a href="#" onclick="deleteComment(' . $row['comment_id'] . ')" class="delete-link">Delete</a>';
        }
        echo '</div>';
        $counter++;

        if ($counter % 3 == 0) {
            echo '</div><div class="row">';
        }
    }

    if ($counter % 3 != 0) {
        echo '</div>';
    }
    echo '</div>
    </section>';
}
?>
<script>
function deleteComment(id) {
    if(confirm("Ви дійсно бажаєте видалити цей коментар?")) {
        window.location.href = "index.php?action=delete_comment&id=" + id;
    }
}
</script>