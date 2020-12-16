<?php
$q = intval($_GET['q']);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webproject";
// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if ($q == 0) {
    $query = "SELECT username, totalpoints AS Score FROM player ORDER BY totalpoints DESC";
    $i = 0;
    $result = $connection->query($query);
    //print_r($result->fetch_assoc());
    echo "<table>
    <tr>
    <th>Rank</th>
    <th>Player</th>
    <th>Score</th>
    </tr>";
    while ($row = $result->fetch_assoc()) {
        $i = $i + 1;
        $user = $row['username'];
        $query = "SELECT playerID FROM player WHERE username = '$user'";
        $r = $connection->query($query);
        $r = $r->fetch_assoc();
        $id = $r['playerID'];
        echo "<tr>";
        echo getImage($id, $connection, $i);
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['Score'] . "</td>";
        echo "</tr>";
    }
} else {
    $prequery = "SELECT COUNT(*) FROM game WHERE Categories_CategoryID = $q";
    $preres = $connection->query($prequery);
    $re = $preres->fetch_assoc();
    if ($re['COUNT(*)'] > 0) {
        $query = "SELECT Player_playerID, Score FROM game WHERE Categories_CategoryID = $q GROUP BY Player_playerID, Categories_CategoryID ORDER BY Score DESC";
        $result = $connection->query($query);
        $i = 0;
        echo "<table>
    <tr>
    <th>Rank</th>
    <th>Player</th>
    <th>Score</th>
    </tr>";
        while ($row = $result->fetch_assoc()) {
            $i = $i + 1;
            $id = $row['Player_playerID'];
            $qu = "SELECT username FROM player WHERE playerID = $id";
            $r = $connection->query($qu);
            $r = $r->fetch_assoc();
            $user = $r['username'];
            echo "<tr>";
            echo getImage($id, $connection, $i);
            echo "<td>" . $user . "</td>";
            echo "<td>" . $row['Score'] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "No Scores yet. Be the first one to play in this category";
    }
}
echo "</table>";


function getImage($id, $connection, $i)
{
    $query = "SELECT TotalPoints FROM player WHERE playerID = $id";
    $result = $connection->query($query);
    $result = $result->fetch_assoc();
    $result = $result['TotalPoints'];
    if ($result < 1000) {
        $img = "<td><img alt='bronze' src='./image/Ranks/Bronze_icon.png'>$i</td>";
    } else if ($result < 2000) {
        $img = "<td><img alt='silver' src='./image/Ranks/Silver_icon.png'>$i</td>";
    } else if ($result < 3000) {
        $img = "<td><img alt='gold' src='./image/Ranks/Gold_icon.png'>$i</td>";
    } else if ($result < 4000) {
        $img = "<td><img alt='platinum' src='./image/Ranks/Platinum_icon.png'>$i</td>";
    } else if ($result < 5000) {
        $img = "<td><img alt='diamond' src='./image/Ranks/Diamond_icon.png'>$i</td>";
    } else if ($result < 6000) {
        $img = "<td><img alt='champion' src='./image/Ranks/Champion_icon.png'>$i</td>";
    } else {
        $img = "<td><img alt='grand champion' src='./image/Ranks/Grand_Champion_icon.png'>$i</td>";
    }
    return $img;
}
