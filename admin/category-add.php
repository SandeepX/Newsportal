<?php
$_page_title = "Dashboard";
require 'inc/header.php';

require 'inc/session.php';
$act = 'add';

if(isset($_GET['id']) && !empty($_GET['id'])){
    $act = 'edit';
    $cat_id = (int)$_GET['id'];
    $cat_info = getSingleRow('categories',$cat_id);
    if(!$cat_info){
        $_SESSION['error'] = "Category not found.";
        @header('location: category-list');
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
                            Category <?php echo ucfirst($act); ?>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                	<div class="col-lg-12">
                		<form action="category" method="post" enctype="multipart/form-data" class="form form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Category Title:</label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="title" type="text" required id="title" value="<?php echo (isset($cat_info[0]['name'])) ? $cat_info[0]['name'] : '';?>" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Category Summary:</label>
                                <div class="col-sm-9">
                                    <textarea name="summary" class="form-control" id="summary" rows="6" style="resize: none;"><?php echo (isset($cat_info[0]['summary'])) ? $cat_info[0]['summary'] : '';?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Category Status:</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="status" id="status" required >
                                        <option value="1" <?php echo (isset($cat_info[0]['status']) && $cat_info[0]['status'] == 1) ? 'selected' : '' ?>>Active</option>
                                        <option value="0" <?php echo (isset($cat_info[0]['status']) && $cat_info[0]['status'] == 0) ? 'selected' : '' ?>>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Iamge:</label>
                                <div class="col-sm-4">
                                    <input type="file" name="image" accept="image/*" id="image">
                                </div>
                                <div class="col-sm-4">
                                    <?php 
                                        if(isset($cat_info[0]['image']) && !empty($cat_info[0]['image']) && file_exists(UPLOAD_DIR.'category/'.$cat_info[0]['image'])){
                                            echo "<img src='".UPLOAD_URL."category/".$cat_info[0]['image']."' class='img img-responsive img-thumbnail'> ";
                                            echo "<br>";
                                            echo "<input type='checkbox' name='delete_image' value='".$cat_info[0]['image']."' > Delete Image";
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"></label>
                                <div class="col-sm-9">
                                    <input type="hidden" name="cat_id" value="<?php echo (isset($cat_info[0]['id'])) ? $cat_info[0]['id'] : '' ;?>">
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
