<?php
require("./php/logindb.php");
$connection = connectDB();
if (isset($_COOKIE['cookie_username_project'])) {
  session_start();
  $_SESSION['username'] = $_COOKIE['cookie_username_project'];
  header("Location: ./home.php");
  exit;
}
?>
<html>

<head>
  <link href="css/style.css" rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Gugi&display=swap" rel="stylesheet">
</head>

<body>
  <div class="form">
    <ul class="tab-group">
      <li class="tab active">
        <a href="#signup">Sign Up</a>
      </li>
      <li class="tab"><a href="#login">Log In</a></li>
    </ul>

    <div class="tab-content">
      <div id="signup">
        <h1>Sign Up for Free</h1>
        <form method="post">


          <div class="field-wrap">
            <input type="text" name="txt_username" id="txt_username" placeholder="Username*" required />
          </div>


          <div class="field-wrap">
            <input name="txt_email" id="txt_email" placeholder="Email Address*" />
          </div>

          <div class="field-wrap">
            <input type="password" name="txt_password" id="txt_password" placeholder="Password*" required />
          </div>

          <div class="field-wrap">
            <input type="password" name="txt_ccpassword" id="txt_ccpassword" placeholder="Confirm Password*" required />
          </div>
          <input id="bt_signup" type="submit" class="button button-block" value="Create Account" />
        </form>
      </div>

      <div id="login">
        <h1>Welcome Back!</h1>

        <form method="get">
          <div class="field-wrap">
            <input name="signin_username" id="signin_username" placeholder="Email Address*" required />
          </div>

          <div class="field-wrap">
            <input type="password" name="signin_password" id="signin_password" placeholder="Password*" required />
          </div>

          <input id="bt_signin" type="submit" class="button button-block" value="Log in" />
        </form>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js "></script>
  <script src="./js/index.js"></script>
</body>

</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $result = addUser($connection, $_POST["txt_password"], $_POST["txt_ccpassword"], $_POST["txt_username"], $_POST["txt_email"]);
  if ($result == -1) {
    echo "<script>alert('User Already Exists')</script>";
  } else if ($result == -2) {
    echo "<script>alert('Passwords do not match')</script>";
  } else if ($result == 1) {
    session_start();
    setcookie("cookie_username_project", $_POST["txt_username"], time() + (86400 * 7), "/");
    $_SESSION['username'] = $_POST["txt_username"];
    $user = $_SESSION['username'];
    $id = executeQuery($connection, "SELECT playerID FROM player WHERE username = '$user'");
    $id = $id->fetch_assoc();
    $id = $id['playerID'];
    setcookie("cookie_playerID", $id, time() + (3600), "/");
    header("Location: ./home.php");
  }
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["signin_username"])) {
  $result = signInUser($connection, $_GET["signin_username"], $_GET["signin_password"]);

  if ($result == -1) {
    echo "<script>alert('Wrong password')</script>";
  } else if ($result == -2) {
    echo "<script>alert('User Does Not Exists')</script>";
  } else if ($result == 1) {
    session_start();


    $email = $_GET["signin_username"];
    $id = selectQuery($connection, "SELECT playerID FROM player WHERE email = '$email'");
    $user = selectQuery($connection, "SELECT username FROM player WHERE email = '$email'");
    $_SESSION['username'] = $user[0]['username'];
    setcookie("cookie_username_project", $_SESSION['username'], time() + (3600), "/");
    $id = $id[0]['playerID'];
    setcookie("cookie_playerID", $id, time() + (3600), "/");
    header("Location: ./home.php");
  }
}
?>