<?php
require '../connection/conection.php';

$id = $_POST['id'];
$query = 
"
    DELETE FROM tugas
    WHERE id = '$id'
";

$result = mysqli_query($connection, $query);
header("Location: /trial_livecode/index.php");