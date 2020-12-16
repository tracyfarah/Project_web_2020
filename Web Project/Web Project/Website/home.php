<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: ./login.php");
}
?>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="css/home.css" />
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Gugi&display=swap" rel="stylesheet">
  <title>Document</title>
  <style></style>
</head>

<body>
  <div style="margin-left: 30%">
    <ul class="menu-bar">
      <a href="./home.php">
        <li class="currentpage">Home</li>
      </a>
      <a href="./discord.html">
        <li>Discord</li>
      </a>
      <a href="./leaderboard.html">
        <li>Leaderboard</li>
      </a>
      <a href="./profile.php">
        <li>Profile</li>
      </a>
    </ul>
  </div>
  <br>
  <br>
  <br>
  <br>


  <div class="trans2">
    <table>
      <tr>
        <td>
          <p class="txt">
            Hello, <span id="user">
              <?php
              print_r($_SESSION['username']);
              ?>
            </span>
          </p>
          <p class="txt">Are you ready to play?</p>
        </td>
      </tr>
      <tr>
        <td>
          <a href="./category.php">
            <button class="browse" style="font-family: Gugi, cursive;">Start</button></a>
        </td>
        <td></td>
      </tr>
    </table>
  </div>
</body>

</html>