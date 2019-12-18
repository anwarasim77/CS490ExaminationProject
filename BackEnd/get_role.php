<?php
session_start();
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
if(isset($_POST['username'], $_POST['password'])) {
    $username = $_POST['username'];
    $_SESSION['username'] = $username;
    $password = $_POST['password'];
    //use specific database and retrieve respective password
    $s = "use rp583";
    $conn->query($s);
    $sql = "SELECT * FROM beta where userName='".$username."'";
    $result = $conn->query($sql);
    $data = new \stdClass();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $uName = $row["userName"];
        $pwd = $row["password"]; //password stored in database
        //if hashed password stored in database is equal to hashed password entered by user
        if(password_verify($password, $pwd)){
            $data->response=$row["role"];
        } else{
            $data->response="Invalid username/password";
        }
    }else{
        $data->response="Invalid login";
    }
    $data = json_encode($data);
    echo $data;
}else{
    echo "Post is not set";
}
$conn->close();
?>
