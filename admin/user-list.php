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
                            User List
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
                                <th>Email</th>
                                <th>Status</th>
                                <th>Role</th>
                                <th>Image</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php 
                                    $all_user = getAllRows('users');
                                    if($all_user){
                                        foreach($all_user as $key=>$value){
                                        ?>
                                        <tr>
                                            <td><?php echo ($key+1) ?></td>
                                            <td><?php echo $value['full_name']; ?></td>
                                            <td><?php echo $value['email_address']; ?></td>
                                            <td><?php echo ($value['status'] == 1) ? 'Active' : 'Not active'; ?></td>
                                            <td>
                                                <?php echo ($value['roles'] == 1) ? 'Admin' : 'Reporter'; ?>
                                            </td>
                                            <td>
                                                <?php
                                                    if(isset($value['image']) && !empty($value['image']) && file_exists(UPLOAD_DIR.'user/'.$value['image'])){
                                                ?>
                                                    <img src="<?php echo UPLOAD_URL.'user/'.$value['image'];?>" class="img img-reponsive img-thumbnail" style="max-width: 100px;">
                                                <?php
                                                    } else {
                                                        echo "No image uploaded.";
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <a href="user-add?id=<?php echo $value['id'];?>" class="btn-link">Edit</a>
                                                 / 
                                                <a href="user?id=<?php echo $value['id']; ?>&amp;act=delete" onclick="return confirm('Are You sure you want to delete this user?');">Delete</a>
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
