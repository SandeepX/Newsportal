<?php 
    require 'inc/config.php';
    require 'inc/functions.php';
    require 'inc/session.php';
    if(isset($_POST) && !empty($_POST)){
        $data = array();
        $data['name'] = sanitize($_POST['name']);
        $data['image_description'] = sanitize($_POST['image_description']);
        $data['status'] = (int)$_POST['status'];
        $gallery_id = (isset($_POST['gallery_id']) && !empty($_POST['gallery_id'])) ? (int)$_POST['gallery_id'] : null;

        // File Upload     
        if(isset($_FILES['featured_image']) && $_FILES['featured_image']['error'] == 0){
            $ext = pathinfo($_FILES['featured_image']['name'], PATHINFO_EXTENSION);
            if(in_array($ext, ALLOWED_EXTENSION)){
                if($_FILES['featured_image']['size'] <= (5*1024*1024)){
                    $destination = UPLOAD_DIR.'gallery/';

                    if(!is_dir($destination)){
                        mkdir($destination, '0777', true);
                    }

                    $file_name = "gallery-".date('Ymdhis').rand(0,999).".".$ext;
                    $succes = move_uploaded_file($_FILES['featured_image']['tmp_name'], $destination.$file_name);
                    if($succes){
                        $data['featured_image'] = $file_name;
                        $src=$destination.'/'.$file_name;
                        $dest=$destination.'/Thumb_'.$file_name;
                        $desired_width=146.23;
                        $desired_height = 109.67;
                        make_thumb($src, $dest, $desired_width,$desired_height);
                        $src = $destination.'/'.$file_name;
                        $dest = $destination.'/Croped'.$file_name;
                        $desired_height = 850;
                        $desired_width = 1903;
                        make_thumb($src,$dest,$desired_width,$desired_height);
                    }
                }
            }
        }

        if(isset($_POST['delete_image']) && !empty($_POST['delete_image'])){
            if(file_exists(UPLOAD_DIR.'gallery/'.$_POST['delete_image'])){
                unlink(UPLOAD_DIR.'gallery/'.$_POST['delete_image']);
                /*$data['image'] = null;*/
            }
        }
        if($gallery_id && $gallery_id >0) {
            $act = "updat";
            $gallery_id = updateData($data,'gallery', $gallery_id);
            
        } else {
            $act = "add";
            $gallery_id = addCategory($data,'gallery');    
        }


        //multiple file uploads
		if(isset($_FILES['image'])){
		    $count = count($_FILES['image']['name']);   // no of files uploaded
		    $files = $_FILES['image'];
		    echo $count;
		    $success = array();
		    $success['foreign_key'] = $gallery_id;
		    $success['status'] = 1;
		    $error = array();
		    $dir = UPLOAD_DIR.'gallery/';
		    if(!is_dir($dir)){
		        mkdir($dir, '0777', true);
		    }

		    for($i=0; $i<$count; $i++){
		        $ext = pathinfo($files['name'][$i], PATHINFO_EXTENSION);
		        $file_name = "Image-".time().rand().".".$ext;
		        if($files['error'][$i] == 0){
		            if(in_array($ext, ALLOWED_EXTENSION)){
		                if($files['size'][$i] <= (5*1024*1024)){
		                    $suc = move_uploaded_file($files['tmp_name'][$i], $dir."/".$file_name);
		                    if($suc){
		                        $success['image_title'] = $file_name;
		                        $ok = addCategory($success,'image');
		                        if (!$ok) {
		                        	$_SESSION['error'] = "Files not uploaded to gallery.";
		                        }
                                $src=$dir.'/'.$file_name;
                                $dest=$dir.'/Thumb_'.$file_name;
                                $desired_width=146.23;
                                $desired_height = 109.67;
                                make_thumb($src, $dest, $desired_width,$desired_height);
                                $src = $dir.'/'.$file_name;
                                $dest = $dir.'/Croped'.$file_name;
                                $desired_height = 850;
                                $desired_width = 1903;
                                make_thumb($src,$dest,$desired_width,$desired_height);
		                    }
		                }
		            }
		        }
		    }
		}
		//multiple file uploads section finished...



        if($gallery_id){
            $_SESSION['success'] = "gallery ".$act."ed successfully.";
        } else {
            $_SESSION['error'] = 'Sorry! There was problem while '.$act.'ing gallery.';

        }
        @header('location: gallery-list');
        exit;

    } else if(isset($_GET, $_GET['id'], $_GET['act']) && !empty($_GET['id']) && !empty($_GET['act']) && $_GET['act'] == 'delete'){
        $id = (int) $_GET['id'];
        if($id > 0){
            $gallery_info = getSingleRow('gallery', $id);
            if($gallery_info){
                $del = delete('gallery', 'id', $id);
                if($del){
                    if($gallery_info[0]['featured_image']!="" && file_exists(UPLOAD_DIR.'gallery/'.$gallery_info[0]['featured_image'])){
                        unlink(UPLOAD_DIR.'gallery/'.$gallery_info[0]['featured_image']);
                    }

                    $_SESSION['success'] = "gallery deleted successfully.";
                    @header('location: gallery-list');
                    exit; 
                } else {
                    $_SESSION['error'] = "Sorry! There was problem while deleting Gallery.";
                    @header('location: gallery-list');
                    exit; 
                }
            } else {
                $_SESSION['error'] = "Gallery Not found";
                @header('location: gallery-list');
                exit; 
            }
            
        } else {
            $_SESSION['error'] = "Invalid Id.";
            @header('location: gallery-list');
            exit;    
        }
    }   else {
        $_SESSION['error'] = "Unauthorized access.";
        @header('location: gallery-list');
        exit;
    }