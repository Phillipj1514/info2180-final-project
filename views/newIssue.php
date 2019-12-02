<script src = "scripts/index.js"></script>
<section>
   
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
</section>
