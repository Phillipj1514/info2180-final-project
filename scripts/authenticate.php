<?php
$host = "localhost";
$username = 'bugme_user';
$password = 'Bugmepassword_1';
$dbname = 'bugme';


function test_input($data){
  $data = trim($data);
  $data = strip_tags($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$userUN = test_input($_POST["email"]);
$userPW = test_input($_POST["password"]);


// if($cities == "cities"){
//   echo "mhm";
// }

// $userUN = "admin@bugme.com";

// $userPW = "password123";

// echo $country;
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$stmt = $conn->prepare("SELECT * FROM Users WHERE email LIKE :email");
$stmt->bindParam(':email',$userUN);
$stmt->execute();
$results = $stmt -> fetchall();

// var_dump($results);

if((sizeof($results)) < 1){
  $response = "User not found";
  echo($response);
}else{
  if (password_verify($userPW,$results[0]["password"])) {
    session_start();
    $_SESSION['user'] = $results[0];
    $response = "valid";
    $usercookie = "".$userUN.",".$results[0]["password"]."";
    setcookie("login", "1", time() + (86400 *1), "/");
    setcookie("user", $usercookie, time() + (86400 *1), "/");
    echo $response;
    // echo 'valid password!'."<br>";
    // echo ("hashed password for admin: $hash");
  } else {
    // Wrong password
    echo 'Invalid password';
  }
}


// foreach($results as $row):
//   if ($row["password"] == $userPW){
    // $response = "valid";
    // echo $response;
//     // echo "valid";
//
//   }
// endforeach; ?>
