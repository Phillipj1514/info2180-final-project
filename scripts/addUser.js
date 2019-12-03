main();
function main(){
    let fnameField = $('#firstname');
    let lnameField = $('#lastname');
    let passwordField = $('#password');
    let emailField = $('#email');
    $('#submit').on("click", function (){
        let fname = fnameField.val();
        fnameField.val("");
        let lname = lnameField.val();
        lnameField.val("");
        let password = passwordField.val();
        passwordField.val("");
        let email = emailField.val();
        emailField.val("");
        let valid = true;
        //check inputs
        if(validateInput(fname, "text")== true){
            fnameField.removeClass("Error");
        }else{
            fnameField.addClass("Error");
            valid = false;
        }
        if(validateInput(lname, "text")== true){
            lnameField.removeClass("Error");
        }else{
            lnameField.addClass("Error");
            valid = false;
        }    
        if(validateInput(password, "password")== true){
            passwordField.removeClass("Error");
        }else{
            passwordField.addClass("Error");
            valid = false;
        }    
        if(validateInput(email, "email")== true){
            emailField.removeClass("Error");
        }else{
            emailField.addClass("Error");
            valid = false;
        }
        if(valid == true){
            let addUserUrl ="scripts/system.php?session="+sessionId+"&method=add-user";
            $.post(addUserUrl, {
                fname:fname,
                lname:lname,
                password:password,
                email:email
                },
                function (data, textStatus, jqXHR) {
                    if(textStatus === "success"){
                        console.log(data);
                    }                    
                },
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
    }else if(type === "password"){
        let passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
        if(string.length >= 8){
            if(passwordPattern.test(string) == true){
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