<?php
	$MyIp = "localhost";
	$MyUser = "infernal";
	$MyPassword = "infernal";
	$MyDatabase = "transport";
	$g = $_POST['goods'];
	$p = $_POST['transport'];
	
	$conn = mysqli_connect($MyIp,$MyUser,$MyPassword,$MyDatabase);
         if (!$conn){
             printf("Connection Error. %s",mysqli_connect_error());             
			 exit();
	   }  

	$sql = "INSERT INTO sending(transportid,batchid) values('".$p."','".$g."')";
	if(mysqli_query($conn,$sql)){
		 echo "<script>window.alert('Assigned')</script>";
		 header('Refresh: 0; URL = "send.php"');
		 mysqli_commit($conn);
	}
	else{
		 echo "<script>window.alert('Could not assign')</script>";
		 header('Refresh: 0; URL = "send.php"');
		 exit();
	}
mysqli_close($conn);
?>
