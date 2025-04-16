<html>
	<head>
	    <link rel="stylesheet" href="/Project/Page/css/styles.css">
	    <script type="text/javascript" src="/Project/Page/script.js"></script>
	    <title>Library Management System</title>
	</head>
	<body>
	    <div class="sidebar">
		<div class="logo">
		    <br><br><br><br>
		    <a href="/Project/Page/admin/landing.php"><h1>Bibliotheca</h1></a>
		    <br><hr><br><hr><br><br>
		    <img src="/Project/Page/css/library_logo.jpg" alt="Library Logo">
		</div>
	    </div>
	    <div class="content">
		<header>
		    <?php
				session_start();
				$var = $_SESSION['admin'];
				echo "<h1>Hello $var!</h1>";

				$host = "localhost";		// variables to store database connection parameters.
				$username = "root";
				$pass = "";
				$database = "project";
				$port = 3306;
		    ?>
		</header>
		<nav class="navigation">
		    <ul>
		        <li><a href="/Project/Page/admin/update_member.php">Member Tab</a></li>
		        <li><a href="/Project/Page/admin/update_book.php">Book Tab</a></li>
		        <li><a href="/Project/Page/admin/post_notif.php">Post Notification</a></li>
		        <li><a href="/Project/Page/homepage.html" onclick="return confirmLogout()">Logout</a></li>
		    </ul>
		</nav>
		<div class = "mainarea">
		    <br><br>
			<div class="add_new_book">
				<form action="" method="post">
					<label for="bname">Book Name: </label><br>
					<input type="text" name="bname" required /> <br><br>
					<label for="auth">Author: </label><br>
					<input type="text" name="auth" required /> <br><br>
					<label for="isbn">ISBN No: </label><br>
					<input type="number" name="isbn" id="isbn" min="0" required /> <br><br>
					<label for="year">Publish Year: </label><br>
					<input type="number" name="year" id="year" min="0" required /> <br><br>
					<label for="copies">Number of Copies: </label><br>
					<input type="number" name="copies" min="0" required /> <br><br>
					<label for="amt">Amount: </label><br>
					<input type="number" name="amt" min="0" required /> <br><br>
					<label for="amt">RFID: </label><br>
					<input type="text" name="rfid" required /> <br><br>
					<div class="button-container">
						<button type="submit" name="add" onclick="return validate_add()">Add Book</button>
						<button type="button" onclick="gotoBook()">Go Back</button>
			    	</div>
					
				</form>
			</div>
			<?php
				$con = new mysqli($host, $username, $pass, $database, $port);
				if(isset($_POST['add']))
				{
					$bname = $_POST['bname'];
					$auth = $_POST['auth'];
					$isbn = $_POST['isbn'];
					$year = $_POST['year'];
					$copies = $_POST['copies'];
					$amt = $_POST['amt'];
					$rfid = $_POST['rfid'];
					
					$res = $con->prepare("INSERT INTO book VALUES (DEFAULT, ?, ?, ?, ?, ?, ?)");
					$res->bind_param("ssiiis", $bname, $isbn, $year, $copies, $amt, $rfid);
					if(!($res->execute())) {
						$error_msg = res->error;
						echo "	<script>
								alert('Could not add book!\n$error_msg');
								</script>";

						$con->close();
						exit();
					}
					
					$res3 = $con->prepare("SELECT bookID FROM book WHERE title=?");
					$res3->bind_param("s", $bname);
					$res3->execute();
					$res3_result = $res3->get_result();
					$row3 = mysqli_fetch_row($res3_result);
					$newbookid = $row3[0];

					$res2 = $con->prepare("SELECT * FROM author WHERE name=?");
					$res2->bind_param("s", $auth);
					$res2->execute();
					$res2_result = $res2->get_result();
					if($res2_result->num_rows != 0)
					{
						$row2 = $res2_result->fetch_assoc();
						$authid = $row2['authorID'];

						$res4 = $con->query("INSERT INTO auth_book VALUES ($newbookid, $authid)");
						if($res4)
						{
							echo "	<script>
									alert('Old author added successfully!');
									</script>";
						}
					}
					else
					{
						$res5 = $con->prepare("INSERT INTO author VALUES (DEFAULT, ?)");
						$res5->bind_param("s", $auth);
						$res5->execute();

						$res6 = $con->prepare("SELECT authorID FROM author WHERE name=?");
						$res6->bind_param("s", $auth);
						$res6->execute();
						$row6 = $res6->get_result();
						$newauthid = $row6->fetch_assoc()['authorID'];

						$res7 = $con->query("INSERT INTO auth_book VALUES ($newbookid, $newauthid)");
						if($res7)
						{
							echo "	<script>
									alert('New author added successfully!');
									</script>";
						}
					}
						
						
					if($res->affected_rows)
					{
						echo "	<script>
								alert('Book added successfully!');
								</script>";
					}
					else
					{
						echo "	<script>
								alert('Could not add book!');
								</script>";
					}
				}
				$con->close();
			?>
			<br><br>
		</div>
		<div class="footer">
		    <p>&copy; 2023 Library Management System by BG5</p>
		</div>
	    </div>
	</body>
</html>

