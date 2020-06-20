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
                            News List
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <th>S.N</th>
                                <th>Title</th>
                                <th>Summary</th>
                                <th>Status</th>
                                <th>Thumbnail</th>
                                <th>Is Breaking</th>
                                <th>Is Featured</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php 
                                    $all_news = getAllRows('news');
                                    if($all_news){
                                        foreach($all_news as $key=>$value){
                                        ?>
                                        <tr>
                                            <td><?php echo ($key+1) ?></td>
                                            <td><?php echo $value['title']; ?></td>
                                            <td><?php echo substr($value['summary'], 0, 100).'...'; ?></td>
                                            <td><?php echo ($value['status'] == 1) ? 'Published' : 'Unpublished'; ?></td>
                                            <td>
                                                <?php
                                                    if(isset($value['image']) && !empty($value['image']) && file_exists(UPLOAD_DIR.'news/'.$value['image'])){
                                                ?>
                                                    <img src="<?php echo UPLOAD_URL.'news/'.$value['image'];?>" class="img img-reponsive img-thumbnail" style="max-width: 100px;">
                                                <?php
                                                    } else {
                                                        echo "No image uploaded.";
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo ($value['is_breaking'] == 1) ? 'Yes' : 'No'; ?>
                                            </td>
                                            <td>
                                                <?php echo ($value['is_featured'] == 1) ? 'Yes' : 'No'; ?>
                                            </td>
                                            <td>
                                                <a href="news-add?id=<?php echo $value['id'];?>" class="btn-link">Edit</a>
                                                 / 
                                                <a href="news?id=<?php echo $value['id']; ?>&amp;act=delete" onclick="return confirm('Are You sure you want to delete this news?');">Delete</a>
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
