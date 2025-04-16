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
		    <h1>Bibliotheca</h1>
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
		    <br><br><br>
		    <div class="left-right">
		        <div class="left-area">
		            <h3>Pending Fees/Dues</h3>
			    <br><br>
			    <?php
					$con = new mysqli($host, $username, $pass, $database, $port);
					$ans = $con->query("SELECT dues FROM member WHERE instituteID = $var");
					$row = mysqli_fetch_row($ans);
					echo "<h2>\$$row[0]</h2>";
					$con->close();
			    ?>
		        </div>
		        <div class="right-area">
		            <h3>Currently Issued Books</h3>
			    <br><br>
			    <?php
					$con = new mysqli($host, $username, $pass, $database, $port);
					$ans2 = $con->query("SELECT DISTINCT title FROM book, borrowing, member where book.bookID in(SELECT bookID FROM borrowing WHERE memberID in(SELECT memberID FROM member WHERE instituteID = $var))");
					if($ans2->num_rows == 0)
					{
						echo "<h2>NONE</h2>";
					}
					else if($ans2->num_rows == 1)
					{
						$row2 = mysqli_fetch_row($ans2);
						echo "<h2>&#8226;$row2[0]</h2>";
					}
					else
					{
						$row2 = mysqli_fetch_row($ans2);
						echo "<h2>&#8226;$row2[0]</h2><br><br>";
						$row2 = mysqli_fetch_row($ans2);
						echo "<h2>&#8226;$row2[0]</h2>";
					}
			    ?>
		        </div>
		    </div>
		</div>
		<div class="footer">
		    <p>&copy; 2023 Library Management System by BG5</p>
		</div>
	    </div>
	</body>
</html>
