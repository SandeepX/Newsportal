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
                            Category List
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
                                <th>Summary</th>
                                <th>Status</th>
                                <th>Thumbnail</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php 
                                    $all_categories = getAllRows('categories');
                                    if($all_categories){
                                        foreach($all_categories as $key=>$value){
                                        ?>
                                        <tr>
                                            <td><?php echo ($key+1) ?></td>
                                            <td><?php echo $value['name']; ?></td>
                                            <td><?php echo $value['summary']; ?></td>
                                            <td><?php echo ($value['status'] == 1) ? 'Active' : 'Inactive'; ?></td>
                                            <td>
                                                <?php
                                                    if(isset($value['image']) && !empty($value['image']) && file_exists(UPLOAD_DIR.'category/'.$value['image'])){
                                                ?>
                                                    <img src="<?php echo UPLOAD_URL.'category/'.$value['image'];?>" class="img img-reponsive img-thumbnail" style="max-width: 100px;">
                                                <?php
                                                    } else {
                                                        echo "No image uploaded.";
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <a href="category-add?id=<?php echo $value['id'];?>" class="btn-link">Edit</a>
                                                 / 
                                                <a href="category?id=<?php echo $value['id']; ?>&amp;act=delete" onclick="return confirm('Are You sure you want to delete this category?');">Delete</a>
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
