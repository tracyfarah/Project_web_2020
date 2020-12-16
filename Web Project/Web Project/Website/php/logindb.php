<?php
$fname = "";
$lname = "";
$email = "";
$password = "";
$cpassword = "";

function connectDB()
{
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "webproject";
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  return $conn;
}
function addUser($connection, $password, $ccpassword, $username, $email)
{
  if (userExists($connection, $username, $email)) {
    return -1;
  }
  if (!checkPasswordMatch($password, $ccpassword)) {
    return -2;
  }
  $hashedPassword = md5($password);

  executeQuery($connection, "INSERT INTO player (username,password,email) VALUES ('$username','$hashedPassword','$email')");
  return 1;
}
function userExists($connection, $email)
{
  $result = selectQuery($connection, "SELECT * FROM player WHERE email='$email'");
  return count($result) > 0;
}
function checkPasswordMatch($password, $ccpassword)
{
  return ($password == $ccpassword);
}
function passwordMatches($connection, $email, $password)
{
  $result = selectQuery($connection, "SELECT password FROM player WHERE email='$email'");
  return $result[0]["password"] == md5($password);
}
function signInUser($connection, $email, $password)
{
  echo "<script>console.log('hi i am here')</script>";
  if (userExists($connection, $email)) {
    if (passwordMatches($connection, $email, $password)) {
      return 1;
    }
    return -1;
  }
  return -2;
}
function executeQuery($connection, $query)
{
  $result = $connection->query($query);
  return $result;
}
function selectQuery($connection, $query)
{
  $result = $connection->query($query);

  $multiArray = array();
  while ($row = $result->fetch_assoc()) {
    array_push($multiArray, $row);
  }
  return $multiArray;
}
