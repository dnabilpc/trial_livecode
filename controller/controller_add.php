<?php
require '../connection/conection.php';

if (isset($_POST['submit'])){
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $deadline = $_POST['deadline'];
    $status = $_POST['status'];

    $query =
    "
        INSERT INTO tugas (nama, deskripsi, deadline, status)
        VALUES ('$nama', '$deskripsi', '$deadline', '$status')
    ";

    $result = mysqli_query($connection, $query);
    header("Location: /trial_livecode/index.php");
}