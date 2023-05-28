<?php
session_start();
$link = mysqli_connect("localhost",
"griotte", "14102003Marie", "space_tourism");          
if (mysqli_connect_errno( ) != 0) {          
echo "Error";            
die(mysqli_connect_error( ));            
}
require_once 'layout/header.php';
$action = isset($_GET["action"]) ? $_GET["action"] : "main";
$file = "views/" . $action . ".php";
if (file_exists($file)) {
    require_once($file);
} else {
    require_once("views/main.php");
}

require_once 'layout/footer.php';
?>