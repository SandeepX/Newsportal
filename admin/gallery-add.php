<?php 
$_page_title = "Dashboard";
require 'inc/header.php'; 
require 'inc/session.php';
$act = "add";
if(isset($_GET['id']) && !empty($_GET['id'])){
	$act = "edit";
	$id = (int)$_GET['id'];
	if($id <= 0){
		$_SESSION['error'] = "Invalid gallery id.";
		@header('loctation: gallery-list');
		exit;
	}

	$gallery_info = getSingleRow('gallery', $id);
	if(!$gallery_info){
		$_SESSION['error'] = "gallery not found.";
		@header('location: gallery-list');
		exit;
	}
}
require 'inc/sidebar.php';
?>
    <div class="container" style="color: #fff;">
        <div class="row">
            <form action="gallery" class="form form-horizontal" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="" class="col-lg-1">Gallery Name:</label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control" name="name" id="name" required value="<?php echo (isset($gallery_info[0]['name']) && !empty($gallery_info[0]['name']))?$gallery_info[0]['name']:'' ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-lg-1">Featured Image:</label>
                    <div class="col-lg-5">
                        <input type="file" class="" name="featured_image" id="featured_image" accept="image/*" onchange="previewFile()">
                        <img src="" height="200" alt="">
                        <?php 
                            if (isset($gallery_info[0]['featured_image']) && !empty($gallery_info[0]['featured_image']) && file_exists(UPLOAD_DIR.'gallery/'.$gallery_info[0]['featured_image']) ) {
                                echo "<img src='".UPLOAD_URL."/gallery/".$gallery_info[0]['featured_image']."' height = '200px' id='Edit_img'>";
                                echo "<br>";
                                echo '<input type="checkbox" name="delete_image" id="Edit_img" value="'.$gallery_info[0]['featured_image'].'">';
                            }
                         ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-lg-1">Image Description:</label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control" name="image_description" id="image_description" required value="<?php echo (isset($gallery_info[0]['image_description']) && !empty($gallery_info[0]['image_description']))?$gallery_info[0]['image_description']:'' ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-lg-1">Related Image:</label>
                    <div class="col-lg-5">
                        <input type="file" class="" name="image[]" id="image" accept="image/*" multiple value="<?php echo (isset($gallery_info[0]['image']) && !empty($gallery_info[0]['image']))?$gallery_info[0]['image']:'' ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-lg-1">Status:</label>
                    <div class="col-lg-5" style="color: #000;">
                        <select name="status" id="status">
                            <option value="" disabled selected>--Select Option--</option>
                            <option value="1" <?php echo (isset($gallery_info[0]['status']) && !empty($gallery_info[0]['status']) && $gallery_info[0]['status']==1)?'selected':'' ?>>Active</option>
                            <option value="0" <?php echo (isset($gallery_info[0]['status']) && !empty($gallery_info[0]['status']) && $gallery_info[0]['status']==0)?'selected':'' ?>>Not Active</option>
                        </select>
                    </div>
                </div>
                <div class="form-group hidden">
                    <input type="number" name="<?php echo (isset($gallery_info[0]['id']) && !empty($gallery_info[0]['id']))?'gallery_id':''; ?>" value="<?php echo (isset($gallery_info[0]['id']) && !empty($gallery_info[0]['id']))?$gallery_info[0]['id']:''; ?>">
                </div>
                <div class="form-group">
                    <label for="" class="col-lg-1"></label>
                    <div class="col-lg-5">
                        <button class="btn btn-success" type="submit"><i class="fa fa-send"></i> Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php require 'inc/footer.php'; ?>
<script type="text/javascript">
    function previewFile() {
        var preview = document.querySelector('img');
        var file    = document.querySelector('input[type=file]').files[0];
        var reader  = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
        }
        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "";
        }
            hidden();
    }
    function hidden(){
        document.getElementById('Edit_img').style.display = 'none';
        document.getElementById('delete_img').checked='true';
    }
</script>
