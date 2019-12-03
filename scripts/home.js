main();
function main(){
    let tableBody = $('#issue-table-body');
    
    setAllIssues(tableBody);
    $(".title-text").on('click', function(){
        alert("tapped");
    });
    
    $("#newIssue").on('click', function(){
        mainContent.load('views/newIssue.php');
        $.getScript( "scripts/newIssue.js", function( data, textStatus, jqxhr ){});
    });
    
}
function setAllIssues(table_body){
    getAllIssuesUrl = "scripts/system.php?session="+sessionId+"&method=getAllIssues";
    $.get(getAllIssuesUrl,
        function (data, textStatus, jqXHR) {
            if(textStatus === "success"){
                //console.log(data); 
                table_body.html(data);  
            }
        }
    );

}