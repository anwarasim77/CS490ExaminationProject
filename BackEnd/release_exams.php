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

if(isset($_POST['examname']) and isset($_POST['examid'])) {
    $name = $_POST['examname'];
    $examid = $_POST['examid'];

    $s = "use rp583";
    $conn->query($s);

    //mark 0's for students who didn't take exam

    $sql = "select * from exam_details where exam_name='".$name."' and exam_id=".$examid;
    $result = $conn->query($sql);

    $count = 0;
    if($result->num_rows > 0){
        while($row = $result -> fetch_assoc()){
           $qs[$count++] = $row['exam_qid'];
        }
    }

    //qs holds all the question numbers for the specified exam
    $sql = "select userName from beta where not exists(select * from answers where answers.ucid=beta.userName and answers.examid=".$examid.") and role='student'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        while($row = $result -> fetch_assoc()){
            $ucid = $row['userName'];
            for($i=0; i<count($qs); $i++){
                $zeroes = "insert into answers values('".$ucid."', '".$examid."', '".$qs[$i]."', '', '0', '0', '0', '0', 0)";
                $resp = $conn->query($zeroes);
            }
        }
    }

    $sql = "select * from answers where examid=".$examid;
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $grades = array();
        while($row = $result->fetch_assoc()){
            if(in_array($row['ucid'], $grades)){
                $grades[$row['ucid']]=$row['points'];
            }else{
                $grades[$row['ucid']] += $row['points'];
            }

        }
    }

    $data = json_encode($grades);
    echo $data;
}else{
    echo "Post is not set";
}
$conn->close();
?>
