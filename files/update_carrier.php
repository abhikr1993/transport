<?php
	$MyIp = "localhost";
	$MyUser = "infernal";
	$MyPassword = "infernal";
	$MyDatabase = "transport";
	$s = $_POST['send'];
	
	 $conn = mysqli_connect($MyIp,$MyUser,$MyPassword,$MyDatabase);
         if (!$conn){
             printf("Connection Error. %s",mysqli_connect_error());             
			 exit();
	   }  

	$sql = "UPDATE carrier set status = 'send' where transportid = '".$s."'";
	if(mysqli_query($conn,$sql)){
		 echo "<script>window.alert('Vehicle sent.')</script>";
		 header('Refresh: 0; URL = "send.php"');
		 mysqli_commit($conn);
	}
	else{
		 echo "<script>window.alert('Could not send.')</script>";
		 header('Refresh: 0; URL = "send.php"');
		 exit();
	}
mysqli_close($conn);
?>
