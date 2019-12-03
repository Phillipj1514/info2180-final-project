main()
function main(){
    let titleText = $("#issue_title");
    let idNumText = $("#issue_num");
    let descriptionText = $("#issue_description");
    let createDateText = $("#issue_create");
    let updateDateText = $("#issue_update");
    let assignUserText = $("#issue_assign");
    let typeText = $("#issue_type");
    let priorityText = $("#issue_priority");
    let statusText = $("#issue_status");
    let id = issueViewId;
    idNumText.html("Issue #"+id);
    setIssue();

    $("#mark_closed").on('click', function (){
        let statusClosedUrl="scripts/system.php?session="+sessionId+"&method=issue&id="+id;
        $.post(statusClosedUrl, {
            status:"closed"
            },
            function (data, textStatus, jqXHR) {
                if(textStatus === "success"){
                    console.log(data);
                    if(data != "invalid"){
                        statusText.html("Closed");
                        let today = new Date();
                        let date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
                        let time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
                        let dateTime = date+' '+time;
                        updateDateText.html(dateTime);
                    }
                }
            }
        );

    });
    $("#mark_progress").on('click', function (){
        let statusProgressUrl="scripts/system.php?session="+sessionId+"&method=issue&id="+id;
        $.post(statusProgressUrl, {
            status:"progress"
            },
            function (data, textStatus, jqXHR) {
                if(textStatus === "success"){
                    console.log(data);
                    if(data != "invalid"){
                        statusText.html("In Progress");
                        let today = new Date();
                        let date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
                        let time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
                        let dateTime = date+' '+time;
                        updateDateText.html(dateTime);
                    }
                }
            }
        );
    });
    function setIssue(){
        let getIsueUrl = "scripts/system.php?session="+sessionId+"&method=issue&id="+id;
        $.get(getIsueUrl,
            function (data, textStatus, jqXHR) {
                if(textStatus === "success"){
                    //console.log(JSON.parse(data));
                    let issue = JSON.parse(data);
                    titleText.html(issue.title);
                    descriptionText.html(issue.description);
                    createDateText.html(issue.created);
                    updateDateText.html(issue.updated);
                    assignUserText.html(issue.assigned_to);
                    typeText.html(issue.type);
                    priorityText.html(issue.priority);
                    statusText.html(issue.status);
                    
                }
            }
        );
    }

}