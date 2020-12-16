<html>

<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
  <link rel="stylesheet" href="./css/quizstyle.css" />
  <link rel="https://cdn.rawgit.com/mfd/f3d96ec7f0e8f034cc22ea73b3797b59/raw/856f1dbb8d807aabceb80b6d4f94b464df461b3e/gotham.css" />
  <link href="https://fonts.googleapis.com/css2?family=Gugi&display=swap" rel="stylesheet">
</head>

<body>

  <div id="loader">
    <img src="./image/loading.gif" width="50px" height="50px" /><br /><br />
    <h6>Loading...</h6>
  </div>
  <div id="frame" class="container" hidden>
    <h1>Quiz Title</h1>
    <h2>
      Category:
      <span id="category" style="font-weight: bold"></span>
    </h2>
    <p class="pager" id="quest_number">
      Question <span></span> of 10
    </p>
    <button id="joker">Skip</button>
    <p id="left">Left: <span id="skips_left">3</span></p>
    <h6 id="diff" style="font-style: italic">
      Difficulty:
      <span style="font-style: italic; font-weight: bold"></span>
    </h6>
    <h2 id="question"></h2>
    <div id="choices"></div>
    <div class="btn" id="bt_submit">Check Answer</div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js "></script>
  <script src="./js/quiz.js"></script>
</body>

</html>