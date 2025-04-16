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
			// pg_close($con);
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
		    <div class="report_books">
		        <h2><u>Report Lost/Damaged Books</u></h2>
		        <br>
		        <form>
		            <label for="book-title">Book Title: </label>
		            <input type="text" id="book-title" name="book-title" placeholder="Enter book name..." required><br>
		            <label for="dmgd/lost">Select an option:</label>
		            <select name="dl" id="dl">
		                <option value="damaged" selected>Damaged</option>
		                <option value="lost">Lost</option>
		            </select>
		            <br>
		            <label for="reason">Reason: </label>
		            <textarea id="reason" name="reason" rows="4" placeholder="Enter reason..." required></textarea>
		            <br>
		            <button type="submit">Submit</button>
		        </form>
		    </div>
		    <br><br>
		</div>
		<div class="footer">
		    <p>&copy; 2023 Library Management System by BG5</p>
		</div>
	    </div>
	</body>
</html>
