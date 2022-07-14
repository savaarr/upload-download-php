<?php 
$link = mysqli_connect("localhost","root","","dbxyz");
$id = $_GET['id'];
if(empty($_GET['id']))
{
	header("location:index.php");
}
elseif(!empty($_GET['id']))
{
$sql = mysqli_query($link, "SELECT * FROM gambar WHERE id = '$id'");
$data = mysqli_fetch_assoc($sql);
$pile = $data['nama'];
unlink("pile/".$pile);
$sqli = mysqli_query($link, "DELETE FROM gambar WHERE id = '$id'");
if($sqli)
	{
		header("location:index.php");
	}
}
?>