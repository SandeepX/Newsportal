<?php 
$_page_title = "Dashboard";
require 'inc/header.php'; 
require 'inc/session.php';
$act = "add";
if(isset($_GET['id']) && !empty($_GET['id'])){
	$act = "edit";
	$id = (int)$_GET['id'];
	if($id <= 0){
		$_SESSION['error'] = "Invalid user id.";
		@header('loctation: user-list');
		exit;
	}

	$user_info = getSingleRow('users', $id);
	if(!$user_info){
		$_SESSION['error'] = "user not found.";
		@header('location: user-list');
		exit;
	}
}
require 'inc/sidebar.php';
?>
    <div class="container" style="color: #fff;">
        <div class="row">
            <form action="user" class="form form-horizontal" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="" class="col-lg-1">Username:</label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control" name="full_name" id="full_name" required value="<?php echo (isset($user_info[0]['full_name']) && !empty($user_info[0]['full_name']))?$user_info[0]['full_name']:'' ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-lg-1">Email:</label>
                    <div class="col-lg-5">
                        <input type="email" class="form-control" name="email_address" id="email_address" required value="<?php echo (isset($user_info[0]['email_address']) && !empty($user_info[0]['email_address']))?$user_info[0]['email_address']:'' ?>">
                    </div>
                </div>
                <div class="form-group <?php echo (isset($user_info[0]['password']) && !empty($user_info[0]['password']))?'':'hidden' ?>">
                    <label for="" class="col-lg-1">Password:</label>
                    <div class="col-lg-5">
                        <input type="password" class="form-control" name="password" id="password" value="<?php echo (isset($user_info[0]['password']) && !empty($user_info[0]['password']))?'':'123' ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-lg-1">Status:</label>
                    <div class="col-lg-5" style="color: #000;">
                        <select name="status" id="status">
                            <option value="" disabled selected>--Select Option--</option>
                            <option value="1" <?php echo (isset($user_info[0]['status']) && !empty($user_info[0]['status']) && $user_info[0]['status']==1)?'selected':'' ?>>Active</option>
                            <option value="0" <?php echo (isset($user_info[0]['status']) && !empty($user_info[0]['status']) && $user_info[0]['status']==0)?'selected':'' ?>>Not Active</option>
                        </select>
                    </div>
                </div>
                <div class="form-group <?php echo (isset($user_info[0]['roles']) && !empty($user_info[0]['roles']))?'':'hidden' ?>">
                    <label for="" class="col-lg-1">Role:</label>
                    <div class="col-lg-5" style="color: #000;">
                        <select name="roles" id="roles">
                            <option value="1" <?php echo (isset($user_info[0]['roles']) && !empty($user_info[0]['roles']) && $user_info[0]['roles']==1)?'selected':'' ?>>Admin</option>
                            <option value="2" <?php echo (isset($user_info[0]['roles']) && !empty($user_info[0]['roles']) && $user_info[0]['roles']==2)?'selected':'' ?>>Reporter</option>
                        </select>
                    </div>
                </div>
                <div class="form-group hidden">
                    <input type="number" name="user_id" value="<?php echo (isset($user_info[0]['id']) && !empty($user_info[0]['id']))?$user_info[0]['id']:''; ?>">
                </div>
                <div class="form-group">
                    <label for="" class="col-lg-1">Photo:</label>
                    <div class="col-lg-5">
                        <input type="file" class="" name="image" id="image" accept="image/*" onchange="previewFile()">

                        <img src="" height="200" alt="">
                        <?php 
                            if (isset($user_info[0]['image']) && !empty($user_info[0]['image']) && file_exists(UPLOAD_DIR.'user/'.$user_info[0]['image']) ) {
                                echo "<img src='".UPLOAD_URL."/user/".$user_info[0]['image']."' height = '200px' id='Edit_img'>";
                                echo "<br>";
                                echo '<input type="checkbox" name="delete_image" id="delete_img" value="'.$user_info[0]['image'].'">';
                            }
                         ?>
                    </div>
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
<script type="text/javascript" src="<?php echo ASSETS_URL.'tinymce/tinymce.min.js';?>"></script>

<script type="text/javascript">
    tinymce.init({
        selector: '#description'

    });
</script>
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
