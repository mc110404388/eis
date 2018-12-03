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
                  <?php
                  if ($_SESSION['roleid'] == 1) {
                    echo '<th>ID</th>';
                  }
                  if ($_SESSION['roleid'] == 2) {
                    echo '<th>Employee ID</th>';
                  }
                  ?>

                  <th>Username</th>
                  <th>Password</th>
                  <?php
                  if ($_SESSION['roleid'] == 1) {
                    echo '<th>Email</th>';
                  }
                  if ($_SESSION['roleid'] == 2) {
                    echo '<th>Designation</th>';
                  }
                  ?>
                  <th>Contact</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $mem = mysqli_fetch_assoc($rs);
                echo '<tr>';
                if ($_SESSION['roleid'] == 1) {
                  echo '<td>' . $mem['id'] . '</td>';
                }
                if ($_SESSION['roleid'] == 2) {
                  echo '<td>' . $mem['eid'] . '</td>';
                }
                echo '<td>' . $mem['username'] . '</td>';
                echo '<td>*******</td>';
                if ($_SESSION['roleid'] == 1) {
                  echo '<td>' . $mem['emailid'] . '</td>';
                }
                if ($_SESSION['roleid'] == 2) {
                  echo '<td>' . $mem['designation'] . '</td>';
                }
                echo '<td>' . $mem['contact'] . '</td>';
                echo '</tr>';
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>