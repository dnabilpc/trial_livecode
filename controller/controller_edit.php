<?php
require '../connection/conection.php';

if (isset($_POST['update'])) {
    var_dump($_POST);
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $deadline = $_POST['deadline'];
    $status = $_POST['status'];
    $sql = "UPDATE tugas SET nama = '$nama', deskripsi = '$deskripsi', deadline = '$deadline', status = '$status' WHERE id = '$id'";

    $result = mysqli_query($connection, $sql);
    if ($result) {
        header('location: /trial_livecode/index.php');
        exit();
    }
} else {
    echo "
    <script>
    alert('Data Tidak Lengkap');
    window.location.href = '/trial_livecode/index.php';
    </script>";
}
