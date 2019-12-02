$(document).ready(function () {
    let mainContent = $(".Main-container");
    let navbar = $(".sidenav");
    if(loggedin() === true){
        mainContent.load('views/main.php');
        navbar.show();
        let navbarlinks =$('.sidenav a');
        navbarlinks.on('click', function () {
            let $this = $(this);
            let attribute = $this.attr("href");
            alert("clickced");
            if(attribute == '#home'){
                mainContent.load('views/home.php');
            }else if(attribute == '#add-user'){
                mainContent.load('views/main.php');
            }else if(attribute == '#new-issue'){
                mainContent.load('views/newIssue.php');
            }else if(attribute == '#logout'){
                navbar.hide();
                mainContent.load('views/login.php');
            }
        });

    }else{
        mainContent.load('views/login.php');
    }
});

function loggedin(){
    return true;
}
