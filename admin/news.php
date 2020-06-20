<?php 
    require 'inc/config.php';
    require 'inc/functions.php';
    require 'inc/session.php';

    if(isset($_POST) && !empty($_POST)){

        $data = array();
        $data['title'] = sanitize($_POST['title']);
        $data['summary'] = sanitize($_POST['summary']);
        $data['description'] = htmlentities($_POST['description']);
        $data['cat_id'] = (int)$_POST['cat_id'];
        $data['reporter'] = isset($_POST['reporter']) ? (int)$_POST['reporter'] : null;
        $data['location'] = sanitize($_POST['location']);
        $data['is_breaking'] = isset($_POST['is_breaking']) ? 1 : 0;
        $data['is_featured'] = isset($_POST['is_featured']) ? 1 : 0;
        $data['focused_text'] = sanitize($_POST['focused_text']);
        $data['status'] = (int)$_POST['status'];
        $data['added_by'] = $_SESSION['user_id'];

        $news_id = (isset($_POST['news_id']) && !empty($_POST['news_id'])) ? (int)$_POST['news_id'] : null;

        // File Upload     

        if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            if(in_array($ext, ALLOWED_EXTENSION)){
                if($_FILES['image']['size'] <= (5*1024*1024)){
                    $destination = UPLOAD_DIR.'news/';

                    if(!is_dir($destination)){
                        mkdir($destination, '0777', true);
                    }

                    $file_name = "News-".date('Ymdhis').rand(0,999).".".$ext;
                    $succes = move_uploaded_file($_FILES['image']['tmp_name'], $destination.$file_name);



                    if($succes){
                        $data['image'] = $file_name;
                    }
                }
            }
        }


        if(isset($_POST['delete_image']) && !empty($_POST['delete_image'])){
            if(file_exists(UPLOAD_DIR.'news/'.$_POST['delete_image'])){
                unlink(UPLOAD_DIR.'news/'.$_POST['delete_image']);
                /*$data['image'] = null;*/
            }
        }

        if($news_id && $news_id >0) {
            $act = "updat";
            $news_id = updateData($data,'news', $news_id);
            
        } else {
            $act = "add";
            $news_id = addCategory($data,'news');    
        }


        if($news_id){
            $_SESSION['success'] = "News ".$act."ed successfully.";
        } else {
            $_SESSION['error'] = 'Sorry! There was problem while '.$act.'ing news.';

        }
        @header('location: news-list');
        exit;

    } else if(isset($_GET, $_GET['id'], $_GET['act']) && !empty($_GET['id']) && !empty($_GET['act']) && $_GET['act'] == 'delete'){
        $id = (int) $_GET['id'];
        if($id > 0){
            $news_info = getSingleRow('news', $id);
            if($news_info){
                $del = delete('news', 'id', $id);
                if($del){
                    if($news_info[0]['image']!="" && file_exists(UPLOAD_DIR.'news/'.$news_info[0]['image'])){
                        unlink(UPLOAD_DIR.'news/'.$news_info[0]['image']);
                    }

                    $_SESSION['success'] = "news deleted successfully.";
                    @header('location: news-list');
                    exit; 
                } else {
                    $_SESSION['error'] = "Sorry! There was problem while deleting news.";
                    @header('location: news-list');
                    exit; 
                }
            } else {
                $_SESSION['error'] = "news Not found";
                @header('location: news-list');
                exit; 
            }
            
        } else {
            $_SESSION['error'] = "Invalid Id.";
            @header('location: news-list');
            exit;    
        }
    }   else {
        $_SESSION['error'] = "Unauthorized access.";
        @header('location: news-list');
        exit;
    }