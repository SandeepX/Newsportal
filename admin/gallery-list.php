<?php 
$_page_title = "Dashboard";
require 'inc/header.php'; 
require 'inc/session.php';
require 'inc/sidebar.php';
?>
<div id="page-wrapper">
    <?php include 'inc/notifications.php'; ?>
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Gallery List
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <th>S.N</th>
                                <th>Name</th>
                                <th>Featured Image</th>
                                <th>Image Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php 
                                    $all_gallery = getAllRows('gallery');
                                    if($all_gallery){
                                        foreach($all_gallery as $key=>$value){
                                        ?>
                                        <tr>
                                            <td><?php echo ($key+1) ?></td>
                                            <td><?php echo $value['name']; ?></td>
                                            <td>
                                                <?php
                                                    if(isset($value['featured_image']) && !empty($value['featured_image']) && file_exists(UPLOAD_DIR.'gallery/'.$value['featured_image'])){
                                                ?>
                                                    <img src="<?php echo UPLOAD_URL.'gallery/'.$value['featured_image'];?>" class="img img-reponsive img-thumbnail" style="max-width: 100px;">
                                                <?php
                                                    } else {
                                                        echo "No image uploaded.";
                                                    }
                                                ?>
                                            </td>
                                            <td><?php echo $value['image_description']; ?></td>
                                            <td><?php echo ($value['status'] == 1) ? 'Active' : 'Not active'; ?></td>
                                            <td>
                                                <a href="gallery-add?id=<?php echo $value['id'];?>" class="btn-link">Edit</a>
                                                 / 
                                                <a href="gallery?id=<?php echo $value['id']; ?>&amp;act=delete" onclick="return confirm('Are You sure you want to delete this gallery?');">Delete</a>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='6'>No data found.</td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php require 'inc/footer.php'; ?>
