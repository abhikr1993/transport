<?php
	$MyIp = "localhost";
	$MyUser = "infernal";
	$MyPassword = "infernal";
	$MyDatabase = "transport";
	$LoginName = $_POST['name'];
	$LoginUser = $_POST['username'];
	$LoginPassword = $_POST['password'];
	$LoginRepeatPassword = $_POST['password2'];
	
	$conn = mysqli_connect($MyIp,$MyUser,$MyPassword,$MyDatabase);
	if (!$conn){
		die ("Connection failed\n".mysqli_connect_error());
		header('Refresh: 2; URL=signup.html');
		exit();
	}
	if(!$LoginUser){
		echo"<script>window.alert('Enter a username')</script>";
		header('Refresh: 0; URL=signup.html');
		exit();
	}

	if (!$LoginPassword){
		echo"<script>window.alert('Enter a password')</script>";
		header('Refresh: 0; URL=signup.html');
		exit();
		//header("location: signup.html");
	}
	if(!$LoginRepeatPassword){
		echo"<script>window.alert('Passwords dont match')</script>";
		header('Refresh: 0; URL=signup.html');
		exit();
	}
	if ($LoginPassword != $LoginRepeatPassword){
		echo"<script>window.alert('Passwords dont match!!')</script>";
		header('Refresh: 0; URL=signup.html');
		exit();
	}
	$sql = mysqli_prepare($conn,"INSERT INTO login(username,password,name) VALUES ( ?,?,? )");
	mysqli_stmt_bind_param($sql,"sss",$LoginUser,$LoginPassword,$LoginName);
	mysqli_stmt_execute($sql);
	if(mysqli_stmt_affected_rows($sql) < 0){
		echo"<script>window.alert('Username taken please use other username')</script>";
		header('Refresh: 0; URL=signup.html');
		exit();
	}
	else{
		echo"<script>window.alert('Registered please login to continue')</script>";
		header('Refresh: 0; URL=../login.html');
		exit();
	}
mysqli_close($conn);
?>
