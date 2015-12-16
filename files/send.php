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
		$sql = "select transportid from carrier where status = 'Idle'";
		$result = mysqli_query($conn,$sql);
		while ($row = mysqli_fetch_assoc($result)){
			array_push($transport,$row['transportid']);
		}
	?>
	
	<form action = "update_sending.php" method= "post">

	<label>Goods to be delivered:</label>
	<select name = "goods">
	<?php 
	 for ( $x = 0 ; $x < count($good) ; $x++)
		echo  "<option value=\"{$good[$x]}\">{$good[$x]}</option>";
	?>
	</select>
	
	<label>Transport vehicles available:</label>
	<select name = "transport">
	<?php 
	 for ( $x = 0 ; $x < count($transport) ; $x++)
		echo  "<option value=\"{$transport[$x]}\">{$transport[$x]}</option>";
	?>
	</select>
	<input type = "submit" value = "Assign" />
	</form>

	<br /><br />


	<label>Send vehicles:</label>
	<form action = "update_carrier.php" method ="post">
	<select name = "send">
	<?php 
	 for ( $x = 0 ; $x < count($transport) ; $x++)
		echo  "<option value=\"{$transport[$x]}\">{$transport[$x]}</option>";
	?>
	</select>
	<input type = "submit" value = "Send" />
	</form>

</body>
</html>
