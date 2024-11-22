<?php
require '../connection/conection.php';

$id = $_POST['id'];
$sql = "DELETE FROM tugas WHERE id = '$id'";

$result = mysqli_query($connection, $sql);

header('location: /trial_livecode/index.php');