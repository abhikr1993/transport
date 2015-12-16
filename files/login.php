<?php
$MyIp = "localhost";
$MyUser = "infernal";
$MyPassword = "infernal";
$MyDatabase = "transport";
$LoginUser = $_POST['username'];
$LoginPassword = $_POST['password'];
$conn = mysqli_connect($MyIp,$MyUser,$MyPassword,$MyDatabase);
if (!$conn)
{
	die("Connection failed".mysqli_connect_error());
}
$sql = "SELECT * FROM login where username = '".$LoginUser."' and password = '".$LoginPassword."'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result,MYSQLI_NUM);
if( mysqli_num_rows($result) > 0){
	if($row[0] == $LoginUser && $row[1] == $LoginPassword){
		echo"<script>window.alert('Loggin in')</script>";
		header('Refresh: 0; URL=task.html');
		exit();
		}
	else{
		echo"<script>window.alert('Invalid username/password')</script>";
		header('Refresh: 0; URL=../login.html');
	}
	
}
else{
	echo"<script>window.alert('Invalid username/password')</script>";
	header('Refresh: 0; URL=../login.html');
}
mysqli_close($conn);

?>
