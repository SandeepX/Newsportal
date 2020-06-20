<?php 
    require 'inc/config.php';
    require 'inc/functions.php';
    require 'inc/session.php';


    if(isset($_POST) && !empty($_POST)){
        $data = array();
        $data['name'] = sanitize($_POST['title']);
        $data['summary'] = sanitize($_POST['summary']);
        $data['status'] = (int)$_POST['status'];
        $data['added_by'] = $_SESSION['user_id'];

        $cat_id = (isset($_POST['cat_id']) && !empty($_POST['cat_id'])) ? (int)$_POST['cat_id'] : null;
        // File Upload     

        if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            if(in_array($ext, ALLOWED_EXTENSION)){
                if($_FILES['image']['size'] <= (5*1024*1024)){
                    $destination = UPLOAD_DIR.'category/';

                    if(!is_dir($destination)){
                        mkdir($destination, '0777', true);
                    }

                    $file_name = "Category-".date('Ymdhis').rand(0,999).".".$ext;
                    $succes = move_uploaded_file($_FILES['image']['tmp_name'], $destination.$file_name);



                    if($succes){
                        $data['image'] = $file_name;
                    }
                }
            }
        }


        if(isset($_POST['delete_image']) && !empty($_POST['delete_image'])){
            if(file_exists(UPLOAD_DIR.'category/'.$_POST['delete_image'])){
                unlink(UPLOAD_DIR.'category/'.$_POST['delete_image']);
                /*$data['image'] = null;*/
            }
        }

        if($cat_id && $cat_id >0) {
            $act = "updat";
            $cat_id = updateData($data,'categories', $cat_id);
            
        } else {
            $act = "add";
            $cat_id = addCategory($data,'categories');    
        }


        if($cat_id){
            $_SESSION['success'] = "Category ".$act."ed successfully.";
        } else {
            $_SESSION['error'] = 'Sorry! There was problem while '.$act.'ing category.';

        }
        @header('location: category-list');
        exit;

    } else if(isset($_GET, $_GET['id'], $_GET['act']) && !empty($_GET['id']) && !empty($_GET['act']) && $_GET['act'] == 'delete'){
        $id = (int) $_GET['id'];
        if($id > 0){
            $cat_info = getSingleRow('categories', $id);
            if($cat_info){
                $del = delete('categories', 'id', $id);
                if($del){
                    if($cat_info[0]['image']!="" && file_exists(UPLOAD_DIR.'category/'.$cat_info[0]['image'])){
                        unlink(UPLOAD_DIR.'category/'.$cat_info[0]['image']);
                    }

                    $_SESSION['success'] = "Category deleted successfully.";
                    @header('location: category-list');
                    exit; 
                } else {
                    $_SESSION['error'] = "Sorry! There was problem while deleting category.";
                    @header('location: category-list');
                    exit; 
                }
            } else {
                $_SESSION['error'] = "Category Not found";
                @header('location: category-list');
                exit; 
            }
            
        } else {
            $_SESSION['error'] = "Invalid Id.";
            @header('location: category-list');
            exit;    
        }
    }   else {
        $_SESSION['error'] = "Unauthorized access.";
        @header('location: category-list');
        exit;
    }