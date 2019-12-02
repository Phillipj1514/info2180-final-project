<?php
$host = "localhost";
$username = 'root';
$password = 'password';
$dbname = 'bugme';


function test_input($data){
  $data = trim($data);
  $data = strip_tags($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$userUN = test_input($_POST["username"]);
$userPW = test_input($_POST["password"]);


// if($cities == "cities"){
//   echo "mhm";
// }

// $userUN = "admin";
// $userPW = "password123";

// echo $country;
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

$stmt = $conn->query("SELECT * FROM users WHERE firstname LIKE '%$userUN%'");

$results = $stmt -> fetchall(PDO::FETCH_ASSOC);

// var_dump($results);

foreach($results as $row):
  if ($row["password"] == $userPW){
    $response = "valid";
    echo $response;
    // echo "valid";

  }
endforeach; ?>
