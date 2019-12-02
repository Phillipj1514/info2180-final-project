window.onload = function(){
  var button = document.getElementById("submit");
  button.addEventListener("click", function(){
    let url = "login.php";
    let username = document.getElementById("Username").value;
    let password = document.getElementById("Password").value;

    console.log("hello");
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
      if(this.readyState === this.DONE && this.status === 200){
        let result = this.responseText;

        console.log(result);

        // console.log(result === "valid");

        if (result === "valid"){
          alert("vaild user");
          location.assign("index.html");
        }else{
          alert("not valid");
        }
      }
    };

    xhttp.open("POST",url);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("username=" + username + "&password=" + password);


  });



}
