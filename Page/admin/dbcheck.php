<?php
	$host = "localhost";		// variables to store database connection parameters.
	$username = "root";
	$pass = "";
	$database = "project";
	$port = 3306;

    $con = new mysqli($host, $username, $pass, $database, $port);
	$stmt = $con->prepare("SELECT * FROM admin WHERE admin_name = ?");
	$stmt->bind_param("s", $_POST['username']);
	$stmt->execute();
	$ans = $stmt->get_result();

	$con->close();
	if($ans->num_rows == 0)
	{
		echo '<script>
			window.alert("Admin not found!!");
			history.go(-1);
		    </script>';
		exit;
	}
	else
	{
		$var = $_POST['username'];
		$con = new mysqli($host, $username, $pass, $database, $port);
		$ans = $con->query("SELECT admin_pass FROM admin WHERE admin_name = '$var'");
		$row = mysqli_fetch_row($ans);
		$pass = $_POST['password'];
		if(!(password_verify($pass, $row[0])))
		{
			echo '	<script>
					window.alert("Invalid Password!!");
		      	    </script>';
			$con->close();
			echo '	<script>
					history.go(-1);
		      	      </script>';
			exit;
		}
		else
		{
			session_start();
			$_SESSION['admin'] = $var;
			header("Location: /Project/Page/admin/landing.php");
			exit;
		}
	}
?>
