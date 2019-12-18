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

    $examid = $_POST['examid'];

    $s = "use rp583";
    $conn->query($s);

    $sql = "select distinct(ucid) as ucid from answers where examid=".$examid;
    //echo $sql;
    $result = $conn->query($sql);
    $count = 0;
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $data[$count] = $row['ucid'];
            $count++;
        }

    } else{
        $data = array();
        $data->response="nothing retrieved";
    }

    $data = json_encode($data);
    echo $data;

}else{
    echo "Post is not set";
}
$conn->close();
?>
