<?php
	$MyIp = "localhost";
	$MyUser = "infernal";
	$MyPassword = "infernal";
	$MyDatabase = "transport";
	$transport = $_POST['transport'];
	$location = $_POST['location'];
	
	$conn = mysqli_connect($MyIp,$MyUser,$MyPassword,$MyDatabase);
         if (!$conn){
             printf("Connection Error. %s",mysqli_connect_error());             
			 exit();
	   }  

	$sql = "UPDATE carrier set status = '".$location."' where transportid = '".$transport."'";
	if(mysqli_query($conn,$sql)){
		 echo "<script>window.alert('Updated')</script>";
		 header('Refresh: 0; URL = "track.php"');
		 mysqli_commit($conn);
	}
	else{
		 echo "<script>window.alert('Could not update')</script>";
		 header('Refresh: 0; URL = "track.php"');
		 exit();
	}
mysqli_close($conn);
?>
