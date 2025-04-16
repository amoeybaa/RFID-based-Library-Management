<html>
	<head>
		<link rel="stylesheet" href="/Project/Page/css/style2.css">
		<title>Return Book</title>
		<script>
			function ret1()
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
					$con->close();
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
					if($row2['bookcnt'] == 0)
					{
						$con->close();
						setcookie("memID", null, time() - 3600, "/");
						setcookie("isRet", null, time() - 3600, "/");
						echo '<script>
							window.alert("No books issued by the user!!");
							history.go(-1);
							</script>';
						exit;
					}
					
					$con->close();
					echo '<script>
							window.alert("Hello '.$id.'. Scan a book to return");
							ret1();
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
					$con->close();
					setcookie("bookID", null, time() - 3600, "/");
					
					echo '<script>
						window.alert("Book not found!! Scan another book");
						ret1();
						</script>';
					exit;
				}
				$row = $ans->fetch_assoc();
				$bkid = $row['bookID'];
				$bkname = $row['title'];
				$id = $_COOKIE['memID'];
				$t1 = $con->query("SELECT * FROM member WHERE rfid = '$id'");
				$t2 = $t1->fetch_assoc();
				$memid = $t2['memberID'];
				$fl = 0;
				
				$ans2 = $con->query("SELECT * FROM borrowing WHERE memberID=$memid");
				while($row2 = $ans2->fetch_assoc())
				{
					if($row2['bookID'] == $bkid)
					{
						$fl = 1;
						break;
					}
				}
				
				if($fl == 1)
				{
					$x = $row2['due_date'];
					$x1 = strtotime($x);
					$ddate = new DateTime("@$x1");
					$cdate = new DateTime();
					$date_diff = $ddate->diff($cdate);
					$days = $date_diff->format('%r%a');
					
					$ans3 = $con->query("UPDATE book SET copies = (copies + 1) WHERE bookID=$bkid");
					if($days > 0)
					{
						$new_due = (ceil(($days)/7))*10;
						$ans5 = $con->query("UPDATE member SET dues = (dues+$new_due) WHERE memberID=$memid");
					}
					
					//pg_close($ans2);
					$ans4 = $con->query("DELETE FROM borrowing WHERE memberID=$memid AND bookID=$bkid");
					setcookie("bookID", null, time() - 3600, "/");
					setcookie("memID", null, time() - 3600, "/");
					setcookie("isRet", null, time() - 3600, "/");
					$con->close();
					echo '<script>
							window.alert("'.$bkname.' returned successfully.");
							history.go(-1);
						  </script>';
				}
				else
				{
					$con->close();
					setcookie("bookID", null, time() - 3600, "/");
					$id2 = $t2['instituteID'];
					echo '<script>
						window.alert("This book is not issued by '.$id2.'!! Scan another book");
						ret1();
						</script>';
					exit;
				}
					
			}
			else
			{
				setcookie("bookID", null, time() - 3600, "/");
				setcookie("memID", null, time() - 3600, "/");
				setcookie("isRet", null, time() - 3600, "/");
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
