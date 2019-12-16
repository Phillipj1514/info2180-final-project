<html>
<head>
	<title>BugMe Issue Tracker</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel = "stylesheet" type = "text/css" href="css/layout.css">
    <link rel = "stylesheet" type = "text/css" href="css/login.css">
	<script src="https://kit.fontawesome.com/80443ca163.js" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src = "scripts/app.js"></script>
</head>
<body>
	<header>
		<h3><span class="fas fa-bug"></span>BugMe Issue Tracker</h3>
	</header>
	<main id="body">
		<div id="links">
			<div class="sidenav">
				<a href="#home"><span class="fas fa-home"></span>Home</a>
				<a href="#add-user"><span id="plus" class="fas fa-user-plus"></span>Add user</a>
				<a href="#new-issue"><span class="fas fa-plus-circle"></span>New Issue</a>
				<a href="#"><span class="fas fa-power-off"></span>Logout</a>
			</div>
		</div>
		<div class = "Main-container">
            <?php include('views/home.php');?>
        </div>
    </Main >
</body>
</html>
