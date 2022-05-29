<?php
	include('config.php');
		
	if(isset($_REQUEST['id'])){
		$id=$_REQUEST['id'];

		 $checkIfExistQuery = "SELECT * FROM booking WHERE `booking_id`='$id'";
		 
		 if ($result = mysqli_query($conn, $checkIfExistQuery)) {
        $rowcount = mysqli_num_rows($result);
		}
	 
		
			$sql = "UPDATE booking SET status = 'Visited' WHERE `booking_id`='$id'";

			mysqli_query($conn, $sql);
		
		
			echo '<script>alert("Visited!!!")</script>';
	
		header('location:myAppoinment.php');

	}
?> 

