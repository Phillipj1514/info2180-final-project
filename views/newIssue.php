<script src = "scripts/index.js"></script>
<section>
   
    <h2> Create Issue </h2>
    <form>
      <label for = "Title"> Title </label><br>
      <input type = "text" name = "Title" id = "title" placeholder="Enter title of issue" class = "textbox"> <br>
      <label for = "Description"> Discription </label><br>
      <input type = "textarea" name="Description" id = "description" class = "textarea" rows="15" cols="80"></textarea><br>
      <label for = "AssignTo"> Assigned To: </label><br>
      <select name = "User" id = "user" class = "textbox">
        <option value="admin@bugme.com">admin</option>
      </select> <br>

      <label for = "Type"> Type </label><br>
      <select name = "Type" id = "type" class = "textbox">
        <option value="bug">Bug</option>
        <option value="proposal">Proposal</option>
        <option value="task">Task</option>
      </select> <br>

      <label for = "Priority"> Priority </label><br>
      <select name = "Priority" id = "priority" class = "textbox">
        <option value="minor">Minor</option>
        <option value="major">Major</option>
        <option value="critical">Critical</option>
      </select> <br>

      <button id = "submit"> Submit </button>
    </form>
    <div id = "result"></div>
</section>
