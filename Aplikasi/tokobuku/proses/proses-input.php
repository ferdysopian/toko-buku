<?php
session_start();
if (isset($_SESSION['level'])) {
    $level = $_SESSION['level'];
}
if (isset($_POST['type'])) {
    if ($_POST['type'] == 1) {
        if ($level == 'admin') {
            include "Distributor.php";
            $Distributor = new Distributor;
            $Distributor->setNamaDistributor($_POST['namaDistributor']);
            $Distributor->setAlamat($_POST['alamat']);
            $Distributor->setTelp($_POST['telp']);
            $Distributor->input();
        } else {
            header('location:index.php');
        }

    } elseif ($_POST['type'] == 2) {
        if ($level == 'admin') {
            $kode = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
            $acak = substr(str_shuffle($kode), 0, 5);
            include "Kasir.php";
            $Kasir           = new \APP\Kasir();
            $Kasir->nama     = $_POST['namaKasir'];
            $Kasir->alamat   = $_POST['alamat'];
            $Kasir->telepon  = $_POST['telp'];
            $Kasir->username = ($_POST['username']);
            $Kasir->password = $acak;
            $Kasir->status   = $_POST['status'];
            $Kasir->level    = $_POST['level'];
            $Kasir->insert();
        } else {
            header('location:index.php');
        }
    } elseif ($_POST['type'] == 3) {
        if ($level == 'admin') {
            include "Buku.php";
            $Buku              = new \APP\Buku();
            $Buku->judul       = $_POST['judulBuku'];
            $Buku->noISBN      = $_POST['noISBN'];
            $Buku->penulis     = $_POST['penulis'];
            $Buku->penerbit    = $_POST['penerbit'];
            $Buku->tahunTerbit = $_POST['tahunTerbit'];
            $Buku->stok        = $_POST['stok'];
            $Buku->hargaPokok  = $_POST['hargaPokok'];
            $Buku->hargaJual   = $_POST['hargaJual'];
            $Buku->PPN         = $_POST['PPN'];
            $Buku->diskon      = $_POST['diskon'];
            $Buku->input();
        } else {
            header('location:index.php');
        }
    } elseif ($_POST['type'] == 4) {
        if ($level == 'admin') {
            include "Pasok.php";
            $Pasok = new Pasok;
            $Pasok->setIdDistributor($_POST['idDistributor']);
            $Pasok->setIdBuku($_POST['idBuku']);
            $Pasok->setJumlah($_POST['jumlah']);
            $Pasok->setTglMasuk($_POST['tglMasuk']);
            $Pasok->input();
        } else {
            header('location:index.php');
        }

    } elseif ($_POST['type'] == 5) {
        include "Penjualan.php";
        $Penjualan = new Penjualan;
        $Penjualan->setIdKasir($_POST['idKasir']);
        $Penjualan->setJumlah($_POST['jumlah']);
        $Penjualan->setIdBuku($_POST['idBuku']);
        $Penjualan->tambahCart();
    } elseif ($_POST['type'] == 6) {
        include "Buku.php";
        $Buku = new Buku;
        $Buku->search($_POST['search']);
    }
}
?>
