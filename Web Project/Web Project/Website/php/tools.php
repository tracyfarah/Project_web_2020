<?php

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
function executeQuery($query)
{
    $connection = connectDB();
    $result = $connection->query($query);
    return $result;
}

function selectQuery($query)
{
    $connection = connectDB();
    $result = $connection->query($query);
    $row = $result->fetch_assoc();
    return $row;
}

function getImage($id)
{
    $connection = connectDB();
    $query = "SELECT TotalPoints FROM player WHERE username = '$id'";
    $result = $connection->query($query);
    $result = $result->fetch_assoc();
    $result = $result['TotalPoints'];
    if ($result < 1000) {
        $img = "<img alt='bronze' src='./image/Ranks/Bronze_icon.png'>";
    } else if ($result < 2000) {
        $img = "<img alt='silver' src='./image/Ranks/Silver_icon.png'>";
    } else if ($result < 3000) {
        $img = "<img alt='gold' src='./image/Ranks/Gold_icon.png'>";
    } else if ($result < 4000) {
        $img = "<img alt='platinum' src='./image/Ranks/Platinum_icon.png'>";
    } else if ($result < 5000) {
        $img = "<img alt='diamond' src='./image/Ranks/Diamond_icon.png'>";
    } else if ($result < 6000) {
        $img = "<img alt='champion' src='./image/Ranks/Champion_icon.png'>";
    } else {
        $img = "<img alt='grand champion' src='./image/Ranks/Grand_Champion_icon.png'>";
    }
    return $img;
}

function getRank($id)
{
    $connection = connectDB();
    $query = "SELECT TotalPoints FROM player WHERE username = '$id'";
    $result = $connection->query($query);
    $result = $result->fetch_assoc();
    $result = $result['TotalPoints'];
    if ($result < 1000) {
        $img = "Uncultured Swine";
    } else if ($result < 2000) {
        $img = "Average";
    } else if ($result < 3000) {
        $img = "Interesting in parties";
    } else if ($result < 4000) {
        $img = "Cultured";
    } else if ($result < 5000) {
        $img = "Genius";
    } else if ($result < 6000) {
        $img = "Mastermind ";
    } else {
        $img = "Legendary";
    }
    return $img;
}

function getNumber($username)
{
    $connection = connectDB();
    $query = "SELECT username FROM player ORDER BY totalpoints DESC";
    $i = 0;
    $result = $connection->query($query);
    while ($row = $result->fetch_assoc()) {
        $i = $i + 1;
        if ($row['username'] == $username) {
            return $i;
        }
    }
}

function getCat($username)
{
    $connection = connectDB();
    $query1 = "SELECT playerID FROM player WHERE username = '$username'";
    $result1 = $connection->query($query1);
    $row1 = $result1->fetch_assoc();
    $row1val = $row1['playerID'];
    $query = "SELECT Categories_CategoryID FROM game WHERE Player_playerID = '$row1val' GROUP BY Categories_CategoryID, player_playerID ORDER BY Score DESC LIMIT 1";
    $result2 = $connection->query($query);
    $row2 = $result2->fetch_assoc();
    $row2val = $row2['Categories_CategoryID'];
    $query3 = "SELECT Category FROM categories WHERE CategoryID = $row2val";
    $result3 = $connection->query($query3);
    $row3 = $result3->fetch_assoc();
    return $row3['Category'];
}
