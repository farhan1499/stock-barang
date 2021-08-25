<?php

require_once "function.php";
require_once "cek.php";

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Stock Barang - RCS Website</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">RCS Website</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Stock Barang
                            </a>
                            <a class="nav-link" href="masuk.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Barang Masuk
                            </a>
                            <a class="nav-link" href="keluar.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Barang Keluar
                            </a>
                            <a class="nav-link" href="logout.php">
                                Logout
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Stock Barang</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">RCS Website</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Tambah Barang
                                </button>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Deskripsi</th>
                                            <th>Stock</th>
                                            <th>Pengaturan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $alldatastock = mysqli_query( $conn, "SELECT * FROM stock" );
                                            $i = 1;
                                            while( $data=mysqli_fetch_array( $alldatastock ) ) {
                                                $namabarang = $data['namabarang'];
                                                $desk = $data['deskripsi'];
                                                $stock = $data['stock'];
                                                $idb = $data['idbarang']
                                        ?>
                                        <tr>
                                            <td><?=$i++?></td>
                                            <td><?=$namabarang;?></td>
                                            <td><?=$desk;?></td>
                                            <td><?=$stock;?></td>
                                            <td>
                                                <!-- Button trigger modal Edit -->
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?=$idb;?>">
                                                Edit Barang
                                                </button>

                                                <input type="hidden" name="idbarangakandihapus" value="<?=$idb;?>">

                                                <!-- Button trigger modal Hapus -->
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?=$idb;?>">
                                                Hapus Barang
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Modal Edit-->
                                        <div class="modal fade" id="edit<?=$idb;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Barang</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form method="post">
                                                            <div class="modal-body">
                                                                <input type="text" name="namabarang" value="<?=$namabarang;?>" class="form-control" required><br>
                                                                <input type="text" name="deskripsi" value="<?=$desk;?>" class="form-control" required><br>
                                                                <input type="hidden" name="idb" value="<?=$idb;?>">
                                                                <button type="submit" name="updatebarang" class="btn btn-primary">Submit</button>
                                                            </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Hapus-->
                                        <div class="modal fade" id="hapus<?=$idb;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Barang</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form method="post">
                                                            <div class="modal-body">
                                                                Apakah Anda yakin akan menghapus "<?=$namabarang;?>" ??
                                                                <input type="hidden" name="idb" value="<?=$idb;?>">"
                                                                <br>
                                                                <br>
                                                                <button type="submit" name="hapusbarang" class="btn btn-primary">Hapus</button>
                                                            </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                            };
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; RCS Website 2021</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post">
                        <div class="modal-body">
                            <input type="text" name="namabarang" placeholder="Nama Barang" class="form-control" required><br>
                            <input type="text" name="deskripsi" placeholder="Deskripsi Barang" class="form-control" required><br>
                            <input type="number" name="stock" placeholder="Jumlah Barang" class="form-control" required><br>
                            <button type="submit" name="addnewbarang" class="btn btn-primary">Submit</button>
                        </div>
                </form>
            </div>
        </div>
    </div>

</html>
