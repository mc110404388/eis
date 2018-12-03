<?php
	session_start();

	if(!isset($_SESSION['id'],$_SESSION['roleid']))
	{
		header('location:index.php?lmsg=true');
		exit;
	}

  require_once('inc/config.php');
	require_once('layouts/header.php');
	require_once('layouts/left_sidebar.php');

if ($_SESSION['roleid'] == 1) {
  $sql = "select * from admin where username = '{$_SESSION['username']}'";
  $rs = mysqli_query($conn, $sql);
} elseif ($_SESSION['roleid'] == 2) {
  $sql = "select * from employee where username = '{$_SESSION['username']}'";
  $rs = mysqli_query($conn, $sql);
} else {
  echo "";
}

?>

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item active">
          <a href="#">Dashboard</a>
        </li>

      </ol>
      <h1>Welcome to Dashboard</h1>
      <hr>
      <p>You are login as <strong><?php echo getUserAccessRoleByID($_SESSION['roleid']); ?></strong></p>

      <?php
        if ($_SESSION['roleid'] == 2) {
        require_once('layouts/profile_info.php');
        }
      ?>
      <div style="height: 1000px;"></div>
    </div>
    <!-- /.container-fluid-->

<?php require_once('layouts/footer.php'); ?>