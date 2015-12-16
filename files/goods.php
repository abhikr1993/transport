<?php
$MyIp = "localhost";
$MyUser = "infernal";
$MyPassword = "infernal";
$MyDatabase = "transport";
$BatchId = $_POST['batchid'];
$ExporterId = $_POST['exporterid'];
$ImporterId = $_POST['importerid'];
$ItemList = $_POST['itemlist'];
$Weight = $_POST['weight'];
$Distance = $_POST['distance'];

$conn = mysqli_connect($MyIp,$MyUser,$MyPassword,$MyDatabase);
if (!$conn)
{
	die("Connection failed".mysqli_connect_error());
}
$sql = "INSERT INTO goods(batchid,itemlist,weight) values('".$BatchId."','".$ItemList."','".$Weight."')";
if(!mysqli_query($conn,$sql)){
	echo"<script>window.alert('Use another GoodsId')</script>";
	header('Refresh: 0; URL=goods.html');
	exit();
	}
mysqli_commit($conn);

$sql = "INSERT INTO g_customer(exporterid,importerid,batchid,distance) values('".$ExporterId."','".$ImporterId."','".$BatchId."','".$Distance."')";
if(mysqli_query($conn,$sql)){
	echo"<script>window.alert('Saved')</script>";
	header('Refresh: 0; URL=goods.html');	
}
else {
	echo"<script>window.alert('Error in saving.')</script>";
	header('Refresh: 0; URL=goods.html');	
	exit();
}
mysqli_commit($conn);
mysqli_close($conn);

?>
