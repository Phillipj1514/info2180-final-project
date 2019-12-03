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
                case "allUsers":
                    echo getUserSelectors($conn);
                    break;
                case "getAllIssues":
                    echo getIssues("all",$conn);
                    break;
                case "getOpenIssues":
                    echo getIssues("open",$conn);
                    break;
                case "getUserIssues":
                    echo getIssues("user",$conn);
                    break;
                case "issue":
                    $id = $_REQUEST['id'];
                    echo getIssue($id,$conn);
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
                case "add-issue":
                    echo addIssue($conn);
                    break;
                case "issue":
                    $option=$_REQUEST['status'];
                    $id = $_REQUEST['id'];
                    echo updateIssueStatus($id,$option, $conn);
                    break;
                default:
                    echo"invalid";
            }
            break;
        default:
            echo"invalid";
    }
}
function updateIssueStatus($id, $option, $conn){
    $status = "";
    if($option == "closed"){$status = "Closed";}
    elseif($option == "progress"){$status = "In Progress";}
    else{return "invalid";}
    $request = $conn->prepare("UPDATE Issues SET status=:status, updated=NOW() WHERE id=:id");
    $request->bindParam(":status",$status);
    $request->bindParam(":id",$id);
    $request->execute();
    return "done";

}

function getIssue($id, $conn){
    $request = $conn->prepare("SELECT * FROM Issues WHERE id LIKE :id");
    $request->bindParam(":id", $id);
    $request->execute();
    $results = $request-> fetchall();
    if(count($results) >0){
        $issue = $results[0];
        $user = getUser($issue['assigned_to'],$conn);
        if($user != "none"){
            $issue['assigned_to'] = "".$user['firstname']." ".$user['lastname']; 
        }
        return json_encode($issue);
    }
    return "none";
}

function getIssues($critera,$conn){
    $request = $conn->prepare("SELECT * FROM Issues");
    $request->execute();
    $results = $request->fetchall();
    $issues ="";
    if(count($results)>0){
        $add = FALSE;
        foreach($results as $issue){
            if($critera == "all"){
                $add = TRUE;
            }else if ($critera == "open"){
                if($issue['status'] == "Open"){
                    $add = True;
                }else{$add = FALSE;}    
            }else if($critera == "user"){
                if($issue['assigned_to'] == $_SESSION['user']['id']){
                    $add = TRUE;
                }else{
                    $add= FALSE;
                }
            }
            if($add){
                $user = getUser($issue['assigned_to'], $conn);
                $issues.='<tr>
                <td class="tTitle"> <p class="title-num">#'.$issue['id'].'</p><p class="title-text" onclick="viewIssue('.$issue['id'].')">'.$issue['title'].'</p></td>
                <td class="tType">'.$issue['type'].'</td>
                <td class="tStatus">'.$issue['status'].'</td>
                <td class="tassign">'.$user['firstname'].' '.$user['lastname'].'</td>
                <td class="tcreate">'.$issue['created'].'</td>
                </tr>';
            }
            
        }
        return $issues;
    }
    return "invalid";
}

function addIssue($conn){
    $title = filter_var(htmlspecialchars($_REQUEST['title']), FILTER_SANITIZE_STRING);
    $description = filter_var(htmlspecialchars($_REQUEST['description']), FILTER_SANITIZE_STRING);
    $assignedUser = filter_var(htmlspecialchars($_REQUEST['user']), FILTER_SANITIZE_STRING);
    $type = filter_var(htmlspecialchars($_REQUEST['type']), FILTER_SANITIZE_STRING);
    $priority = filter_var(htmlspecialchars($_REQUEST['priority']), FILTER_SANITIZE_STRING);
    $valid = TRUE;
    $valid =validateInput($title,"text");
    $valid =validateInput($description,"text");
    $valid =validateInput($assignedUser,"email");
    $valid =validateInput($type,"type");
    $valid =validateInput($priority,"priority");
    if($valid){
        $userId = getUserId($assignedUser, $conn);
        if($userId > 0){
            $status ="Open";
            $request = $conn->prepare("INSERT INTO Issues(title, description, type, priority, status, assigned_to, created_by, updated) 
            VALUES(:title, :desc, :type, :priority, :status, :assign, :create_user, NOW())");
            $request->bindParam(":title",$title);
            $request->bindParam(":desc",$description);
            $request->bindParam(":type",$type);
            $request->bindParam(":priority",$priority);
            $request->bindParam(":status",$status);
            $request->bindParam(":assign",$userId);
            $request->bindParam(":create_user",$_SESSION['user']['id']);
            $request->execute();
            return "done";
        } 
    }
    return "invalid";
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

function getUserSelectors($conn){
    $options ='';
    $request = $conn->prepare("SELECT * FROM Users");
    $request->execute();
    $results = $request-> fetchall();
    //print_r($results);
    if(count($results)>0){
        foreach($results as $user){
            $options.='<option value="'.$user['email'].'">'.$user['firstname'].' '.$user['lastname'].'</option>';
        }
        return $options;
    }
    return'<option value="none">none</option>';
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
    }else if($type === "type"){
        $typePattern = "/(bug|proposal|task)/";
        if(strlen($string) > 0){
            if(preg_match($typePattern,$string)){
                $valid = true;
            }
        }
    }else if($type === "priority"){
        $priorityPattern = "/(minor|major|critical)/";
        if(strlen($string) > 0){
            if(preg_match($priorityPattern,$string)){
                $valid = true;
            }
        }
    }
    return $valid;
}

function getUserId($email, $conn){
    $check_available = $conn->prepare("SELECT * FROM Users WHERE email LIKE :email");
    $check_available->bindParam(":email", $email);
    $check_available->execute();
    $results = $check_available-> fetchall();
    if(count($results) >0){
        $id = $results[0]['id'];
        return $id;
    }
    return -1;
}

function getUser($id, $conn){
    $request = $conn->prepare("SELECT * FROM Users WHERE id LIKE :id");
    $request->bindParam(":id", $id);
    $request->execute();
    $results = $request-> fetchall();
    if(count($results) >0){
        $user = $results[0];
        return $user;
    }
    return "none";
}
