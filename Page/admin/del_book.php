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
			<div class="update_book">
				<form action="" method="post">
					<label for="key">Book Name: </label>
					<input type="text" name="key" placeholder="Enter book name for search" required />
					<div class="button-container">
						<button type="submit" name="search">Search Book</button>
						<button type="button" onclick="gotoBook()">Go Back</button>
					</div>
				</form>
			</div>
			<br><br>
			<div class="update_output">
			<?php
				$con = new mysqli("localhost", "root", "", "project", 3306);
				if(isset($_POST['search']))
				{
					$key = $_POST['key'];
					$nkey = "%$key%";
					$stmt = $con->prepare("SELECT * FROM book WHERE title LIKE ?");
					$stmt->bind_param("s", $nkey);
					$stmt->execute();
					$ans = $stmt->get_result();

					if($ans->num_rows == 0)
					{
						echo "<br><p><h3 align='center'>No results found!</h3></p>";
						$con->close();
					}
					else
					{
						$row = $ans->fetch_assoc();
						$_SESSION['id'] = $row['bookID'];
			?>
						<div class="tables">
							<table border="1">
								<tr><td>Book Name</td><td><?php echo $row['title']; ?></td></tr>
								<tr><td>ISBN</td><td><?php echo $row['isbn']; ?></td></tr>
								<tr><td>Publishing Year</td><td><?php echo $row['year']; ?></td></tr>
								<tr><td>Number of Copies</td><td><?php echo $row['copies']; ?></td></tr>
								<tr><td>Amount</td><td><?php echo $row['amount']; ?></td></tr>
								<tr><td>RFID</td><td><?php echo $row['rfid']; ?></td></tr>
							</table>
						</div>
						<br>
						<form action="" method="post">
							<button type="submit" name="del">Delete Book</button>
						</form>
			<?php
						$con->close();
					}
				}
			?>
			<?php
				$con = new mysqli("localhost", "root", "", "project", 3306);
				if(isset($_POST['del']))
				{
					$id = $_SESSION['id'];
					$res1 = $con->query("SELECT * FROM borrowing WHERE borrowing.bookID=$id");
					if($res1->num_rows != 0)
					{
						echo "	<script>
								window.alert('Book is borrowed by a member! Return all books before deleting!');
								</script>";
						$con->close();
					}
					else
					{
						$res2 = $con->query("DELETE FROM book WHERE bookID=$id RETURNING title");
						$row2 = mysqli_fetch_row($res2);
						$booktitle = $row2[0];
						if($res2)
						{
							$row = $res2->fetch_assoc();
							echo "	<script>
									window.alert('\'$booktitle\' has been deleted.');
									</script>";
						}
						else
						{
							echo "	<script>
									window.alert('Could not delete book!\n$res2->error');
									</script>";
						}
						$con->close();
					}
					unset($_SESSION['del']);
				}
			?>
			<br><br>
			</div>
			<br><br>
		</div>
		<div class="footer">
		    <p>&copy; 2023 Library Management System by BG5</p>
		</div>
	    </div>
	</body>
</html>

