window.onload = function(){
  var valid = 0;
  var button = document.getElementById("submit");
  button.addEventListener("click", function(){
    valid = 0;
    let url = "scripts/login.php";
    // alert("mhm");


    let email = document.getElementById("email").value;



    let password = document.getElementById("password").value;

    clearInput("email");
    clearInput("password");

    isEmpty("email",email);
    isValidEmail("email",email);
    isEmpty("password",password);

    if (valid == 0){
    console.log("hello");
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
      if(this.readyState === this.DONE && this.status === 200){
        let result = this.responseText;

        console.log(result);

        // console.log(result === "valid");

        if (result === "valid"){
          alert("vaild user");
          location.assign("./index.html");
        }else if(result == "User not found"){
          alert("invalid user");
          document.getElementById("email").classList.add("Error");
        }
        else{
          alert("not valid user or password");
          document.getElementById("email").classList.add("Error");
          document.getElementById("password").classList.add("Error");
        }
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



}
