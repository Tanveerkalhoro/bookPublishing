<?php
include("connection.php");
extract($_REQUEST);
switch ($source_field) {
	case 'state_id':
		$sql 	= "	SELECT * FROM city WHERE state_id = '".$state_id."' ;";
		$result	= mysqli_query($conn, $sql);
		$count	=mysqli_num_rows($result);
		if ($count > 0) {
			$array[] = array('0' => 'Select City');
			while ($row = mysqli_fetch_assoc($result)) {
				$array[] = array($row['city_id'] => $row['city_name']);
			}
		} else {
			$array[] = array('0' => 'No City');
		}
		break;	
		case 'state_id2':
			$sql 	= "	SELECT * FROM city WHERE state_id = '".$state_id2."' ;";
			$result	= mysqli_query($conn, $sql);
			$count	=mysqli_num_rows($result);
			if ($count > 0) {
				$array[] = array('0' => 'Select City');
				while ($row = mysqli_fetch_assoc($result)) {
					$array[] = array($row['city_id'] => $row['city_name']);
				}
			} else {
				$array[] = array('0' => 'No City');
			}
			break;	
		
}
echo json_encode($array);
