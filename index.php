<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Download File</title>
</head>
<body>
<center>
<h2 style="padding:12px 20px;background: green;color:white;width:57%;font-family: arial;">Download File</h2>
<table border="1" cellpadding="10" cellspacing="0" align="center" width="60%">
<tr>
	<th width="5%">No</th>
	<th>Nama File</th>
	<th>Hapus</th>
</tr>
<?php 
$link = mysqli_connect("localhost","root","","dbxyz");
$batas = 5;
$halaman = @$_GET['halaman'];
if(empty($halaman))
{
	$posisi = 0;
	$halaman = 1;
}
else
{
	$posisi = ($halaman-1) * $batas;
}
$sql = mysqli_query($link, "SELECT * FROM gambar LIMIT $posisi, $batas");
$no = $posisi+1;
while($row = mysqli_fetch_assoc($sql))
{
$file = $row['nama'];
$img = "pile/".$file;
?>

	<tr>
		<td align="center"><?=$no++;?></td>
		<td><a style="text-decoration: none;color: black;" href="download.php?file=<?=$file;?>"><?=substr($file, 11);?></a></td>
		<td width="5%" align="center"><a onclick="return confirm('Yakin mau hapus?');" style="text-decoration: none;color:red;" href="hapus.php?id=<?=$row['id'];?>"><img src="warning.png" width="20px"></a></td>
	</tr>

<?php
}
?>
</table><br>
<?php
$query2 = mysqli_query($link, "SELECT * FROM gambar");
$jmldata = mysqli_num_rows($query2);
$jmlhalaman = ceil($jmldata/$batas);
echo "<br>Halaman: ";
for($i=1; $i<=$jmlhalaman;$i++)
if($i != $halaman)
{
	echo "<a style='text-decoration:none;color:white;background:green;padding:3px 8px' href='index.php?halaman=$i'>$i</a>";
}
else
{
	echo "<b style='text-decoration:none;color:white;background:grey;padding:3px 8px'>$i</b>";
}
echo "<b> [$jmldata</b> File]";
?>
<br><br><p><a style="padding:7px 25px;text-decoration: none;background: brown;color:white;width:57%;font-family: arial;" href="upload-file.php" style="text-decoration:none;color:red;">Tambah Baru</a><p>
</center>

</body>
</html>