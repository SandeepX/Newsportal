<?php 
$_page_title = "Login Page";
include 'inc/header.php'; 
if(isset($_SESSION, $_SESSION['session_id']) && !empty($_SESSION['session_id']) && strlen($_SESSION['session_id']) == 100){
    $_SESSION['success'] = "You have been already logged in.";
    @header('location: dashboard');
    exit;
}
?>

        <div id="page-wrapper">

            <div class="container-fluid">
                <?php include 'inc/notifications.php'; ?>
                <!-- Page Heading -->
                <div class="row">
                	<form method="post" name="login" action="login">
						<div class="form-group">
							<label>Username</label>
							<input type="text" name="username" class="form-control" id="username" required />
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" name="password" class="form-control" id="password" required />
						</div>
						<div class="form-group">
							<input type="submit" name="submit" class="btn btn-primary" id="submit" required />
						</div>
                	</form>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->


<?php include 'inc/footer.php'; ?>