<?php
	$con = new mysqli("localhost", "root", "", "project", 3306);
	$stmt = $con->prepare("SELECT * FROM member WHERE instituteID = ?");
	$stmt->bind_param("i", $_POST['username']);
	$stmt->execute();
	$ans = $stmt->get_result();	

	$name = $_POST['username'];
	$con->close();
	if($ans->num_rows == 0)
	{
		echo '<script>
			window.alert("User not found!!");
			history.go(-1);
		    </script>';
		exit;
	}
	else
	{
		$var = $name;
		$con = new mysqli("localhost", "root", "", "project", 3306);
		$ans = $con->query("SELECT pass FROM member WHERE instituteID = $var");
		$row = mysqli_fetch_row($ans);
		$pass = $_POST['password'];
		if(!(password_verify($pass, $row[0])))
		{
			echo '<script>
				window.alert("Invalid Password!!");
		      	</script>';
				$con->close();
			echo '<script>
				history.go(-1);
		      	</script>';
			exit;
		}
		else
		{
			session_start();
			$_SESSION['var'] = $var;
			header("Location: /Project/Page/login/landing.php");
			exit;
		}
	}
?>
