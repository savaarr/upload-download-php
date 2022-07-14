<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Upload File</title>
</head>
<body>
<center>
<h2 style="padding:12px 20px;background: brown;color:white;width:57%;font-family: arial;">Upload File</h2>
<button style="border: none;background: grey;padding: 7px 25px;" >
	<a style="text-decoration: none;color: white;" href="index.php">Kembali</a>
</button><br><p>
<table border="1" cellpadding="10" cellspacing="0" align="center" width="60%">
<tr>
	<th width="5%"><br>
<?php 
$link = mysqli_connect("localhost","root","","dbxyz");
if(isset($_POST['upload']))
{
	$fileName = $_FILES['file']['name'];
	$file = round(microtime(true))."-".$fileName;
	$tmp = $_FILES['file']['tmp_name'];
	$path = "pile/".$file;
	$limit = 10 * 1024 * 1024;
	$size = $_FILES['file']['size'];
	$accept = array('jpg', 'png', 'jpeg', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'zip', 'rar');
	$ekstensi = explode('.', $fileName);
	$ekstensi = strtolower(end($ekstensi));
	if(!in_array($ekstensi, $accept))
	{
		echo "<script>";
		echo "alert('Ekstensi file tidak diizinkan!')";
		echo "</script>";
	}
	elseif($size > $limit)
	{
		echo "<script>";
		echo "alert('Ukuran file terlalu besar!')";
		echo "</script>";
	}
	else
	{
	move_uploaded_file($tmp, $path);
	$save = mysqli_query($link, "INSERT INTO gambar VALUES ('', '$file')");
	if($save)
	{
		echo "<script>";
		echo "alert('Upload file berhasil!')";
		echo "</script>";
		header("location:index.php");
	}
	else
		{
		echo "<script>";
		echo "alert('Upload file gagal!')";
		echo "</script>";
		header("location:upload-file.php");
	}
}
}
?>

<form action="" method="POST" enctype="multipart/form-data">
	<input type="file" name="file" required><p>
	<input type="submit" name="upload" value="Upload"> 
	<input type="reset" value="Bersih">
</form>
<p>

</th>
</tr>
</table>
</center>

</body>
</html>