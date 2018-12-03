<?php
session_start();

if (!isset($_SESSION['id'], $_SESSION['roleid']) && $_SESSION['roleid'] != 1) {
  header('location:index.php?lmsg=true');
  exit;
}

require_once('inc/config.php');
require_once('layouts/header.php');
require_once('layouts/left_sidebar.php');

if (isset($_POST['delete'])) {
  if (!empty($_POST['employeeid'])) {
    $employeeid = trim($_POST['employeeid']);
    $errorMsg = null;
    $successMsg = null;

    //checking if user already exists
    $user_check_query = "SELECT * FROM employee WHERE eid='$employeeid' LIMIT 1";
    $user_check_rs = mysqli_query($conn, $user_check_query);
    $user_check_data = mysqli_fetch_assoc($user_check_rs);
    if ($user_check_data) { // if user exists
      $sql = "DELETE FROM employee WHERE eid='$employeeid'";
      if (mysqli_query($conn, $sql)) {
        $successMsg = "Employee information is deleted successfully";
      } else {
        $errorMsg = "There is some error, please try again later !";
      }
    } else {
      $errorMsg = "Employee id does not exists";
    }
    mysqli_close($conn);
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
          <a href="del_employee.php">Delete Employee</a>
        </li>

      </ol>
      <h1>Delete an employee record</h1>
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
          <button class="btn btn-primary btn-md" type="submit" name="delete">Delete</button>
          <button class="btn btn-warning btn-md" type="reset" name="reset">reset</button>
        </form>
          </div>
        <div>
      </div>
      <div style="height: 1000px;"></div>
    </div>
    <!-- /.container-fluid-->

<?php require_once('layouts/footer.php'); ?>