<?php 
	function debugger($data, $is_die = false){
		echo "<pre>";
		print_r($data);
		echo "</pre>";
		if($is_die){
			exit;
		}
	}

	function getAllCategoriesRows($table){
		global $conn;
		$sql = "SELECT * FROM ".$table." ORDER BY id ASC LIMIT 0 ,7";
		$query = mysqli_query($conn, $sql);
		if(mysqli_num_rows($query) <= 0){
			return false;
		} else {
			$data = array();
			while($row = mysqli_fetch_assoc($query)){
				$data[] = $row;
			}
			return $data;
		}
	}

	function getlatestdata($table){
		global $conn;
		$sql = "SELECT * FROM ".$table." WHERE status = 1 ORDER BY id DESC LIMIT 0,1";
		$query = mysqli_query($conn, $sql);
		if(mysqli_num_rows($query) <= 0){
			return false;
		} else {
			$data = array();
			while($row = mysqli_fetch_assoc($query)){
				$data[] = $row;
			}
			return $data;
		}
	}
	function getlatestdatas($table,$no){
		global $conn;
		$sql = "SELECT * FROM ".$table." WHERE status = 1 ORDER BY id DESC LIMIT 0,".$no."";
		$query = mysqli_query($conn, $sql);
		if(mysqli_num_rows($query) <= 0){
			return false;
		} else {
			$data = array();
			while($row = mysqli_fetch_assoc($query)){
				$data[] = $row;
			}
			return $data;
		}
	}

	function getAllRows($table,$order){
		global $conn;
		$sql = "SELECT * FROM ".$table." ORDER BY id ".$order."";
		$query = mysqli_query($conn, $sql);
		if(mysqli_num_rows($query) <= 0){
			return false;
		} else {
			$data = array();
			while($row = mysqli_fetch_assoc($query)){
				$data[] = $row;
			}
			return $data;
		}
	}
	function getcatnews($table,$no,$cat_id){
		global $conn;
		$sql = "SELECT * FROM ".$table." WHERE status = 1 and cat_id = ".$cat_id." ORDER BY id DESC LIMIT 0,".$no."";
		$query = mysqli_query($conn, $sql);
		if(mysqli_num_rows($query) <= 0){
			return false;
		} else {
			$data = array();
			while($row = mysqli_fetch_assoc($query)){
				$data[] = $row;
			}
			return $data;
		}
	}

?>