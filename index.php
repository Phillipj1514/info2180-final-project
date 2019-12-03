<!DOCTYPE html>
<html>
<head>
    <link rel = "stylesheet" type = "text/css" href="css/layout.css">
    <link rel = "stylesheet" type = "text/css" href="css/login.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src = "scripts/app.js"></script>
</head>
<body>
    <header>
        <img src="images/bug-icon-white.png" class="icon-logo"/>
    <h1> BugMe Issue Tracker </h1>
    </header>
    <Main id="body">
        <!-- <h1>The main content would be loaded here base on the state</h1> -->
        <div class = "G-main">
        <div class = "F-mainContainer">
            <div class = "Sidebar-container">
            <div class="sidenav">
                <a href="#home">Home</a>
                <a href="#add-user">Add User</a>
                <a href="#new-issue">New Issue</a>
                <a href="#">Logout</a>
            </div>
            </div>

        <div class = "Main-container">
            <?php include('views/home.php');?>
        </div>
    </div>
    </div>
        
    </Main>
</body>
</html>
