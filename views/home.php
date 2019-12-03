
<section>
    <div class = "Main-container">
      <h2 class = "inline"> Issues </h2>
      <a href = "#new-issue"><button type = "button" id = "newIssue" class = "newIssueBtn"> Create new Issue </button></a>
      <br><p class = "inline">Filtered by:</p>
      <button type = "button" id = "filterAll" class = "inline smallBtn"> All </button>
      <button type = "button" id = "filterOpen" class = "inline smallBtn"> Open </button>
      <button type = "button" id = "filterMyTicket" class = "inline smallBtn"> My Tickets </button>

      <div id = "result">
        <table>
          <thead>
            <tr>
              <th>Title</th>
              <th>Type</th>
              <th>Status</th>
              <th>Assigned_to</th>
              <th>Created</th>
            </tr>
          </thead>
          <tbody id="issue-table-body">
            <tr>
              <td class="tTitle"> a title</td>
              <td class="tType"> a type</td>
              <td class="tStatus"> a status</td>
              <td class="tassign"> a assignedto</td>
              <td class="tcreate"> a creatd</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    
</section>
<script src = "scripts/home.js"></script>

