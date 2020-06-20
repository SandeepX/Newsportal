
<?php


if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
	echo "<p class='alert alert-danger'>".$_SESSION['error'].'</p>';
	unset($_SESSION['error']);
}

if(isset($_SESSION['success']) && !empty($_SESSION['success'])){
	echo "<p class='alert alert-success'>".$_SESSION['success'].'</p>';
	unset($_SESSION['success']);
}

