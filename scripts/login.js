main();
function main(){
  let valid;
  var button = document.getElementById("submit");
  button.addEventListener("click", function(){
    valid = 0;
    let url = "scripts/authenticate.php";

    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;

    clearInput("email");
    clearInput("password");

    isEmpty("email",email);
    isValidEmail("email",email);
    isEmpty("password",password);

    if (valid == 0){
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
      if(this.readyState === this.DONE && this.status === 200){
        let result = this.responseText;
        console.log(result);
        processResult(result);        
      }
    };

    xhttp.open("POST",url);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("email=" + email + "&password=" + password);
  }

  });
  function clearInput(name){
    document.getElementById(name).classList.remove("Error");
  }
  
  
  function isEmpty(name,value){
      if (value == ""){
          document.getElementById(name).classList.add("Error");
          valid = -1;
      }
  }
  
  function isValidEmail(name,value){
    var validPattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/i;
    if ((validPattern.test(value)) == false){
      document.getElementById(name).classList.add("Error");
      valid = -1;
    }
  }
  function processResult(result){
    if (result === "valid"){
      //alert("vaild user");
      navbar.show();
      mainContent.load('views/home.php');
      $.getScript( "scripts/home.js", function( data, textStatus, jqxhr ){});
    }else if(result == "User not found"){
      alert("invalid Credentials");
      document.getElementById("email").classList.add("Error");
    }
    else{
      alert("Invalid Email or Password");
      document.getElementById("email").classList.add("Error");
      document.getElementById("password").classList.add("Error");
    }
  }
}
