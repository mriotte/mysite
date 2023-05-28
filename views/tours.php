<?php
if(isset($_SESSION['is_admin'])&&$_SESSION['is_admin']){
    $sql = "SELECT * FROM tours ORDER BY date DESC";
}
else{
    $sql = "SELECT * FROM tours WHERE visible = 1 ORDER BY date DESC";
}

$result = mysqli_query($link, $sql);

if ($result->num_rows > 0) {
    echo '<section class="destinations">
    <h1>Tours We Offer</h1>
    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
        ok a galley of type and</p>';

    echo '<div class="row">';

    $counter = 0;
    while ($row = $result->fetch_assoc()) {
        echo '<div class="dest-col">';
        echo '<h3>' . $row['name'] . '</h3>';
        echo '<h4>'. $row['price'] .'$</h4>';
        echo '<h4>'. $row['destination'] .'</h4>';
        echo '<p>'. $row['description'] .'</p>';

        echo '<a href="index.php?action=view_tour&id=' . $row['tour_id'] . '" class="view-link">View</a>';

        if(isset($_SESSION['is_admin'])&&$_SESSION['is_admin']){
            echo '<a href="index.php?action=update_tour&id=' . $row['tour_id'] . '" class="edit-link">Edit</a>';
            echo '<a href="#" onclick="deleteTour(' . $row['tour_id'] . ')" class="delete-link">Delete</a>';
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
else {
    echo "Немає доступних турів.";
}

?>
<script>
function deleteTour(id) {
    if(confirm("Ви дійсно бажаєте видалити цей тур?")) {
        window.location.href = "index.php?action=delete_tour&id=" + id;
    }
}
</script>