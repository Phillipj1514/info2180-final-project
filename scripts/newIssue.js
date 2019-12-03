main()
function main(){
    let titleField = $("#title");
    let descriptionField = $("#description");
    let userSelector = $("#user");
    let typeSelector = $("#type");
    let prioritySelector = $("#priority");

    fillUsers(userSelector);

    $("#submit").on("click", function(){
        let title = titleField.val();
        let description = descriptionField.val();
        let assignedUser =userSelector.children("option:selected").val();
        let type = typeSelector.children("option:selected").val();
        let priority = prioritySelector.children("option:selected").val();
        let valid = true;
        //validate input
        if(validateInput(title,"text") === true){
            titleField.removeClass("Error");
        }else{
            titleField.addClass("Error");
            valid = false;
        }
        if(validateInput(description,"text") === true){
            descriptionField.removeClass("Error");
        }else{
            descriptionField.addClass("Error");
            valid = false;
        }
        if(validateInput(assignedUser,"email") === true){
            userSelector.removeClass("Error");
        }else{
            userSelector.addClass("Error");
            valid = false;
        }
        if(validateInput(type,"type") === true){
            typeSelector.removeClass("Error");
        }else{
            typeSelector.addClass("Error");
            valid = false;
        }
        if(validateInput(priority,"priority") === true){
            prioritySelector.removeClass("Error");
        }else{
            prioritySelector.addClass("Error");
            valid = false;
        }

        if(valid === true){
            let addIssueUrl ="scripts/system.php?session="+sessionId+"&method=add-issue";
            $.post(addIssueUrl, {
                title:title,
                description:description,
                user:assignedUser,
                type:type,
                priority:priority
                },
                function (data, textStatus, jqXHR) {
                    if(textStatus === "success"){
                        if(data === "done"){
                            titleField.val("");
                            descriptionField.val("");
                            alert("Issues added successfully!");
                        }else{
                            alert("Issue Failed to be added");
                        }
                    }
                }
            );
        }
    });
}

function validateInput(string, type){
    let valid  = false;
    if(type === "text"){
        if(string.length >= 3){
            valid = true;
        }
    }else if(type === "type"){
        let typePattern = /(bug|proposal|task)/g;
        if(string.length > 0){
            if(typePattern.test(string) == true){
                valid = true;
            }
        }
    }else if(type === "priority"){
        let priorityPattern = /(minor|major|critical)/g;
        if(string.length > 0){
            if(priorityPattern.test(string) == true){
                valid = true;
            }
        }
    }else if(type === "email"){
        let emailPattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/i;
        if(string.length >= 3){
            if(emailPattern.test(string) == true){
                valid = true;
            }
        }
    }
    return valid;
}

function fillUsers(user_selector){
    let getUserUrl ="scripts/system.php?session="+sessionId+"&method=allUsers";
    $.get(getUserUrl,
        function (data, textStatus, jqXHR) {
            user_selector.html(data);
        }
    );
}