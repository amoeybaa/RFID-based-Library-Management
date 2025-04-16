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
		    <div class="login-container">
			<h2><u>Reset Password</u></h2>
		        <br><br>
			<form action="pcheck.php" method="POST">
		            <label for="ppass">Current password:</label>
		            <input type="password" id="ppass" name="ppass" required/>
		            <br>
		            <label for="password">New password:</label>
		            <input type="password" id="password" name="password" required/>
			    <br>
			    <label for="npass">Re-enter new password:</label>
		            <input type="password" id="npass" name="npass" required/>
			    <div class="button-container">
				    <button type="submit" onclick="return resetpwd()">Reset Password</button>
				    <button type="button" onclick="goBack()">Go Back</button>
			    </div>
		        </form>
		    </div>
		</div> 
		<div class="footer">
		    <p>&copy; 2023 Library Management System by BG5</p>
		</div>
	    </div>
	</body>
</html>
