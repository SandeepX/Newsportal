<?php 
    require 'inc/config.php';
    require 'inc/functions.php';
    require 'inc/session.php';
    if(isset($_POST) && !empty($_POST)){

        $data = array();
        $data['full_name'] = sanitize($_POST['full_name']);
        $data['email_address'] = filter_var($_POST['email_address'],FILTER_VALIDATE_EMAIL);
        $data['roles'] = (int)$_POST['roles'];
        $data['status'] = (int)$_POST['status'];
        $data['password'] = sha1($_POST['email_address'].$_POST['password']);

        $user_id = (isset($_POST['user_id']) && !empty($_POST['user_id'])) ? (int)$_POST['user_id'] : null;

        // File Upload     
        if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            if(in_array($ext, ALLOWED_EXTENSION)){
                if($_FILES['image']['size'] <= (5*1024*1024)){
                    $destination = UPLOAD_DIR.'user/';

                    if(!is_dir($destination)){
                        mkdir($destination, '0777', true);
                    }

                    $file_name = "user-".date('Ymdhis').rand(0,999).".".$ext;
                    $succes = move_uploaded_file($_FILES['image']['tmp_name'], $destination.$file_name);
                    if($succes){
                        $data['image'] = $file_name;
                    }
                }
            }
        }


        if(isset($_POST['delete_image']) && !empty($_POST['delete_image'])){
            if(file_exists(UPLOAD_DIR.'user/'.$_POST['delete_image'])){
                unlink(UPLOAD_DIR.'user/'.$_POST['delete_image']);
                /*$data['image'] = null;*/
            }
        }
        if($user_id && $user_id >0) {
            $act = "updat";
            $user_id = updateData($data,'users', $user_id);
            
        } else {
            $act = "add";
            $user_id = addCategory($data,'users');    
        }


        if($user_id){
            $_SESSION['success'] = "user ".$act."ed successfully.";
        } else {
            $_SESSION['error'] = 'Sorry! There was problem while '.$act.'ing user.';

        }
        @header('location: user-list');
        exit;

    } else if(isset($_GET, $_GET['id'], $_GET['act']) && !empty($_GET['id']) && !empty($_GET['act']) && $_GET['act'] == 'delete'){
        $id = (int) $_GET['id'];
        if($id > 0){
            $user_info = getSingleRow('users', $id);
            if($user_info){
                $del = delete('users', 'id', $id);
                if($del){
                    if($user_info[0]['image']!="" && file_exists(UPLOAD_DIR.'user/'.$user_info[0]['image'])){
                        unlink(UPLOAD_DIR.'user/'.$user_info[0]['image']);
                    }

                    $_SESSION['success'] = "user deleted successfully.";
                    @header('location: user-list');
                    exit; 
                } else {
                    $_SESSION['error'] = "Sorry! There was problem while deleting user.";
                    @header('location: user-list');
                    exit; 
                }
            } else {
                $_SESSION['error'] = "user Not found";
                @header('location: user-list');
                exit; 
            }
            
        } else {
            $_SESSION['error'] = "Invalid Id.";
            @header('location: user-list');
            exit;    
        }
    }   else {
        $_SESSION['error'] = "Unauthorized access.";
        @header('location: user-list');
        exit;
    }