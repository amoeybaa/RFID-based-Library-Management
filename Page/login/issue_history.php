<!DOCTYPE HTML>
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
            <div class = "tables">
                <table>
                    <thead>
                        <tr>
                            <th>Sr. No</th>
                            <th>Book Name</th>
                            <th>Author</th>
                            <th>Issue Date</th>
                            <th>Return Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>The Great Gatsby</td>
                            <td>F. Scott Fitzgerald</td>
                            <td>2023-08-01</td>
                            <td>2023-09-15</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>To Kill a Mockingbird</td>
                            <td>Harper Lee</td>
                            <td>2023-08-05</td>
                            <td>2023-09-10</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>1984</td>
                            <td>George Orwell</td>
                            <td>2023-08-10</td>
                            <td>2023-09-20</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Pride and Prejudice</td>
                            <td>Jane Austen</td>
                            <td>2023-08-15</td>
                            <td>2023-09-25</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>The Catcher in the Rye</td>
                            <td>J.D. Salinger</td>
                            <td>2023-08-20</td>
                            <td>&nbsp;</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="footer">
            <p>&copy; 2023 Library Management System by BG5</p>
        </div>
    </div>
</body>
</html>
