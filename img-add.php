<?php require 'inc/top-inc.php'; ?>
<?php require 'inc/header.php'; ?>
<?php 
    require 'inc/login-check.php';

    $act = 'add';
    if(isset($_GET['id'], $_GET['act'])){
        $act = "edit";
        if( !empty($_GET['id']) && !empty($_GET['act']) && $_GET['act'] == "edit"){
            $img_id = (int)$_GET['id'];

            $img_info = getRowByRowId('img', $img_id);
            if(!$img_info){
                $_SESSION['error']  =   'Invalid news id.';
                @header('location: img-list.php');
                exit;
            }
        } else {
            $_SESSION['error']  =   'Invalid access.';
            @header('location: img-list.php');
            exit;
        }

    }
?>
    <div id="wrapper">

        <?php require 'inc/sidebar.php' ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <?php require 'inc/notification.php' ?>
                    <div class="col-lg-12">
                        <h1 class="page-header">IMAGE <?php echo ucfirst($act); ?></h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <form action="news.php" method="post" enctype="multipart/form-data" class="form form-horizontal">
                            <div class="form-group row">
                                <label for="" class="col-sm-3">IMAGE NAME: </label>
                                <div class="col-sm-9">
                                    <input type="text" name="title" required placeholder="Enter News Title" class="form-control" id="title" value="<?php echo @$img_info['title'];?>">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="" class="col-sm-3">Status: </label>
                                <div class="col-sm-8">
                                    <select name="status" required class="form-control">
                                        <option value="1" <?php echo (isset($img_info['status']) && $img_info['status'] ==1) ? 'selected' : '';?>>Active</option>
                                        <option value="0" <?php echo (isset($img_info['status']) && $img_info['status'] ==0) ? 'selected' : '';?>>Inactive</option>
                                    </select>
                                </div>
                            </div>

                           




                                 <div class="form-group row">
                                <label for="" class="col-sm-3">Image: </label>
                                <div class="col-sm-4">
                                    <input type="file" name="image" accept="image/*">
                                </div>
                                <div class="col-sm-5">
                                    <?php 
                                        if(isset($img_info['image']) && !empty($img_info['image']) && file_exists(UPLOAD_DIR.'news/'.$img_info['image'])){
                                        ?>
                                        <img src="<?php echo UPLOAD_URL.'news/'.$img_info['image'];?>" alt="" class="img img-thumbnail img-responsive">
                                        <br>
                                        <input type="checkbox" name="del_image" value="<?php echo $img_info['image'];?>"> Delete
                                        <?php
                                        }
                                    ?>
                                </div>
                            </div>



<?php require 'inc/footer.php'; ?>