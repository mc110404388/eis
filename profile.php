<?php
session_start();

// if (!isset($_SESSION['id'], $_SESSION['roleid']) && $_SESSION['roleid'] != 1) {
//   header('location:index.php?lmsg=true');
//   exit;
// }

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
        <li class="breadcrumb-item">
          <a href="dashboard.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
          <a href="#">Setting</a>
        </li>
        <li class="breadcrumb-item active">
          <a href="profile.php">Profile</a>
        </li>

      </ol>
      <h1>Your Profile</h1>
      <hr>

      <?php require_once('layouts/profile_info.php'); ?>

      <!-- <p>You are login as <strong></strong></p> -->

		<!-- <ul>
			<li><strong>John Doe</strong> has <strong>Administrator</strong> rights so all the left bar items are visible to him</li>
			<li><strong>Ahsan</strong> has <strong>Editor</strong> rights and he doesn't have access to Settings</li>
			<li><strong>Sarah</strong> has <strong>Author</strong> rights and she can't have access to Appearance, Components and Settings</li>
			<li><strong>Salman</strong> has <strong>Contributor</strong> rights and he has only access Posts</li>
		</ul> -->

      <div style="height: 1000px;"></div>
    </div>
    <!-- /.container-fluid-->

<?php require_once('layouts/footer.php'); ?>