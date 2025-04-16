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
		    <div class="add_del">
				<div class="add_book">
					<a href="add_book.php"><button>Add New Book</button></a>
				</div>
				<div class="del_book">
					<a href="del_book.php"><button>Delete Existing Book</button></a>
				</div>
			</div>
			<div class="update_book">
				<form action="" method="post">
					<label for="key">Book Name: </label>
					<input type="text" name="key" placeholder="Enter book name for search" required minlength="3" />
					<button type="submit" name="search">Search Book</button>
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
			
						<form action="" method="post">
							<label for="bname">Book Name: </label><br>
							<input type="text" name="bname" value="<?php echo $row['title']; ?>" required /> <br><br>
							<label for="isbn">ISBN No: </label><br>
							<input type="text" name="isbn" value="<?php echo $row['isbn']; ?>" required /> <br><br>
							<label for="year">Publish Year: </label><br>
							<input type="number" name="year" value="<?php echo $row['year']; ?>" min="0" required /> <br><br>
							<label for="copies">Number of Copies: </label><br>
							<input type="number" name="copies" value="<?php echo $row['copies']; ?>" min="0" required /> <br><br>
							<label for="amt">Amount: </label><br>
							<input type="number" name="amt" value="<?php echo $row['amount']; ?>" min="0" required /> <br><br>
							<label for="amt">RFID: </label><br>
							<input type="text" name="rfid" value="<?php echo $row['rfid']; ?>" required /> <br><br>
							<button type="submit" name="update">Update Data</button>
						</form>
						
						<?php $con->close();
					}
				}
						?>
			</div>
			<br><br>
			<?php
				$con = new mysqli("localhost", "root", "", "project", 3306);
				if(isset($_POST['update']))
				{
					$bname = $_POST['bname'];
					$isbn = $_POST['isbn'];
					$year = $_POST['year'];
					$copies = $_POST['copies'];
					$amt = $_POST['amt'];
					$rfid = $_POST['rfid'];
					$id = $_SESSION['id'];

					$stmt = $con->prepare("UPDATE book SET title=?, isbn=?, year=?, copies=?, amount=?, rfid=? WHERE bookID=?");
					$stmt->bind_param("ssiiisi", $bname, $isbn, $year, $copies, $amt, $rfid, $id);
					$stmt->execute();

					if($stmt->affected_rows)
					{
						echo "	<script>
								alert('Book data updated successfully!');
								</script>";
					}
					else
					{
						echo "	<script>
								alert('No changes done.');
								</script>";
					}
				}
				$con->close();
			?>
		</div>
		<div class="footer">
		    <p>&copy; 2023 Library Management System by BG5</p>
		</div>
	    </div>
	</body>
</html>

