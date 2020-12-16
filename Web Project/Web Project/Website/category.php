<html>

<head>
  <link href="css/quizstyle.css" rel="stylesheet" />

  <link href="https://fonts.googleapis.com/css2?family=Gugi&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: "Gugi", cursive;
    }
  </style>
</head>

<body>
  <?php
  $id = $_COOKIE['cookie_playerID'];
  echo "<input type='hidden' id='playerID' value='$id'>";
  ?>
  <div id="frame" class="container">
    <h2>Choose a Category</h2>
    <input type="button" class="btn bt_cat hover" value="General Knowledge" />
    <input type="button" class="btn bt_cat hover" value="Entertainement: Film" />
    <input type="button" class="btn bt_cat hover" value="Entertainement: Music" />
    <input type="button" class="btn bt_cat hover" value="Entertainement: Video Games" />
    <input type="button" class="btn bt_cat hover" value="Science and Nature" />
    <input type="button" class="btn bt_cat hover" value="Mythology" />
    <input type="button" class="btn bt_cat hover" value="Sports" />
    <input type="button" class="btn bt_cat hover" value="Geography" />
    <input type="button" class="btn bt_cat hover" value="History" />
    <input type="button" class="btn bt_cat hover" value="Animals" />
    <input type="button" class="btn" id="bt_go" value="Go" />
  </div>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js "></script>
  <script src="./js/category.js"></script>
</body>

</html>