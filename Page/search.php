<html>
	<head>
	    <link rel="stylesheet" href="/Project/Page/css/styles.css">
	    <title>Library Management System</title>
	</head>
	<body onload="document.myForm.reset()";>
	    <div class="sidebar">
		<div class="logo">
		    <br><br><br><br>
		    <a href="homepage.html"><h1>Bibliotheca</h1></a>
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
		        <li><a href="login.php">Login</a></li>
		        <li><a href="search.php">Search</a></li>
		        <li><a href="history.html">History</a></li>
		        <li><a href="rules.html">Rules</a></li>
		        <li><a href="notifications.html">Notifications</a></li>
		    </ul>
		</nav>
		<div class = "mainarea">
		    <br>
		    <div class="search-form">
		        <h2><u>Search for Books</u></h2>
		        <br>
		        <form action="search.php" method="POST">
		            <label for="search">Keywords: </label>
		            <input type="text" id="search" name="search" placeholder="Enter book title or author" required minlength="3" class ="left-pads">
		            <button type="submit" class = "left-pads">Search</button>
		    </div>
		    <br><br>
		    <div class="search-results">
		        <h2>Search Results</h2>
		        <br>
		        <?php
					if (isset($_POST["search"]))
					{
						$key = $_POST["search"];
						$nkey = "%$key%";
						$con = new mysqli("localhost", "root", "", "project", 3306);
						$stmt = $con->prepare("	SELECT book.title, author.name, book.copies FROM book 
												JOIN auth_book ON book.bookID = auth_book.bookID 
												JOIN author ON auth_book.authorID = author.authorID 
												WHERE (book.title LIKE ?) 
												OR (author.name LIKE ?)");
						$stmt->bind_param("ss", $nkey, $nkey);
						$stmt->execute();
						$ans = $stmt->get_result();

						if($ans->num_rows == 0)
						{
							echo "<br><p><h3 align='center'>No results found!</h3></p>";
							$con->close();
						}
						else
						{
							echo "<table>";
							echo "<tr><th>Title</th><th>Author</th><th>Copies</th></tr>";
							while($row = mysqli_fetch_row($ans))
							{
								echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td</tr>";
							}
							echo "</table>";
							$con->close();
						}
					}
				?>
				<br>
		    </div>
		    <br><br>
		</div>
		<div class="footer">
		    <p>&copy; 2023 Library Management System by BG5</p>
		</div>
	    </div>
	</body>
</html>
