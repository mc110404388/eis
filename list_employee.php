<?php
session_start();

if (!isset($_SESSION['id'], $_SESSION['roleid']) && $_SESSION['roleid'] != 1) {
  header('location:index.php?lmsg=true');
  exit;
}

require_once('inc/config.php');
require_once('layouts/header.php');
require_once('layouts/left_sidebar.php');

$sql = "select * from employee";
$rs = mysqli_query($conn, $sql);
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
          <a href="list_employee.php">List Employee</a>
        </li>

      </ol>
      <h1>List of Employees</h1>
      <hr>
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
          </div>
        <!-- /.col-lg-12 -->
        </div>
        <div class="row">
          <div id="member" class="col-lg-12">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Employee ID</th>
                  <th>Username</th>
                  <th>Password</th>
                  <th>Designation</th>
                  <th>Contact</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  while ($mem = mysqli_fetch_assoc($rs)) {
                    echo '<tr>';
                    echo '<td>'.$mem['eid'].'</td>';
                    echo '<td>' . $mem['username'] . '</td>';
                    echo '<td>*******</td>';
                    echo '<td>' . $mem['designation'] . '</td>';
                    echo '<td>' . $mem['contact'] . '</td>';
                    echo '</tr>';
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div style="height: 1000px;"></div>
    </div>
    <!-- /.container-fluid-->

<?php require_once('layouts/footer.php'); ?>