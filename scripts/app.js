let mainContent;
let navbar;
let sessionId = "";
$(document).ready(function () {
    mainContent = $(".Main-container");
    navbar = $(".sidenav");
    
    let userCookie = checkLoggedIn();

    if(userCookie != "none"){
        let systemUrl = "scripts/system.php?session=id&user="+userCookie;
        let loggedIn = false;
        // console.log(userCookie);
        $.get(systemUrl,function (data, textStatus) {
            console.log("data "+data+" code "+textStatus);
            if(textStatus === "success"){
                let response = data.split(",");
                if(response[0] == "valid"){
                    sessionId = response[1];
                    // console.log(sessionId);
                    loggedIn = true;
                }
            }
            setView(loggedIn);  
        });
    
    }else{
        navbar.hide();
        mainContent.load('views/login.php');   
        $.getScript( "scripts/login.js", function( data, textStatus, jqxhr ){});
    }
    
});

function checkLoggedIn(){
    let checklog = getCookie("login");
    if(checklog == "1"){
        let user = getCookie('user');
        return user;
    }
    return "none";
}


function setView(loggedIn){
    if(loggedIn === true){
        mainContent.load('views/home.php');
        $.getScript( "scripts/home.js", function( data, textStatus, jqxhr ){});
        navbar.show();
        let navbarlinks =$('.sidenav a');
        navbarlinks.on('click', function () {
            let $this = $(this);
            let attribute = $this.attr("href");
            if(attribute == '#home'){
                mainContent.load('views/home.php');
                $.getScript( "scripts/home.js", function( data, textStatus, jqxhr ){});
            }else if(attribute == '#add-user'){
                mainContent.load('views/addUser.php');
                $.getScript( "scripts/addUser.js", function( data, textStatus, jqxhr ){});
            }else if(attribute == '#new-issue'){
                mainContent.load('views/newIssue.php');
                $.getScript( "scripts/newIssue.js", function( data, textStatus, jqxhr ){});
            }else if(attribute == '#'){
                let logoutUrl = "scripts/system.php?session="+sessionId+"&method=logout";
                navbar.hide();
                mainContent.load('views/login.php');
                $.getScript( "scripts/login.js", function( data, textStatus, jqxhr ){});
                $.get(logoutUrl,
                    function (data, textStatus) {
                        console.log(data);
                        if(textStatus === "success"){
                            if(data === "done"){
                                alert("logout successful");
                            }else{
                                alert("logout unsuccessful");
                            }
                        }else{
                            alert("logout unsuccessful");
                        }
                        
                    }
                );
                // $.getScript("scripts/login.js", function (script, textStatus, jqXHR) {
                //     alert("script loaded");
                // });
            }
        });
    }else{
        navbar.hide();
        mainContent.load('views/login.php');
        $.getScript( "scripts/login.js", function( data, textStatus, jqxhr ){});

    }
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
}

function checkCookie() {
    var username = getCookie("username");
    if (username != "") {
     alert("Welcome again " + username);
    } else {
      username = prompt("Please enter your name:", "");
      if (username != "" && username != null) {
        setCookie("username", username, 365);
      }
    }
}
