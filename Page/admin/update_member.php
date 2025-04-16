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
		    <br><br><br>
		    <div class="update_member">
				<form action="" method="post">
					<label for="key">Member ID: </label>
					<input type="number" name="key" placeholder="Ex: 218478" required />
					<button type="submit" name="search">Search Member</button>
				</form>
			</div>
		    <br><br>
			<div class="m_update_output">
			<?php
				$con = new mysqli("localhost", "root", "", "project", 3306);
				if(isset($_POST['search']))
				{
					$key = $_POST['key'];
					$_SESSION['iid'] = $key;

					$stmt = $con->prepare("SELECT * FROM member WHERE instituteID=?");
					$stmt->bind_param("i", $key);
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
			?>
						<form action="" method="post">
							<label for="fname">First Name: </label><br>
							<input type="text" name="fname" value="<?php echo $row['first_name']; ?>" required /> <br><br>
							<label for="lname">Last Name: </label><br>
							<input type="text" name="lname" value="<?php echo $row['last_name']; ?>" required /> <br><br>
							<label for="email">Email: </label><br>
							<input type="text" name="email" value="<?php echo $row['email']; ?>" required /> <br><br>
							<label for="pno">Contact No: </label><br>
							<input type="text" name="pno" value="<?php echo $row['phone']; ?>" required /> <br><br>
							<label for="dues">Dues: </label><br>
							<input type="number" name="dues" value="<?php echo $row['dues']; ?>" min="0" step="0.01" required /> <br><br>
							<label for="rfid">RFID: </label><br>
							<input type="text" name="rfid" value="<?php echo $row['rfid']; ?>" required /> <br><br>
							<button type="submit" name="update">Update Data</button>
						</form>
						
						<?php $con->close();
					}
				}
				?>
			</div>
			<?php
				$con = new mysqli("localhost", "root", "", "project", 3306);
				if(isset($_POST['update']))
				{
					$fname = $_POST['fname'];
					$lname = $_POST['lname'];
					$email = $_POST['email'];
					$pno = $_POST['pno'];
					$dues = $_POST['dues'];
					$rfid = $_POST['rfid'];
					$id = $_SESSION['iid'];
					
					$stmt = $con->prepare("UPDATE member SET first_name=?, last_name=?, email=?, phone=?, dues=?, rfid=? WHERE instituteID=?");
					$stmt->bind_param("ssssdsi", $fname, $lname, $email, $pno, $dues, $rfid, $id);
					$stmt->execute();

					if($stmt->affected_rows)
					{
						echo "	<script>
									alert('Member data updated successfully!');
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
			<br><br>
		</div>
		<div class="footer">
		    <p>&copy; 2023 Library Management System by BG5</p>
		</div>
	    </div>
	</body>
</html>
