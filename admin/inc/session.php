<?php 
if(!isset($_SESSION, $_SESSION['session_id']) || empty($_SESSION['session_id']) || strlen($_SESSION['session_id']) != 100){
        $_SESSION['error'] = "Please login first.";
        @header('location: ./');
        exit;
    }