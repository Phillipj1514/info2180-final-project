<<<<<<< HEAD:views/newIssue.php
<script src = "index.js"></script>
<section>
=======
<!DOCTYPE html>
<html>
<head>
  <link rel = "stylesheet" type = "text/css" href="css/layout.css">

  <script src = "scripts/index.js"></script>
</head>

<body>
  <div class = "grid-container">
    <div class = "G-div1" >
      <div class = "flex-container">
        <header>
          <h1> BugMe Issue Tracker </h1>
        </header>
      </div>
    </div>


>>>>>>> b86b6c9893263eb117c321d700f98282c75abbc7:newIssue.html
    <div class = "G-main">
      <div class = "F-mainContainer">
        <div class = "Sidebar-container">
          <div class="sidenav">
            <a href="home.html">Home</a>
            <a href="index.html">Add User</a>
            <a href="newIssue.html">New Issue</a>
            <a href="login.html">Logout</a>
          </div>
        </div>

        <div class = "Main-container">
          <h2> Create Issue </h2>
          <form>
            <label for = "Title"> Title </label><br>
            <input type = "text" name = "Title" id = "Title" placeholder="Enter title of issue" class = "textbox"> <br>
            <label for = "Description"> Discription </label><br>
            <input type = "textarea" name="Description" id = "Description" class = "textarea" rows="15" cols="80"></textarea><br>
            <label for = "AssignTo"> Assigned To: </label><br>
            <select name = "User" id = "User" class = "textbox">
              <option value="User1">User1</option>
              <option value="User1">User1</option>
              <option value="User1">User1</option>
              <option value="User1">User1</option>
            </select> <br>

            <label for = "Type"> Type </label><br>
            <select name = "Type" id = "Type" class = "textbox">
              <option value="Type1">Type1</option>
              <option value="User2">Type2</option>
              <option value="User3">Type3</option>
              <option value="User4">Type4</option>
            </select> <br>

            <label for = "Priority"> Priority </label><br>
            <select name = "Priority" id = "Priority" class = "textbox">
              <option value="Priority1">Priority1</option>
              <option value="Priority2">Priority2</option>
              <option value="Priority3">Priority3</option>
              <option value="Priority4">Priority4</option>
            </select> <br>

            <button type = "button" id = "submit"> Submit </button>
          </form>
          <div id = "result"></div>
        </div>
      </div>


</div>
</div>
</section>
