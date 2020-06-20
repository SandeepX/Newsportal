<?php 
$_page_title = "Dashboard";
require 'inc/header.php'; 

if(!isset($_SESSION, $_SESSION['session_id']) || empty($_SESSION['session_id']) || strlen($_SESSION['session_id']) != 100){
    $_SESSION['error'] = "Please login first.";
    @header('location: ./');
    exit;
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
                            Blank Page
                            <small>Subheading</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php require 'inc/footer.php'; ?>
