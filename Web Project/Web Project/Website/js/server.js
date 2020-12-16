let express = require("express");
let app = express();
let mysql = require("mysql");
let bodyParser = require("body-parser");

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: false }));

app.use(function (req, res, next) {
  res.header("Access-Control-Allow-Origin", "*"); // update to match the domain you will make the request from
  res.header(
    "Access-Control-Allow-Headers",
    "Origin, X-Requested-With, Content-Type, Accept"
  );
  next();
});

var con = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "webproject",
});

con.connect(function (err) {
  if (err) throw err;
  console.log("Connected!");
});

app.post("/", function (req, res) {
  var sql =
    "INSERT INTO `game`(`Score`, `Player_playerID`, `Categories_CategoryID`) VALUES (" +
    req.body.score +
    ", " +
    req.body.id +
    ", " +
    req.body.cat +
    ")";
  var sql2 =
    "UPDATE `player` SET `Totalpoints`= `Totalpoints` + " +
    req.body.score +
    " WHERE playerID =" +
    req.body.id;
  con.query(sql2, function (err, result) {
    if (err) throw err;
  });
  con.query(sql, function (err, result) {
    if (err) throw err;
    console.log("1 record inserted");
  });
});

let server = app.listen(8081, function () {
  let host = server.address().address;
  let port = server.address().port;
  console.log(host + ": " + port);
});
