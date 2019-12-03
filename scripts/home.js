main();
function main(){
    tableBody = $('#issue-table-body');
    setIssues("all");
    $("#newIssue").on('click', function(){
        mainContent.load('views/newIssue.php');
        $.getScript( "scripts/newIssue.js", function( data, textStatus, jqxhr ){});
    });
    $('#filterAll').on('click', function(){
        setIssues("all");
    });

    $('#filterOpen').on('click', function(){
        setIssues("open");
    });

    $('#filterMyTicket').on('click', function(){
        setIssues("user");
    });

    function setIssues(criteria){
        let getIssuesUrl;
        if(criteria == "all"){
            getIssuesUrl = "scripts/system.php?session="+sessionId+"&method=getAllIssues";
        }else if(criteria == "open"){
            getIssuesUrl = "scripts/system.php?session="+sessionId+"&method=getOpenIssues";
        }else if(criteria == "user"){
            getIssuesUrl = "scripts/system.php?session="+sessionId+"&method=getUserIssues";
        }
        $.get(getIssuesUrl,
            function (data, textStatus, jqXHR) {
                if(textStatus === "success"){
                    //console.log(data); 
                    if(data === "invalid"){
                        console.log(data);
                    }else{
                        tableBody.html(data);
                    }
                
                }
            }
        );
    }
}


function viewIssue(id){
    issueViewId = id;
    mainContent.load('views/issueView.php');
    $.getScript( "scripts/issueView.js", function( data, textStatus, jqxhr ){});
    // alert("Clicked Issue  "+id);
}