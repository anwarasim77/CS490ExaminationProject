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

if(isset($_POST['examid'])) {

    $id = $_POST['examid'];

    $s = "use rp583";
    $conn->query($s);

    $sql = "update exams set isgraded='true' where id=".$id;
    $result = $conn->query($sql);

    echo "Updated examid=".$id." to true";
}else{
    echo "Post is not set";
}
$conn->close();
?>
