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

if(isset($_POST['task'])) {

    $s = "use rp583";
    $conn->query($s);

    $sql = "SELECT * FROM exams where isgraded = 'false'";
    $result = $conn->query($sql);

    $count = 0;
    if($result->num_rows > 0){
        while($row = $result -> fetch_assoc()){
            $data[$count][0] = $row['id'];
            $data[$count][1] = $row['name'];
            $count++;
        }
    }


    $data = json_encode($data);
    echo $data;
}else{
    echo "Post is not set";
}
$conn->close();
?>
