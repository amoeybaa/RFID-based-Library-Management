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
		    <a href="landing.php"><h1>Bibliotheca</h1></a>
		    <br><hr><br><hr><br><br>
		    <img src="/Project/Page/css/library_logo.jpg" alt="Library Logo">
		</div>
	    </div>
	    <div class="content">
		<header>
			<?php
				session_start();
				$var = $_SESSION['var'];
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
		        <li><a href="account.php">Account</a></li>
		        <li><a href="reportb.php">Report Book</a></li>
		        <li><a href="issue_history.php">Issuance History</a></li>
		        <li><a href="feedback_request.php">Feedback/Requests</a></li>
		        <li><a href="/Project/Page/homepage.html" onclick="return confirmLogout()">Logout</a></li>
		    </ul>
		</nav>
		<div class = "mainarea">
		    <br>
		    <div class="account_info">
			<h2><u>Account Information</u></h2>
		        <br><br>
		        <img src="/Project/Page/css/person.jpg" alt="photo_id"/><br>
			<?php
				// session_start();
				$var = $_SESSION['var'];
				$con = new mysqli($host, $username, $pass, $database, $port);
				$ans = $con->query("SELECT first_name, last_name, email, dues FROM member WHERE instituteID = $var");
				$row = mysqli_fetch_row($ans);
				$ans2 = $con->query("SELECT DISTINCT title FROM book, borrowing, member where book.bookID in(SELECT bookID FROM borrowing WHERE memberID in(SELECT memberID FROM member WHERE instituteID = $var))");
				echo "<p>Name: $row[0] $row[1]</p><br>";
				echo "<p>Email: $row[2]</p><br>";
				if($ans2->num_rows == 0)
				{
					echo "<p>Currently issued books: None</p><br>";
				}
				else if($ans2->num_rows == 1)
				{
					$row2 = mysqli_fetch_row($ans2);
					echo "<p>Currently issued books:<br>&#8226;$row2[0]</p><br>";
				}
				else
				{
					$row2 = mysqli_fetch_row($ans2);
					echo "<p>Currently issued books:<br>&#8226;$row2[0]</p>";
					$row2 = mysqli_fetch_row($ans2);
					echo "<p>&#8226;$row2[0]</p><br>";
				}
					
				echo "<p>Fees/Dues: \$$row[3]</p><br><br>";
				$con->close();
			?>
		        <a href="resetpwd.php"><button type ="button" value="Reset Password">Reset Password</button></a>
		    </div>
		</div> 
		<div class="footer">
		    <p>&copy; 2023 Library Management System by BG5</p>
		</div>
	    </div>
	</body>
</html>
