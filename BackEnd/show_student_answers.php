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

if(isset($_POST['username']) and isset($_POST['examid'])) {
    $name = $_POST['username'];
    $examid = $_POST['examid'];

    $s = "use rp583";
    $conn->query($s);

    //mark 0's for students who didn't take exam

    $sql = "select ucid, examid, answers.qid, answer, question, answers.case1, answers.case2, answers.keyword, answers.function_name, answers.points from question_bank, answers where question_bank.qid=answers.qid and examid=".$examid." and answers.ucid='".$name."'";
    //echo $sql;
    $result = $conn->query($sql);

    $count = 0;
    if($result->num_rows > 0){
        while($row = $result -> fetch_assoc()){

            $data[$count][0] = $row['ucid'];
            $data[$count][1] = $row['examid'];
            $data[$count][2] = $row['qid'];
            $data[$count][3] = $row['answer'];
            $data[$count][4] = $row['question'];
            $data[$count][5] = $row['case1'];
            $data[$count][6] = $row['case2'];
            $data[$count][7] = $row['keyword'];
            $data[$count][8] = $row['function_name'];
            $data[$count][9] = $row['points'];


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
