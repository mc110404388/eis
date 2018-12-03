<?php
session_start();

if (!isset($_SESSION['id'], $_SESSION['roleid']) && $_SESSION['roleid'] != 1) {
  header('location:index.php?lmsg=true');
  exit;
}

require_once('inc/config.php');
require_once('layouts/header.php');
require_once('layouts/left_sidebar.php');

if (isset($_POST['update'])) {
  if (!empty($_POST['employeeid']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['designation']) && !empty($_POST['contact'])) {
    $employeeid = trim($_POST['employeeid']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $designation = trim($_POST['designation']);
    $contact = trim($_POST['contact']);
    $errorMsg = null;
    $successMsg = null;
    $md5Password = md5($password);

    //checking if user already exists
    $user_check_query = "SELECT * FROM employee WHERE username='$username' LIMIT 1";
    $user_check_rs = mysqli_query($conn, $user_check_query);
    $user_check_data = mysqli_fetch_assoc($user_check_rs);
    if ($user_check_data) { // if user exists
      if ($user_check_data['username'] === $username) {
        $errorMsg = "Username already exists";
      }

      mysqli_close($conn);
    }

    if ($errorMsg == null) {
      $sql = "UPDATE employee SET username='$username', password='$md5Password', designation='$designation', contact='$contact' WHERE eid='$employeeid'";

      if (mysqli_query($conn, $sql)) {
        $successMsg = "Employee information is updated successfully";
      } else {
        $errorMsg = "There is some error, please try again later !";
      }
      mysqli_close($conn);
    }


  }
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
          <a href="#">Employee</a>
        </li>
        <li class="breadcrumb-item active">
          <a href="update_employee.php">Update Employee</a>
        </li>

      </ol>
      <h1>Update Employee Information</h1>
      <hr>
      <div class="container">
        <div class="row">
          <div class="col-md-5">
            <div class="form-group">
              <?php
              if (isset($errorMsg)) {
                echo '<div class="alert alert-danger">';
                echo $errorMsg;
                echo '</div>';
                unset($errorMsg);
              } elseif (isset($successMsg)) {
                echo '<div class="alert alert-success">';
                echo $successMsg;
                echo '</div>';
                unset($successMsg);
              }
              ?>
          </div>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
          <div class="form-group">
            <label for="exampleInputEmployeeid1">Employee ID</label>
            <input class="form-control" id="exampleInputemployeeid1" name="employeeid" type="employeeid" placeholder="Enter Employeeid to update employee information" required>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input class="form-control" id="exampleInputUsername1" name="username" type="username" placeholder="Enter New Username" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input class="form-control" id="exampleInputPassword1" name="password" type="password" placeholder="Enter New Password" required>
          </div>
          <div class="form-group">
            <label for="exampleInputDesignation1">Designation</label>
            <input class="form-control" id="exampleInputDesignation1" name="designation" type="designation" placeholder="Enter New Designation" required>
          </div>
          <div class="form-group">
            <label for="exampleInputContact1">Contact</label>
            <input class="form-control" id="exampleInputContact1" name="contact" type="contact" placeholder="Enter New Contact Number" required>
          </div>
          <button class="btn btn-primary btn-md" type="submit" name="update">Update</button>
          <button class="btn btn-warning btn-md" type="reset" name="reset">reset</button>
        </form>
          </div>
        <div>
      </div>
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