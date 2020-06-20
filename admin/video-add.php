<?php
$_page_title = "Dashboard";
require 'inc/header.php';

require 'inc/session.php';
$act = 'add';

if(isset($_GET['id']) && !empty($_GET['id'])){
    $act = 'edit';
    $video_id = (int)$_GET['id'];
    $video_info = getSingleRow('video',$video_id);
    if(!$video_info){
        $_SESSION['error'] = "Video not found.";
        @header('location: Video-list');
        exit;
    }
}

require 'inc/sidebar.php';
?>


        <div id="page-wrapper">
    <?php include 'inc/notifications.php';?>
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Video <?php echo ucfirst($act); ?>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                	<div class="col-lg-12">
                		<form action="video" method="post" enctype="multipart/form-data" class="form form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Video Title:</label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="name" type="text" required id="name" value="<?php echo (isset($video_info[0]['name'])) ? $video_info[0]['name'] : '';?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Video URL:</label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="url" type="url" required id="url" value="<?php echo (isset($video_info[0]['url'])) ? $video_info[0]['url'] : '';?>" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Video Status:</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="status" id="status" required >
                                        <option value="1" <?php echo (isset($video_info[0]['status']) && $video_info[0]['status'] == 1) ? 'selected' : '' ?>>Active</option>
                                        <option value="0" <?php echo (isset($video_info[0]['status']) && $video_info[0]['status'] == 0) ? 'selected' : '' ?>>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"></label>
                                <div class="col-sm-9">
                                    <input type="hidden" name="video_id" value="<?php echo (isset($video_info[0]['id'])) ? $video_info[0]['id'] : '' ;?>">
                                    <button class="btn btn-success" type="submit">
                                        <i class="fa fa-send"></i> Submit
                                    </button>
                                </div>
                            </div>
                            
                		</form>
                	</div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php require 'inc/footer.php';?>
