<?php
$CustomerId = $_POST['customerid'];
$Name = $_POST['name'];
$Address = $_POST['address'];
$Pincode = $_POST['pincode'];
$Email = $_POST['email'];
$Phone = $_POST['phone'];
$MyIp = "localhost";
$MyUser = "infernal";
$MyPassword = "infernal";
$MyDatabase = "transport";

$conn = mysqli_connect($MyIp,$MyUser,$MyPassword,$MyDatabase);
if(!$conn){
	printf("Connection failed: %s\n",mysqli_connect_error());
	header('Refresh: 3; URL=add.html');
}

$sql = "INSERT INTO customer(customerid,name,address,pincode,phone,email) VALUES('".$CustomerId."','".$Name."','".$Address."','".$Pincode."','".$Phone."','".$Email."')";
if(mysqli_query($conn,$sql)){
	echo "<script>window.alert('Customer Added')</script>";
	header('Refresh: 0; URL=add.html');
	mysqli_commit($conn);
}
else {
	echo "<script>window.alert('Error User already exists')</script>";
	header('Refresh: 0; URL=add.html');
}
myslqi_close($conn);
?>
