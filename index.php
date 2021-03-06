<?php
session_start();

require_once('inc/config.php');

if(isset($_POST['login']))
{
	if(!empty($_POST['username']) && !empty($_POST['password']))
	{
		$username 	= trim($_POST['username']);
		$password 	= trim($_POST['password']);

		$md5Password = md5($password);

    $sql = "select * from admin where username = '" . $username . "' and password = '" . $md5Password . "' UNION select * from employee where username = '" . $username . "' and password = '" . $md5Password . "'";
		$rs = mysqli_query($conn,$sql);
		$getNumRows = mysqli_num_rows($rs);

		if($getNumRows == 1)
		{
			$getUserRow = mysqli_fetch_assoc($rs);
			unset($getUserRow['password']);

			$_SESSION = $getUserRow;

      header('location:dashboard.php');
			exit;
		}
    else
    {
      $errorMsg = "Wrong Username or password";
		}
  }
  mysqli_close($conn);
}

if(isset($_GET['logout']) && $_GET['logout'] == true)
{
	session_destroy();
	header("location:index.php");
	exit;
}


if(isset($_GET['lmsg']) && $_GET['lmsg'] == true)
{
	$errorMsg = "Login required to access dashboard";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Employee Information System</title>
  <!-- Bootstrap core CSS-->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="assets/css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-light">
  <div class="container">
    <h2 class="text-center"> Employee Information System </h2>
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Plase provide your username and password</div>
      <div class="card-body">
		<?php
			if(isset($errorMsg))
			{
				echo '<div class="alert alert-danger">';
				echo $errorMsg;
				echo '</div>';
				unset($errorMsg);
			}
		?>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input class="form-control" id="exampleInputUsername1" name="username" type="username" placeholder="Enter Username" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input class="form-control" id="exampleInputPassword1" name="password" type="password" placeholder="Password" required>
          </div>
          <button class="btn btn-primary btn-block" type="submit" name="login">Login</button>
        </form>

      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
