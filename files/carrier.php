<?php
$TransportId = $_POST['transportid'];
$Type = $_POST['type'];
$Rate = $_POST['rate'];
$Status = $_POST['status'];
$MyIp = "localhost";
$MyUser = "infernal";
$MyPassword = "infernal";
$MyDatabase = "transport";

$conn = mysqli_connect($MyIp,$MyUser,$MyPassword,$MyDatabase);
if(!$conn){
	printf("Connection failed: %s\n",mysqli_connect_error());
	header('Refresh: 3; URL=carrier.html');
}

$sql = "INSERT INTO carrier(transportid,type,rate,status) VALUES('".$TransportId."','".$Type."','".$Rate."','".$Status."')";
if(mysqli_query($conn,$sql)){
	echo "<script>window.alert('Carrier Added')</script>";
	header('Refresh: 0; URL=carrier.html');
	mysqli_commit($conn);
}
else {
	echo "<script>window.alert('Error Carrier already exists')</script>";
	header('Refresh: 0; URL=carrier.html');
}
myslqi_close($conn);
?>
