<?php
$host = "localhost";
$username = 'root';
$password = '';
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

$stmt = $conn->query("SELECT * FROM users WHERE email LIKE '%$userUN%'");

$results = $stmt -> fetchall(PDO::FETCH_ASSOC);

// var_dump($results);

if((sizeof($results)) < 1){
  $response = "User not found";

  echo($response);

}else{


// $newPass = "password123";


// $hash = password_hash("password123",PASSWORD_DEFAULT);

if (password_verify($userPW,$results[0]["password"])) {
// Correct Password
// echo "Password: $newPass"."<br>";

$response = "valid";
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
