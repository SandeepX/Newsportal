<?php 
$_page_title = "Dashboard";
require 'inc/header.php'; 
require 'inc/session.php';
$act = "add";
if(isset($_GET['id']) && !empty($_GET['id'])){
	$act = "edit";
	$id = (int)$_GET['id'];
	if($id <= 0){
		$_SESSION['error'] = "Invalid news id.";
		@header('loctation: news-list');
		exit;
	}

	$news_info = getSingleRow('news', $id);
	if(!$news_info){
		$_SESSION['error'] = "News not found.";
		@header('location: news-list');
		exit;
	}
}
require 'inc/sidebar.php';
?>


        <div id="page-wrapper">
    <?php include 'inc/notifications.php'; ?>
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            News <?php echo ucfirst($act); ?>
                        </h1>
                    </div>
                </div>
                <div class="row">
                	<div class="col-lg-12">
                		<form action="news" method="post" enctype="multipart/form-data" class="form form-horizontal">
                			<div class="form-group">
                				<label for="" class="col-sm-3 control-label">News Title: </label>
                				<div class="col-sm-9">
                					<input type="text" required value="<?php echo (isset($news_info[0]['title'])) ? $news_info[0]['title'] : '' ?>" placeholder="Enter Your news title" id="news_title" name="title" class="form-control">
                				</div>
                			</div>

                			<div class="form-group">
                				<label for="" class="col-sm-3 control-label">Summary: </label>
                				<div class="col-sm-9">
                					<textarea name="summary" id="summary" rows="5" style="resize: none;" class="form-control" placeholder="Enter news Summary."><?php echo (isset($news_info[0]['summary'])) ? $news_info[0]['summary'] : ''; ?></textarea>
                				</div>
                			</div>

                			<div class="form-group">
                				<label for="" class="col-sm-3 control-label">Description: </label>
                				<div class="col-sm-9">
                					<textarea name="description" id="description" class="form-control" placeholder="Enter news Story."><?php echo (isset($news_info[0]['description'])) ? html_entity_decode($news_info[0]['description']) : ''; ?></textarea>
                				</div>
                			</div>

                			<div class="form-group">
                				<label for="" class="col-sm-3 control-label">Catgory: </label>
                				<div class="col-sm-9">
                					<select name="cat_id" required id="cat_id" class="form-control">
                						<option value="" selected disabled>--Select Any One--</option>
                						<?php 
                							$all_cats = getAllRows('categories');
                							if($all_cats){
                								foreach($all_cats as $cat_info){
                								?>
                								<option <?php echo (isset($news_info[0]['cat_id']) && $cat_info['id'] == $news_info[0]['cat_id']) ? 'selected' : ''; ?> value="<?php echo ($cat_info['id']) ?>"><?php echo $cat_info['name']; ?></option>
                								<?php
                								}
                							}
                						?>
                					</select>
                				</div>
                			</div>

                			<div class="form-group">
                				<label for="" class="col-sm-3 control-label">Location: </label>
                				<div class="col-sm-9">
                					<input type="text" name="location" placeholder="Kathmandu" class="form-control" value="<?php echo (isset($news_info[0]['location']) && !empty($news_info[0]['location']) )? $news_info[0]['location']:'' ?> ">
                				</div>
                			</div>

                			<div class="form-group">
                				<label for="" class="col-sm-3 control-label">Is Breaking: </label>
                				<div class="col-sm-9">
                					<input type="checkbox" value="1" name="is_breaking" id="is_breaking" <?php echo (isset($news_info[0]['is_breaking']) && !empty($news_info[0]['is_breaking']) )? 'checked':'' ?>> Yes
                				</div>
                			</div>

                			<div class="form-group">
                				<label for="" class="col-sm-3 control-label">Is Featured: </label>
                				<div class="col-sm-9">
                					<input type="checkbox" value="1" name="is_featured" id="is_featured" <?php echo (isset($news_info[0]['is_featured']) && !empty($news_info[0]['is_featured']) )? 'checked':'' ?> > Yes
                				</div>
                			</div>

                			<div class="form-group">
                				<label for="" class="col-sm-3 control-label">Status: </label>
                				<div class="col-sm-9">
                					<select name="status" id="status" class="form-control">
                						<option value="1" <?php echo (isset($news_info[0]['status']) && !empty($news_info[0]['status']))? 'selected':''; ?> >Published</option>
                						<option value="0" <?php echo (isset($news_info[0]['status']) && !empty($news_info[0]['status']))? '':'selected'; ?> >Unpublished</option>
                					</select>
                				</div>
                			</div>

                			<div class="form-group">
                				<label for="" class="col-sm-3 control-label">Key Text: </label>
                				<div class="col-sm-9">
                					<textarea name="focused_text" id="key_text" rows="5" style="resize:  none;" class="form-control"> <?php echo (isset($news_info[0]['focused_text']) && !empty($news_info[0]['focused_text']))?$news_info[0]['focused_text']:''; ?></textarea>
                				</div>
                			</div>

                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">Image: </label>
                                <div class="col-sm-4">
                                    <input type="file" id="image" name="image" accept="image/*">
                                </div>
                                <div class="col-sm-4">
                                    <?php 
                                        if (isset($news_info[0]['image']) && !empty($news_info[0]['image'])) {
                                            echo "<img src='".UPLOAD_URL."news/".$news_info[0]['image']."' class='img img-responsive img-thumbnail'> ";
                                            echo "<br>";
                                            echo "<input type='checkbox' name='delete_image' value='".$news_info[0]['image']."' > Delete Image";
                                        }
                                    ?>                                    
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label"></label>
                                <div class="col-sm-9">
                                    <input type="hidden" name="news_id" value="<?php echo (isset($news_info[0]['id'])) ? $news_info[0]['id'] : '' ;?>">
                                    <button class="btn btn-success" type="submit">
                                        <i class="fa fa-send"></i> Submit
                                    </button>
                                </div>
                            </div>

                		</form>
                	</div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php require 'inc/footer.php'; ?>
<script type="text/javascript" src="<?php echo ASSETS_URL.'tinymce/tinymce.min.js';?>"></script>

<script type="text/javascript">
    tinymce.init({
        selector: '#description'

    });
</script>