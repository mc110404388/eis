<?php
	define("HOST","localhost");
	define("DB_USER","root");
	define("DB_PASS","");
	define("DB_NAME","testdb");


	$conn = mysqli_connect(HOST,DB_USER,DB_PASS,DB_NAME);

	if(!$conn)
	{
		die(mysqli_error());
	}



	function getUserAccessRoleByID($id)
	{
		global $conn;

		$query = "select rname from user_roles where  rid = ".$id;

		$rs = mysqli_query($conn,$query);
		$row = mysqli_fetch_assoc($rs);

		return $row['rname'];
	}
?>