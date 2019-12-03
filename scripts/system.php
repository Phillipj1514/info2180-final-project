<?php
session_start();
$host = "localhost";
$username = 'bugme_user';
$password = 'Bugmepassword_1';
$dbname = 'bugme';
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);


if($_SERVER['REQUEST_METHOD'] == "GET"){
    switch($_REQUEST['session']){
        case 'id':
            $userInfo = explode(",",$_REQUEST['user']);
            $stmt = $conn->prepare("SELECT * FROM Users WHERE email LIKE :email");
            $stmt->bindParam(':email',$userInfo[0]);
            $stmt->execute();
            $results = $stmt -> fetchall();
            if(count($results)> 0){
                if($userInfo[1] == $results[0]["password"]){
                    $_SESSION['user'] = $results[0];
                    echo("valid,".session_id().",");
                }else{echo("invalid");}
            }else{echo("invalid");}
            break;
        case session_id():
            switch($_REQUEST['method']){
                case "logout":
                    setcookie("login", "", time() - (86400 *1), "/");
                    setcookie("user", "", time() - (86400 *1), "/");
                    session_destroy();
                    echo "done";
                    break;
                default:
                    echo"invalid";
            }
            break;
        default:
            echo"invalid";
    }
}elseif($_SERVER['REQUEST_METHOD'] == "POST"){
    switch($_REQUEST['session']){
        case session_id():
            switch($_REQUEST['method']){
                case "add-user":
                    echo addUser($conn);
                    break; 
                default:
                    echo"invalid";
            }
            break;
        default:
            echo"invalid";
    }
}

function addUser($conn){
    $fname = filter_var(htmlspecialchars($_REQUEST['fname']), FILTER_SANITIZE_STRING);
    $lname = filter_var(htmlspecialchars($_REQUEST['lname']), FILTER_SANITIZE_STRING);
    $email = filter_var(htmlspecialchars($_REQUEST['email']), FILTER_SANITIZE_EMAIL);
    $password = filter_var(htmlspecialchars($_REQUEST['password']), FILTER_SANITIZE_STRING);
    $valid = True;
    if(validateInput($fname,"text") == FALSE){
        $valid = FALSE;
    }
    if(validateInput($lname,"text") == FALSE){
        $valid = FALSE;
    }
    if(validateInput($email,"email") == FALSE){
        $valid = FALSE;
    }
    if(validateInput($password,"password") == FALSE){
        $valid = FALSE;
    }
    if($valid == TRUE){
        $check_available = $conn->prepare("SELECT * FROM Users WHERE email LIKE :email");
        $check_available->bindParam(":email", $email);
        $check_available->execute();
        $results = $check_available-> fetchall();
        if(count($results)<= 0){
            $request = $conn->prepare("INSERT INTO Users (firstname,lastname,email,password) 
            VALUES(:fname, :lname, :email, :password)");
            $request->bindParam(":fname", $fname);
            $request->bindParam(":lname", $lname);
            $request->bindParam(":email", $email);
            $request->bindParam(":password", password_hash($password, PASSWORD_DEFAULT));
            $request->execute();
            return "done";
        }else{
            return "none";
        }
    }

}

function validateInput($string, $type){
    $valid  = FALSE;
    if($type == "text"){
        if(strlen($string) >= 3){
            $valid = TRUE;
        }
    }else if($type == "password"){
        $passwordPattern ="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/";
        if(strlen($string) >= 8){
            if(preg_match($passwordPattern,$string)){
                $valid = TRUE;
            }
        }
    }else if($type == "email"){
        $emailPattern = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
        if(strlen($string) >= 3){
            if(preg_match($emailPattern,$string)){
                $valid = TRUE;
            }
        }
    }
    return $valid;
}