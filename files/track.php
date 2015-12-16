<html>
<head>
<title>Send</title>
</head>
<body>
	<?php
		$MyIp = 'localhost';
		$MyUser = 'infernal';
		$MyPassword = 'infernal';
		$MyDatabase = 'transport';
		

		$conn = mysqli_connect($MyIp,$MyUser,$MyPassword,$MyDatabase);
		if (!$conn){
			printf("Connection Error. %s",mysqli_connect_error());
			exit();
		}
		$sql = "select batchid from goods where batchid not in (select batchid from sending)";
		$result = mysqli_query($conn,$sql);
		$transport = array();
		$good = array();
		while ($row = mysqli_fetch_assoc($result)){
			array_push($good,$row['batchid']);
		}
		$sql = "select transportid from carrier";
		$result = mysqli_query($conn,$sql);
		while ($row = mysqli_fetch_assoc($result)){
			array_push($transport,$row['transportid']);
		}
		mysqli_close($conn);
	?>
	

	<form action = "" method= "post">
	<label>Track vehicles:</label>
	<select name = "transpt">
	<?php 
	 for ( $x = 0 ; $x < count($transport) ; $x++)
		echo  "<option value=\"{$transport[$x]}\">{$transport[$x]}</option>";
	?>
	</select>
	<input type = "text" id = "location" name = "location" readonly/>
	<input type = "submit" value = "Track" />
	</form>
	<?php
		$MyIp = 'localhost';
		$MyUser = 'infernal';
		$MyPassword = 'infernal';
		$MyDatabase = 'transport';
		$t = $_POST['transpt'];

		$conn = mysqli_connect($MyIp,$MyUser,$MyPassword,$MyDatabase);
		if (!$conn){
			printf("Connection Error. %s",mysqli_connect_error());
			exit();
		}
		$sql = "select status from carrier where transportid = '".$t."'";
		$result = mysqli_query($conn,$sql);
		while ($row = mysqli_fetch_assoc($result)){
			$loc = $row['status'];
			printf("%s",$loc);
		}
		mysqli_close($conn);

	?>


	<br /> <br />


	<form action = "update_track.php" method= "post">
	<label>Send vehicles:</label>
	<select name = "transport">
	<?php 
	 for ( $x = 0 ; $x < count($transport) ; $x++)
		echo  "<option value=\"{$transport[$x]}\">{$transport[$x]}</option>";
	?>
	</select>
	<input type = "text" name = "location" />
	<input type = "submit" value = "Update" />
	</form>
</body>
</html>
