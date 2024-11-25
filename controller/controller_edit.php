<?php
require '../connection/conection.php';

if (isset($_POST['update'])){
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $deadline = $_POST['deadline'];
    $status = $_POST['status'];
    $id = $_POST['id'];

    $query =
    "
        UPDATE tugas
        SET nama ='$nama', deskripsi = '$deskripsi', deadline = '$deadline', status = '$status'
        WHERE id = '$id'
    ";

    $result = mysqli_query($connection, $query);
    header("Location: /trial_livecode/index.php");
}

