<?php
include 'connection/conection.php';
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'belum') {
        $listTugas = mysqli_query($connection, "SELECT * FROM tugas WHERE status = 'Belum Selesai' ORDER BY deadline ASC");
    } else if ($_GET['status'] == 'sedangdikerjakan') {
        $listTugas = mysqli_query($connection, "SELECT * FROM tugas WHERE status = 'Sedang Dikerjakan' ORDER BY deadline ASC");
    } else if ($_GET['status'] == 'selesai') {
        $listTugas = mysqli_query($connection, "SELECT * FROM tugas WHERE status = 'Selesai' ORDER BY deadline ASC");
    } else if ($_GET['status'] == 'cancelled') {
        $listTugas = mysqli_query($connection, "SELECT * FROM tugas WHERE status = 'Cancelled' ORDER BY deadline ASC");
    }
} else {
    $listTugas = mysqli_query($connection, "SELECT * FROM tugas ORDER BY deadline ASC");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class=" bg-gray-100">
    <nav class=" w-full h-[80px] flex place-content-between items-center shadow-md bg-white p-4">
        <h1 class=" text-2xl font-bold">Hi, TelXplore</h1>
        <h1 class=" text-2xl font-bold">Home page</h1>
        <h1 class=" text-2xl font-bold"><?= date('l, j F Y') ?></h1>
    </nav>
    <div class=" flex justify-center space-x-7 m-4">
        <a class=" bg-white w-fit p-2 text-center rounded-md shadow-md" href="http:/trial_livecode/index.php">All</a>
        <a class=" bg-white w-fit p-2 text-center rounded-md shadow-md" href="http:/trial_livecode/index.php?status=belum">Belum</a>
        <a class=" bg-white w-fit p-2 text-center rounded-md shadow-md" href="http:/trial_livecode/index.php?status=sedangdikerjakan">Sedang Dikerjakan</a>
        <a class=" bg-white w-fit p-2 text-center rounded-md shadow-md" href="http:/trial_livecode/index.php?status=selesai">Selesai</a>
        <a class=" bg-white w-fit p-2 text-center rounded-md shadow-md" href="http:/trial_livecode/index.php?status=cancelled">Cancelled</a>
    </div>

    <div class="flex flex-wrap justify-center">
        <?php foreach ($listTugas as $tugas): ?>
            <div class=" bg-white border-green-500 w-[250px] h-[300px] m-4 flex flex-col space-y-[100px] p-4 items-center shadow-md">
                <h1 class=" text-xl font-semibold "><?= $tugas['nama'] ?></h1>
                <div class="items-center flex flex-col ">
                    <p>Deadline: <?= $tugas['deadline'] ?></p>
                    <p class=" font-semibold">
                        <?php
                        $deadline = new DateTime($tugas['deadline']);
                        $now = new DateTime();

                        $diff = $deadline->diff($now);

                        echo $deadline < $now
                            ? "<p class=' text-red-600'>Lewat " . $diff->days . " Hari </p>"
                            : "<p class=' text-blue-600'>Sisa " . $diff->days . " Hari </p>";
                        ?>
                    </p>
                    <p class=" font-semibold"><?= $tugas['status'] ?></p>
                    <div class=" flex m-5 space-x-2">
                        <button onclick="document.getElementById('modal-<?= $tugas['id'] ?>').showModal()" class=" w-[60px] h-[35px] bg-stone-700 text-white p-1 rounded-lg">Detail</button>
                        <button onclick="document.getElementById('modalEdit-<?= $tugas['id'] ?>').showModal()" class=" w-[60px] h-[35px] bg-yellow-500 text-white p-1 rounded-lg">Edit</button>
                        <form action="./controller/controller_delete.php" method="POST">
                            <input type="hidden" name="id" value="<?= $tugas['id'] ?>">
                            <button type="submit" class=" w-[60px] h-[35px] bg-red-600 text-white p-1 rounded-lg">Delete</button>
                        </form>
                    </div>
                    <dialog class=" bg-gray-300" id="modal-<?= $tugas['id'] ?>">
                        <div class=" bg-white p-8 w-[400px] rounded-lg">
                            <h1 class=" text-xl font-semibold ">Detail <?= $tugas['nama'] ?></h1>
                            <p><?= $tugas['deskripsi'] ?></p>
                            <form method="dialog" class=" mt-[100px]">
                                <button class=" w-[60px] h-[35px] bg-stone-700 text-white p-1 rounded-lg">Close</button>
                            </form>
                        </div>
                    </dialog>
                    <dialog class=" bg-gray-300" id="modalEdit-<?= $tugas['id'] ?>">
                        <div class=" bg-white p-8 w-[400px] rounded-lg space-y-4">
                            <h1 class=" text-xl font-semibold ">Edit <?= $tugas['nama'] ?></h1>
                            <form action="./controller/controller_edit.php" method="POST" class=" flex flex-col space-y-4">
                                <input type="hidden" name="id" value="<?= $tugas['id'] ?>">
                                <input class=" border-slate-500 border-2 shadow-md" type="text" name="nama" id="" value="<?= $tugas['nama'] ?>">
                                <Textarea class=" border-slate-500 border-2" name="deskripsi"><?= $tugas['deskripsi'] ?></Textarea>
                                <input class=" shadow-md" type="date" name="deadline" id="" value="<?= $tugas['deadline'] ?>">
                                <select name="status" id="">
                                    <option value="Belum Selesai" <?= $tugas['status'] == 'Belum Selesai' ? 'selected' : '' ?>>Belum Selesai</option>
                                    <option value="Sedang Dikerjakan" <?= $tugas['status'] == 'Sedang Dikerjakan' ? 'selected' : '' ?>>Dalam pengerjaan</option>
                                    <option value="Selesai" <?= $tugas['status'] == 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                                    <option value="Cancelled" <?= $tugas['status'] == 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
                                </select>
                                <div>
                                    <button type="button" class="align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none"
                                        onclick="document.getElementById('modalEdit-<?= $tugas['id'] ?>').close()">Close</button>
                                    <button type="submit" name="update" class="align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg bg-blue-600 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none">Submit</button>
                                </div>
                            </form>
                        </div>
                    </dialog>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class=" fixed bottom-4 right-4">
        <button onclick="modalAdd.showModal()">
            <img class=" w-[48px] h-[48px]" src="plus.png" alt="">
        </button>
        <dialog class=" bg-gray-300" id="modalAdd">
            <div class=" bg-white p-8 w-[400px] rounded-lg space-y-4">
                <h1 class=" text-xl font-semibold ">Add</h1>
                <form action="./controller/controller_add.php" method="post" class=" flex flex-col space-y-4">
                    <input class=" border-slate-500 border-2 shadow-md" type="text" name="nama" id="" required>
                    <Textarea class=" border-slate-500 border-2" name="deskripsi" required></Textarea>
                    <input class=" shadow-md" type="date" name="deadline" id="" required>
                    <select name="status" id="" required>
                        <option value="Belum Selesai">Belum Selesai</option>
                        <option value="Sedang Dikerjakan">Dalam pengerjaan</option>
                        <option value="Selesai">Selesai</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>
                    <div>
                        <button type="button" class="align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none"
                            onclick="document.getElementById('modalAdd').close()">Close</button>
                        <button type="submit" name="submit" class="align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg bg-blue-600 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none">Submit</button>
                    </div>

                </form>
                <form method="dialog" class=" mt-[100px]">
                </form>
            </div>
        </dialog>
    </div>
</body>

</html>