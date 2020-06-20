<?php 
	function debugger($data, $action= false){
		echo "<pre>";
		print_r($data);
		echo "</pre>";
		if ($action) {
			exit;
		}
	}

	function getgallerybyForeignKey($table,$foreignkey){
		global $conn;
		$sql = "SELECT * FROM ".$table." WHERE status = 1 and foreign_key = ".$foreignkey."";
		// echo $sql;
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

	function getAllRowsofgallery($table,$no_id){
		global $conn;
		$sql = "SELECT * FROM ".$table." WHERE id !=".$no_id." ORDER BY id DESC";
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