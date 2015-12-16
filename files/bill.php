	<?php
		$MyIp = 'localhost';
		$MyUser = 'infernal';
		$MyPassword = 'infernal';
		$MyDatabase = 'transport';
		$BatchId = $_POST['batchid'];

		$conn = mysqli_connect($MyIp,$MyUser,$MyPassword,$MyDatabase);
		if (!$conn){
			printf("Connection Error. %s",mysqli_connect_error());
			exit();
		}
		$sql = "SELECT weight from goods where batchid = '".$BatchId."'";
		$result = mysqli_query($conn,$sql);
		while ($row = mysqli_fetch_assoc($result)){
			$weight = $row['weight'];
		}

		$sql = "SELECT distance from g_customer where batchid = '".$BatchId."'";
		$result = mysqli_query($conn,$sql);
		while ($row = mysqli_fetch_assoc($result)){
			$distance = $row['distance'];
		}

		$sql = "SELECT rate from carrier where transportid in (SELECT transportid from sending where batchid = '".$BatchId."')";
		$result = mysqli_query($conn,$sql);
		while ($row = mysqli_fetch_assoc($result)){
			$rate = $row['rate'];
		}


		$sql = "SELECT exporterid from g_customer where batchid = '".$BatchId."'";
		$result = mysqli_query($conn,$sql);
		while ($row = mysqli_fetch_assoc($result)){
			$custid = $row['exporterid'];
		}
		$total = $rate * $weight * $distance;
		$sql = "INSERT IGNORE INTO bill(customerid, batchid, rate, distance, weight, total) values('".$custid."','".$BatchId."','".$rate."','".$distance."','".$weight."','". $total."')";

		if(!mysqli_query($conn,$sql)){
			echo "<script>window.alert('Batchid not in database')</script>";
			header('Refresh: 0; URL=bill.html');
		}
	mysqli_commit($conn);

		//	printf("cust: %s weight: %s dist: %s rate: %s total: %s",$custid,$weight,$distance,$rate,$total);
mysqli_close($conn);
	?>

<html>
<head>
<title>Bill</title>
</head>
<body>
<center>
<pre>
	<label>BatchId:	</label><input type = "text" name = "batchid" value = <?php echo $BatchId; ?> />
	<br /><br />
	<label>Weight:		</label><input type = "text" name = "weight"  value = <?php echo $weight; ?> />
	<br /><br />
	<label>Distance:	</label><input type = "text" name = "distance" value = <?php echo $distance; ?> />
	<br /><br />
	<label>Rate:		</label><input type = "text" name = "rate" value = <?php echo $rate; ?> />
	<br /><br />
	<label>Total:		</label><input type = "text" name = "total" value = <?php echo $total; ?> />
</pre>
</center>
</body>
</html>

