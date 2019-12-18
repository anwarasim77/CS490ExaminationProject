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

if(isset($_POST['qid']) and isset($_POST['examid'])) {
    $qid = $_POST['qid'];
    $examid = $_POST['examid'];

    //use specific database and retrieve respective password
    $s = "use rp583";
    $conn->query($s);


    $p = 0;
    $points = "select * from exam_details where exam_id=".$examid." and exam_qid=".$qid;
    $res_points = $conn->query($points);
    if($res_points->num_rows > 0){
        while($row = $res_points -> fetch_assoc()){
            $p = $row['points'];
        }
    }

    $sql = "select * from question_bank where qid=".$qid;
    $result = $conn->query($sql);

    $count=0;
    $data = new \stdClass();

    if ($result->num_rows > 0) {
        while($row = $result -> fetch_assoc()){
            $data->qid=$row['qid'];
            $data->case1=$row['case1'];
            $data->output1=$row['case1_answer'];
            $data->case2=$row['case2'];
            $data->output2=$row['case2_answer'];
            $data->case3=$row['case3'];
            $data->output3=$row['case3_answer'];
            $data->case4=$row['case4'];
            $data->output4=$row['case4_answer'];
            $data->case5=$row['case5'];
            $data->output5=$row['case5_answer'];
            $data->case6=$row['case6'];
            $data->output6=$row['case6_answer'];
            $data->constraint=$row['keywords'];
            $data->func_name=$row['function_name'];
            $data->points=$p;
        }

    }else{
        $data = array();
        $data->response="no questions";
    }

    $data = json_encode($data);
    echo $data;

}else{
    echo "Post is not set";
    $conn->close();
}

?>
