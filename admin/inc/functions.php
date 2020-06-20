<?php



function debugger($data, $is_die = false){
	echo "<pre>";
	print_r($data);
	echo "</pre>";
	if($is_die){
		exit;
	}
}

function getUserByUsername($user_name){
	global $conn;
	$sql = "SELECT * FROM users WHERE email_address = '".$user_name."' ";
	$query = mysqli_query($conn, $sql);
	if(mysqli_num_rows($query) <= 0){
		return false;
	} else {
		$data = mysqli_fetch_assoc($query);
		return $data;
	}
}

function generateRandomString($length = 100){
	$chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$chars_len = strlen($chars);
	$random = "";
	for($i=0; $i< $length; $i++){
		$random .= $chars[rand(0, $chars_len-1)];
	}

	return $random;
}


function sanitize($str){
	global $conn;
	$str = strip_tags($str);
	$str = trim(rtrim($str));

	$str = mysqli_real_escape_string($conn, $str);
	return $str;
}

function addCategory($data, $table){
	/*INSERT INTO categories SET 
	column_name = 'value', 
	column_name = value, 
	column_name = value, 
	column_name = value, 
	.... */
	global $conn;
	$sql = "INSERT INTO ".$table." SET ";
	if(isset($data) && is_array($data)){
		$temp = array();
		foreach($data as $column_name => $value){
			$str = $column_name." = ";
			if(is_string($value)){
				$str .= "'".$value."'";
			} else if(is_null($value)){
				$str .= 'NULL';
			}
			else {
				$str .= $value;
			}
			$temp[] = $str;
		}

		$sql .=implode(", ", $temp);
		echo $sql;
		// exit;

		$query = mysqli_query($conn, $sql);
		if($query){
			return mysqli_insert_id($conn);
		} else {
			return false;
		}
	} else {
		return false;
	}
}

function getAllRows($table){
	global $conn;
	$sql = "SELECT * FROM ".$table." ORDER BY id DESC";
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

function getSingleRow($table, $id){
	global $conn;
	$sql = "SELECT * FROM ".$table." WHERE id = ".$id." ORDER BY id DESC";
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

function delete($table, $field, $id){
	global $conn;
	$sql = "DELETE FROM ".$table." WHERE ".$field." = ".$id;
	$query = mysqli_query($conn, $sql);
	if($query){
		return true;
	} else {
		return false;
	}
}

function updateData($data, $table, $row_id){
	/*UPDATE categories SET column_name = value, ..... WHERE id = $row_id*/
	global $conn;
	$sql = "UPDATE ".$table." SET ";
	if(isset($data) && is_array($data)){
		$temp = array();
		foreach($data as $column_name => $value){
			$str = $column_name." = ";
			if(is_string($value)){
				$str .= "'".$value."'";
			} elseif(empty($value)){
				$str .= 'NULL';
			}else {
				$str .= $value;
			}
			$temp[] = $str;
		}

		$sql .=implode(", ", $temp);

		$sql .= " WHERE id = ".$row_id;
	/*	echo $sql;
		exit;*/
        $query = mysqli_query($conn, $sql);         
        if($query){
        	return $row_id;         
        } else {
        	return false;
        }     
    } else {
        return false;     
    } 
}

function make_thumb($src, $dest, $desired_width,$desired_height) {
    /* read the source image */
    $source_image = imagecreatefromjpeg($src);
    $width = imagesx($source_image);
    $height = imagesy($source_image);

    /* find the "desired height" of this thumbnail, relative to the desired width  */

    /* create a new, "virtual" image */
    $virtual_image = imagecreatetruecolor($desired_width, $desired_height);

    /* copy source image at a resized size */
    imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);

    /* create the physical thumbnail image to its destination */
    imagejpeg($virtual_image, $dest);
}
