<?php
session_start();

//Membuat koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "stockbarang");
// $conn = mysqli_connect("localhost:3307","root","m4nd4l4","stockbarang");

//Register
if (isset($_POST['regist'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $level = $_POST['level'];

    $userbaru = mysqli_query($conn, "INSERT INTO login(email, password, level) VALUES('$email', '$password', '$level')");

    if ($userbaru) {
        header('location:regist.php');
    } else {
        echo 'Gagal';
        header('location:regist.php');
    }
}

//Menambah barang baru
if (isset($_POST['addnewbarang'])) {
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];
    $stock = $_POST['stock'];

    $addtotable = mysqli_query($conn, "INSERT INTO stock(namabarang, deskripsi, stock) VALUES('$namabarang', '$deskripsi', '$stock')");

    if ($addtotable) {
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php');
    }
}

//Menambah barang masuk
if (isset($_POST['barangmasuk'])) {
    $databarangmasuk = $_POST['databarangmasuk'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstocksekarang = mysqli_query($conn, "SELECT * FROM stock WHERE idbarang='$databarangmasuk'");
    $ambildata = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang = $ambildata['stock'];
    $tambahstock = $stocksekarang + $qty;


    $addtomasuk = mysqli_query($conn, "INSERT INTO masuk(idbarang, keterangan, qty) VALUES('$databarangmasuk', '$penerima', '$qty')");
    $updatestockmasuk = mysqli_query($conn, "UPDATE stock SET stock='$tambahstock' WHERE idbarang='$databarangmasuk'");

    if ($addtomasuk && $updatestockmasuk) {
        header('location:masuk.php');
    } else {
        echo 'Gagal';
        header('location:masuk.php');
    }
}

//Menambah barang keluar
if (isset($_POST['addbarangkeluar'])) {
    $databarangkeluar = $_POST['databarangkeluar'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstocksekarang = mysqli_query($conn, "SELECT * FROM stock WHERE idbarang='$databarangkeluar'");
    $ambildata = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang = $ambildata['stock'];
    $kurangstock = $stocksekarang - $qty;


    $addtokeluar = mysqli_query($conn, "INSERT INTO keluar(idbarang, penerima, qty) VALUES('$databarangkeluar', '$penerima', '$qty')");
    $updatestockkeluar = mysqli_query($conn, "UPDATE stock SET stock='$kurangstock' WHERE idbarang='$databarangkeluar'");

    if ($addtokeluar && $updatestockkeluar) {
        header('location:keluar.php');
    } else {
        echo 'Gagal';
        header('location:keluar.php');
    }
}

//Update info barang
if (isset($_POST['updatebarang'])) {
    $idb = $_POST['idb'];
    $namabarang = $_POST['namabarang'];
    $desk = $_POST['deskripsi'];

    $update = mysqli_query($conn, "UPDATE stock SET namabarang='$namabarang', deskripsi='$desk' WHERE idbarang='$idb'");
    if ($update) {
        header("location:index.php");
    } else {
        echo "Gagal Update";
        header("location:index.php");
    }
}

//Menghapus barang
if (isset($_POST['hapusbarang'])) {
    $idb = $_POST['idb'];

    $hapus = mysqli_query($conn, "DELETE FROM stock WHERE idbarang='$idb'");

    if ($hapus) {
        header('location:index.php');
    } else {
        echo 'Gagal Hapus';
        header('location:index.php');
    }
}
