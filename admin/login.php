<?php


require 'inc/config.php';
require 'inc/functions.php';

if(isset($_POST) && !empty($_POST)){
	$username = filter_var($_POST['username'], FILTER_VALIDATE_EMAIL);

	if(!$username){
		$_SESSION['error'] = 'Invalid username. Username should be of email type.';
		@header('location: ./');
		exit;
	}

	$password = sha1($username.$_POST['password']);
	$user_info = getUserByUsername($username);
	/*if($user_info){
			@header('location: dashboard');
	}*/
	/*Sql */
	if($user_info){
		if($password === $user_info['password']){
			if($user_info['status'] == 1){
				if($user_info['roles'] == 1){
					$_SESSION['user_id'] = $user_info['id'];
					$_SESSION['name'] = $user_info['full_name'];

					$_SESSION['session_id'] = generateRandomString();


					$_SESSION['success'] = 'Welcome to admin panel of newsporal.mor.';
					@header('location: dashboard');
					exit;
				} else {
					$_SESSION['error'] = 'You do not have previlage to access admin pane. Please contact our admin.';
					@header('location: ./');
					exit;
				}
			} else {
				$_SESSION['error'] = 'User not activated.';
				@header('location: ./');
				exit;
			}
		} else {
			$_SESSION['error'] = 'Password does not match.';
			@header('location: ./');
			exit;
		}
	} else {
		$_SESSION['error'] = 'Invalid username.';
		@header('location: ./');
		exit;
	}
} else {
	$_SESSION['error'] = 'Unauthorized access.';
	@header('location: ./');
	exit;
}
