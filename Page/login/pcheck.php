<?php
	session_start();
	$host = "localhost";		// variables to store database connection parameters.
	$username = "root";
	$pass = "";
	$database = "project";
	$port = 3306;

	$var = $_SESSION['var'];
	$pwd = $_POST['ppass'];
	$npas = $_POST['password'];
    $con = new mysqli($host, $username, $pass, $database, $port);
	$ans = $con->query("SELECT pass FROM member WHERE instituteID = $var");
	$row = mysqli_fetch_row($ans);
	if(password_verify($pwd, $row[0]))
	{
		$finalpas = password_hash($npas, PASSWORD_DEFAULT);
		$ans2 = $con->query("UPDATE member SET pass = '$finalpas' WHERE instituteID = $var");
		$con->close();
		echo '<script>
			window.alert("Password changed successfully");
			history.go(-1);
		    </script>';
	}
	else
	{
		$con->close();
		echo '<script>
			window.alert("Current password is incorrect!!");
			history.go(-1);
		    </script>';
	}
?>
