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
		        
		</div>
		<div class="footer">
		    <p>&copy; 2023 Library Management System by BG5</p>
		</div>
	    </div>
	</body>
</html>
