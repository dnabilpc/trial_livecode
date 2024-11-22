<?php
include '../connection/conection.php';
if (isset($_POST['submit']) && !empty($_POST['nama']) && !empty($_POST['deskripsi']) && !empty($_POST['deadline']) && !empty($_POST['status'])) {
    // var_dump($_POST);
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $deadline = $_POST['deadline'];
    $status = $_POST['status'];
    $sql = "INSERT INTO tugas (nama, deskripsi, deadline, status) VALUES ('$nama', '$deskripsi', '$deadline', '$status')";

    $result = mysqli_query($connection, $sql);
    var_dump($result);
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
