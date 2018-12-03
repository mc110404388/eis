 <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="dashboard.php">Employee Information System</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="dashboard.php">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>



		<?php
		//only visible to admin and editor
		if(($_SESSION['roleid'] == 1)){?>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-user"></i>
            <span class="nav-link-text">Employees</span>
          </a>
          <?php if ((basename($_SERVER['PHP_SELF']) == "add_employee.php") || (basename($_SERVER['PHP_SELF']) == "list_employee.php") || (basename($_SERVER['PHP_SELF']) == "del_employee.php") || (basename($_SERVER['PHP_SELF']) == "update_employee.php")) { ?>
          <ul class="sidenav-second-level collapse.show" id="collapseComponents">
            <li>
              <a href="add_employee.php">Add Employees</a>
            </li>
            <li>
              <a href="list_employee.php">List Employees</a>
            </li>
            <li>
              <a href="update_employee.php">Update Employees</a>
            </li>
            <li>
              <a href="del_employee.php">Delete Employees</a>
            </li>
          </ul>
          <?php } else { ?>
            <ul class="sidenav-second-level collapse" id="collapseComponents">
            <li>
              <a href="add_employee.php">Add Employees</a>
            </li>
            <li>
              <a href="list_employee.php">List Employees</a>
            </li>
            <li>
              <a href="update_employee.php">Update Employees</a>
            </li>
            <li>
              <a href="del_employee.php">Delete Employees</a>
            </li>
          </ul>
          <?php } ?>

        </li>


		<?php } ?>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Setting">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExampleSetting" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-gear"></i>
            <span class="nav-link-text">Setting</span>
          </a>
          <?php if ((basename($_SERVER['PHP_SELF']) == "profile.php")) { ?>
          <ul class="sidenav-second-level collapse.show" id="collapseExampleSetting">
            <li>
              <a href="profile.php">Profile</a>
            </li>
          </ul>
          <?php } else { ?>
          <ul class="sidenav-second-level collapse" id="collapseExampleSetting">
            <li>
              <a href="profile.php">Profile</a>
            </li>
          </ul>
          <?php } ?>
        </li>

      </ul>

      <ul class="navbar-nav ml-auto">

        <li class="nav-item">
          <a class="nav-link" href="index.php?logout=true">
            <i class="fa fa-fw fa-sign-out"></i>Logout
		  </a>
        </li>
      </ul>
    </div>
  </nav>