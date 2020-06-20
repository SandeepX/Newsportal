<?php 
    require 'inc/config.php';
    require 'inc/functions.php';
    require 'inc/session.php';


    if(isset($_POST) && !empty($_POST)){
        $data = array();
        $url =array();
        $data['name'] = sanitize($_POST['name']);
        $data['status'] = (int)$_POST['status'];
        parse_str($_POST['url'],$url);
        $data['url'] = array_shift($url);
        $video_id = (isset($_POST['video_id']) && !empty($_POST['video_id'])) ? (int)$_POST['video_id'] : null;
        // File Upload     

    
        if($video_id && $video_id >0) {
            $act = "updat";
            $video_id = updateData($data,'video', $video_id);
            
        } else {
            $act = "add";
            $video_id = addCategory($data,'video');    
        }


        if($video_id){
            $_SESSION['success'] = "Video ".$act."ed successfully.";
        } else {
            $_SESSION['error'] = 'Sorry! There was problem while '.$act.'ing Video.';

        }
        @header('location: video-list');
        exit;

    }   else {
        $_SESSION['error'] = "Unauthorized access.";
        @header('location: video-list');
        exit;
    }