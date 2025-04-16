<html>
	<head>
		<link rel="stylesheet" href="/Project/Page/css/style2.css">
		<title>Issue Book</title>
		<script>
			function issue1()
			{
				window.location.assign("http://localhost:5000/");
			}
			
		</script>
	</head>
	
	<body>
		<div class="sidebar">
		<div class="logo">
		    <br><br><br><br>
		    <h1>Bibliotheca</h1>
		    <br><hr><br><hr><br><br>
		    <img src="/Project/Page/css/library_logo.jpg" alt="Library Logo">
		</div>
	    </div>
	    <div class="content">
		<header>
		    <h1>Welcome to Library Management</h1>
		</header>
		
		<div class = "mainarea">
		
		<?php
			if(isset($_COOKIE['memID']) && !(isset($_COOKIE['bookID'])))
			{
				$memID = $_COOKIE['memID'];
				
				$con = new mysqli("localhost", "root", "", "project", 3306);
				$ans = $con->query("SELECT * FROM member WHERE rfid = '$memID'");
				if($ans->num_rows == 0)
				{
					setcookie("memID", null, time() - 3600, "/");
					echo '<script>
						window.alert("User not found!!");
						history.go(-1);
						</script>';
					exit;
				}
				else
				{
					$row = $ans->fetch_assoc();
					$id = $row['instituteID'];
					$ans2 = $con->query("SELECT COUNT(*) AS bookcnt FROM borrowing where memberID = (SELECT memberID FROM member where instituteID = $id)");
					$row2 = $ans2->fetch_assoc();
					if($row2['bookcnt'] == 2)
					{
						setcookie("memID", null, time() - 3600, "/");
						echo '<script>
							window.alert("User cannot issue more books!!");
							history.go(-1);
							</script>';
						exit;
					}
					
					echo '<script>
							window.alert("Hello '.$id.'. Scan a book");
							issue1();
						  </script>';
				}
			}
			
			else if((isset($_COOKIE['memID'])) && (isset($_COOKIE['bookID'])))
			{
				$bookID = $_COOKIE['bookID'];
				$con = new mysqli("localhost", "root", "", "project", 3306);
				$ans = $con->query("SELECT * FROM book WHERE rfid = '$bookID'");
				if($ans->num_rows == 0)
				{
					setcookie("bookID", null, time() - 3600, "/");
					
					echo '<script>
						window.alert("Book not found!! Scan another book to issue");
						issue1();
						  </script>';
					exit;
				}
				
				$row = $ans->fetch_assoc();
				if($row['copies'] <= 0)
				{
					setcookie("bookID", null, time() - 3600, "/");
					echo '<script>
						window.alert("No more copies of '.$row['title'].' left to be issued!! Scan another book");
						issue1();
						  </script>';
					exit;
				}
				
				$bkname = $row['title'];
				$id = $_COOKIE['memID'];
				$t1 = $con->query("SELECT memberID FROM member WHERE rfid = '$id'");
				$t2 = $t1->fetch_assoc();
				$t3 = $t2['memberID'];
				$t4 = $row['bookID'];
				
				$sql = "INSERT INTO borrowing VALUES (DEFAULT, $t4, $t3, DEFAULT, DEFAULT, null)";
				$ans2 = $con->query($sql);
				
				$ans4 = $con->query("UPDATE book SET copies = (copies-1) WHERE rfid = '$bookID'");
				$con->close();
				setcookie("bookID", null, time() - 3600, "/");
				setcookie("memID", null, time() - 3600, "/");
				echo '<script>
						window.alert("'.$bkname.' issued successfully");
						history.go(-1);
						</script>';
						  
			}
			else
			{
				setcookie("bookID", null, time() - 3600, "/");
				setcookie("memID", null, time() - 3600, "/");
				echo '<script>
						window.alert("Some error occurred!");
						history.go(-1);
					  </script>';
			}
		?>
		</div>
		<div class="footer">
		    <p>&copy; 2023 Library Management System by BG5</p>
		</div>
	</body>
</html>
