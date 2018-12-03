<?php
session_start();

if (!isset($_SESSION['id'], $_SESSION['roleid']) && $_SESSION['roleid'] != 1) {
  header('location:index.php?lmsg=true');
  exit;
}

require_once('inc/config.php');
require_once('layouts/header.php');
require_once('layouts/left_sidebar.php');

if (isset($_POST['save'])) {
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
    $user_check_query = "select * from employee where username = '" . $username . "' OR eid = '" . $employeeid . "' UNION select * from admin where username = '" . $username . "'";
    $user_check_rs = mysqli_query($conn, $user_check_query);
    $user_check_data = mysqli_fetch_assoc($user_check_rs);
    if ($user_check_data) { // if user exists
      if ($user_check_data['username'] === $username) {
        $errorMsg = "Username already exists";
      }
      if ($user_check_data['eid'] === $employeeid) {
        $errorMsg = "Employee ID already exists";
      }
      mysqli_close($conn);
    }

    if ($errorMsg == null) {
      $sql = "INSERT INTO employee (eid, roleid, username, password, designation, contact) VALUES ('$employeeid', 2, '$username', '$md5Password', '$designation', '$contact')";

      if (mysqli_query($conn, $sql)) {
        $successMsg = "Employee information is added successfully";
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
          <a href="add_employee.php">Add Employee</a>
        </li>

      </ol>
      <h1>Add New Employee Information</h1>
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
            <input class="form-control" id="exampleInputemployeeid1" name="employeeid" type="employeeid" placeholder="Enter Employeeid" required>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input class="form-control" id="exampleInputUsername1" name="username" type="username" placeholder="Enter Username" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input class="form-control" id="exampleInputPassword1" name="password" type="password" placeholder="Password" required>
          </div>
          <div class="form-group">
            <label for="exampleInputDesignation1">Designation</label>
            <input class="form-control" id="exampleInputDesignation1" name="designation" type="designation" placeholder="Designation" required>
          </div>
          <div class="form-group">
            <label for="exampleInputContact1">Contact</label>
            <input class="form-control" id="exampleInputContact1" name="contact" type="contact" placeholder="Contact Number" required>
          </div>
          <button class="btn btn-primary btn-md" type="submit" name="save">Save</button>
          <button class="btn btn-warning btn-md" type="reset" name="reset">reset</button>
        </form>
          </div>
        <div>
      </div>
      <div style="height: 1000px;"></div>
    </div>
    <!-- /.container-fluid-->

<?php require_once('layouts/footer.php'); ?>