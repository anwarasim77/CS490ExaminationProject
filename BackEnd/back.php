<?php
//header("Content-Type: application/json");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//make SQL connection
$servername = "sql.njit.edu";
$username = "rp583";
$password = "";
$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error."<br>\n");
}
//take ucid and password from POST rquest if set and check it in database
if(isset($_POST['ucid'], $_POST['pass'])) {
    $ucid = $_POST['ucid'];
    $password = $_POST['pass'];
    //use specific database and retrieve respective password
    $s = "use rp583";
    $conn->query($s);
    $sql = "SELECT * FROM beta where userName='".$ucid."'";
    $result = $conn->query($sql);
    $data = new \stdClass();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $uName = $row["userName"];
        $pwd = $row["password"]; //password stored in database
        //if hashed password stored in database is equal to hashed password entered by user
        if(password_verify($password, $pwd)){
            $data->response="Good on our backend";
        } else{
            $data->response="Bad on our backend";
        }
    }else{
        $data->response="Bad on our backend";
    }
    $data = json_encode($data);
    echo $data;
}else{
    echo "Post is not set";
}
$conn->close();
?>
