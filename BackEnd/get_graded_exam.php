<?php
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

//get_graded_exam.php
if(isset($_POST['task'])) {

    $s = "use rp583";
    $conn->query($s);

    $s = "SELECT * FROM exams where isgraded='true'";
    $result = $conn->query($s);

    $count=0;
    if($result->num_rows > 0){
        while($row = $result -> fetch_assoc()){
            $data[$count][0] = $row['id'];
            $data[$count][1] = $row['name'];
            $count++;
        }
    }else{
        $data = "did not find graded exams";
    }

    $data = json_encode($data);
    echo $data;
    $conn->close();

}else{
    echo "post is not set";
    $conn->close();
}


?>
