<!DOCTYPE html>
<?php
ob_start();
require("./php/tools.php");
session_start();
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="css/home.css">

    </script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Gugi&display=swap" rel="stylesheet" />


    <style>
        .textsecondary {
            color: black;
        }

        body {
            background-image: url('./image/userpro.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            font-family: "Gugi", cursive;
        }

        .logout:hover {
            background-color: rgb(153, 37, 147);
            color: white;
            transform: scale(1.023);
        }

        .logout {
            color: white;
            background-color: rgb(153, 37, 147);
            border-radius: 15px;
            margin-left: 25%;
            margin-right: 25%;
            width: 50%;
        }
    </style>
    <script>
        $(document).ready(function() {
            $("#logout").on("click", function() {
                $("#reset_cookies").click();
            })
        });
    </script>
</head>

<body>
    <br>
    <nav style="margin-left: 30%;">
        <ul class="menu-bar">
            <a href="./home.php">
                <li>Home</li>
            </a>
            <a href="./discord.html">
                <li>Discord</li>
            </a>
            <a href="./leaderboard.html">
                <li>Leaderboard</li>
            </a>
            <a href="./profile.php">
                <li class="currentpage">Profile</li>
            </a>
        </ul>
    </nav>

    <br>
    <br>

    <div class="container">
        <div class="main-body">
            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card" style="background-color: #bd61e2ad;">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <?php
                                echo getImage($_SESSION['username']);
                                ?>
                                <div class="mt-3">
                                    <h4 id="username">
                                        <?php echo '@';
                                        echo $_SESSION['username'];
                                        ?></h4>
                                    <br>
                                    <br>
                                </div>

                            </div>
                            <hr>

                            <button id="logout" class="logout">Logout</button>

                        </div>

                    </div>

                </div>
                <div class="col-md-8">
                    <div class="card mb-3 " style="background-color: #bd61e2ad; ">
                        <div class="card-body ">
                            <hr>
                            <div class="row ">
                                <div class="col-sm-5 ">
                                    <h6 class="mb-0 ">Email</h6>
                                </div>
                                <div id="email " class="col-sm-9 textsecondary ">
                                    <?php $user = $_SESSION['username'];
                                    $email = selectQuery("SELECT email FROM player WHERE username = '$user'");
                                    echo $email['email']; ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row ">
                                <div class="col-sm-5 ">
                                    <h6 class="mb-0 ">Rank</h6>
                                </div>
                                <div id="rank " class="col-sm-9 textsecondary ">
                                    <?php echo getRank($user);
                                    ?>
                                </div>

                            </div>
                            <hr>
                            <div class="row ">
                                <div class="col-sm-5 ">
                                    <h6 class="mb-0 ">Rank Number</h6>
                                </div>
                                <div id="rankn " class="col-sm-9 textsecondary ">
                                    <?php echo getNumber($user);
                                    ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row ">
                                <div class="col-sm-5 ">
                                    <h6 class="mb-0 ">Total Points</h6>
                                </div>
                                <div id="points " class="col-sm-9 textsecondary ">
                                    <?php $p = selectQuery("SELECT totalpoints FROM player WHERE username = '$user'");
                                    echo $p['totalpoints'];
                                    ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row ">
                                <div class="col-sm-5 ">
                                    <h6 class="mb-0 ">Best Category</h6>
                                </div>
                                <div id="bestCategory " class="col-sm-9 textsecondary ">
                                    <?php
                                    if (getCat($user) != null || getCat($user) != "") {
                                        echo getCat($user);
                                    }
                                    ?>
                                </div>
                            </div>
                            <hr>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <form method="post" hidden>
        <input type="submit" id="reset_cookies" hidden>
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js "></script>

</body>

</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    clearCookies();
    header("Location: ./login.php");
}
ob_flush();
function clearCookies()
{
    foreach ($_COOKIE as $key => $value) {
        SETCOOKIE($key, $value, TIME() - 10000, "/",);
    }
    session_destroy();
}
