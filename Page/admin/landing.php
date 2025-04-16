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
		    <div class="left-right">
		        <div class="left-area">
		            <h3>Books Issued This Month</h3>
			    <br><br>
			    <?php
					$con = new mysqli("localhost", "root", "", "project", 3306);
					$ans = $con->query("SELECT COUNT(*) FROM borrowing WHERE borrow_date >= DATE_FORMAT(CURRENT_DATE, '%Y-%m-01')");
					$row = mysqli_fetch_row($ans);
					echo "<h2>$row[0]</h2>";
					$con->close();
			    ?>
		        </div>
		        <div class="right-area">
		            <h3>Current Notifications	</h3>
			    	<br><br>
			    	<h2>NONE</h2>
		        </div>
		    </div>
		</div>
		<div class="footer">
		    <p>&copy; 2023 Library Management System by BG5</p>
		</div>
	    </div>
	</body>
</html>
