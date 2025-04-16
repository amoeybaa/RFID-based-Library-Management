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
		    <a href="/Project/Page/homepage.html"><h1>Bibliotheca</h1></a>
		    <br><hr><br><hr><br><br>
		    <img src="/Project/Page/css/library_logo.jpg" alt="Library Logo">
		</div>
	    </div>

	    <div class="content">
		<header>
		    <h1>Welcome to Library Management</h1>
		</header>
		<nav class="navigation">
		    <ul>
		        <li><a href="/Project/Page/login.php">Login</a></li>
		        <li><a href="/Project/Page/search.php">Search</a></li>
		        <li><a href="/Project/Page/history.html">History</a></li>
		        <li><a href="/Project/Page/rules.html">Rules</a></li>
		        <li><a href="/Project/Page/notifications.html">Notifications</a></li>
		    </ul>
		</nav>
		<div class = "mainarea">
		    <br><br><br>
		    <div class="login-container">
		        <h2><u>Login</u></h2>
		        <br>
		        <form action="dbcheck.php" method="POST">
		            <label for="username">Username:</label>
		            <input type="text" id="username" name="username" placeholder="Admin Name" required/>
		            <br>
		            <label for="password">Password:</label>
		            <input type="password" id="password" name="password" placeholder="Password..." required/>
		            <button type="submit" onclick="return validateAdminForm()">Login</button><br>
		        </form>
		    </div>
		</div>
		<div class="footer">
		    <p>&copy; 2023 Library Management System by BG5</p>
		</div>
	    </div>
	</body>
</html>
