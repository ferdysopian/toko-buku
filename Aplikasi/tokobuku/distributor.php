<?php
session_start();
if(!isset($_SESSION['username'])) {
	header('location:login.php');
}
if(isset($_SESSION['level'])){
	$level=$_SESSION['level'];
}
if($level != 'admin'){
	header("location:index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Distributor</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="wrapper">
		<nav>
			<div class="navbar">
				<div class="pull-left">
					<a class="brand" href="#"><b>TOKO BUKU </b></a>
				</div>
				<div class="pull-right">
					<div class="navbar-menu">
						<ul>
							<li>
								<form action="buku.php" method="get">
									<input type="text" name="search" placeholder="Masukan judul penulis atau tahun buku ...">
									<input type="submit" name="submit" class="btnsearch" value="">
								</form>
							</li>
							<li><a href="proses/proses-logout.php">Log Out</a></li>
						</ul>
					</div>
				</div>
			</div>
		</nav>
		<div class="sidebar">
			<a href="#" class="btnclose">X</a>
			<?php
			if($level=='admin'){
				?>
				<div class="dropdown">
					<a href="index.php" class="active">Home</a>
				</div>
				<div class="dropdown">
					<a href="kasir.php" class="dropbtn">Kasir</a>
					<div class="dropdown-content">
						<a href="kasir.php?action=input">Input</a>
					</div>
				</div>
				<div class="dropdown">
					<a href="buku.php" class="dropbtn">Buku</a>
					<div class="dropdown-content">
						<a href="buku.php?action=input">Input</a>
					</div>
				</div>
				<div class="dropdown">
					<a href="distributor.php" class="dropbtn">Distributor</a>
					<div class="dropdown-content">
						<a href="distributor.php?action=input">Input</a>
					</div>
				</div>
				<div class="dropdown">
					<a href="pasok.php" class="dropbtn">Pasok</a>
					<div class="dropdown-content">
						<a href="pasok.php?action=input">Input</a>
					</div>
				</div>
				<div class="dropdown">
					<a href="penjualan.php" class="dropbtn">Penjualan</a>
					<div class="dropdown-content">
						<a href="penjualan.php?action=input">Input</a>
					</div>
				</div>
				<div class="dropdown">
					<a href="laporan.php" class="dropbtn">Laporan</a>
				</div>
				<?php
			}else{
				?>
				<div class="dropdown">
					<a href="index.php" class="active">Home</a>
				</div>
				<div class="dropdown">
					<a href="buku.php" class="dropbtn">Buku</a>
				</div>
				
				<div class="dropdown">
					<a href="penjualan.php" class="dropbtn">Penjualan</a>
					<div class="dropdown-content">
						<a href="penjualan.php?action=input">Input</a>
					</div>
				</div>
				<div class="dropdown">
					<a href="laporan.php" class="dropbtn">Laporan</a>
				</div>
				<?php } ?>
			</div>
			<div class="content-wrap">
				<div class="content">
					<?php
					if(isset($_GET['action'])){
						if($_GET['action'] == 'input'){
							echo	"
							<h1>Input Distributor</h1>
							<hr>
							<form action=\"proses/proses-input.php\" method=\"post\">
							<div class=\"form-group\">
							<label>Nama Distributor</label>
							<input type=\"text\" name=\"namaDistributor\" required>
							</div>
							<div class=\"form-group\">
							<label>Alamat</label>
							<input type=\"text\" name=\"alamat\" required>
							</div>
							<div class=\"form-group\">
							<label>Telpon</label>
							<input type=\"text\" name=\"telp\" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 0' required>
							</div>
							<div class=\"form-group\">
							<input type=\"submit\" name=\"submit\">
							<input type=\"hidden\" name=\"type\" value=\"1\">
							</div>
							</form>";
						}
						else if($_GET['action'] == 'edit'){
							if(!isset($_GET['id'])){
								header('location:distributor.php');
							}else{
								include "proses/Distributor.php";
								$Distributor = new \APP\Distributor();
								$Distributor->data($_GET['id']);
								echo	"
								<h1>Edit Distributor</h1>
								<hr>
								<form action=\"proses/proses-edit.php?id=".$_GET['id']."\" method=\"post\">
								<div class=\"form-group\">
								<label>Nama Distributor</label>
								<input type=\"text\" name=\"namaDistributor\" value=\"".$Distributor->namaDistributor."\" required>
								</div>
								<div class=\"form-group\">
								<label>Alamat</label>
								<input type=\"text\" name=\"alamat\" value=\"".$Distributor->alamat."\" required>
								</div>
								<div class=\"form-group\">
								<label>Telpon</label>
								<input type=\"text\" name=\"telp\" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 0' value=\"".$Distributor->telepon."\" required>
								</div>
								<div class=\"form-group\">
								<input type=\"submit\" name=\"submit\">
								<input type=\"hidden\" name=\"type\" value=\"1\">
								</div>
								</form>";
							}
						}
					}else{
						include "proses/Distributor.php";
						$Distributor = new \APP\Distributor();
						echo	"
						<h1>Distributor</h1>
						<hr>
						<table>
						<thead>
						<tr>
						<th>ID</th>
						<th>Nama</th>
						<th>Alamat</th>
						<th>Telp</th>
						<th>Action</th>
						</tr>
						</thead>
						<tbody>";
						echo		$Distributor->select();
						echo				"</tbody>
						</table>";
					}
					?>
				</div>
			</div>
			<div style="clear:both;"></div>
		</div>
	</body>
	</html>
