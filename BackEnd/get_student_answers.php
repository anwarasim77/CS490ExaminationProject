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

if(isset($_POST['username']) and isset($_POST['examid'])) {
    $name = $_POST['username'];
    $examid = $_POST['examid'];

    $s = "use rp583";
    $conn->query($s);

    //mark 0's for students who didn't take exam

    $sql = "select ucid, examid, answers.qid, answer, question, answers.a1, answers.a2, answers.a3, answers.a4, answers.a5, answers.a6, answers.case1, answers.case2, answers.case3, answers.case4, answers.case5, answers.case6, answers.keyword, answers.function_name, answers.comments, answers.colon, question_bank.case3 as tc3, question_bank.case4 as tc4, question_bank.case5 as tc5, question_bank.case6 as tc6, question_bank.case1_answer as c1a, question_bank.case2_answer as c2a, question_bank.case3_answer as c3a, question_bank.case4_answer as c4a, question_bank.case5_answer as c5a, question_bank.case6_answer as c6a from question_bank, answers where question_bank.qid=answers.qid and examid=".$examid." and answers.ucid='".$name."'";
    //echo $sql;
    $result = $conn->query($sql);

    $count = 0;
    if($result->num_rows > 0){
        while($row = $result -> fetch_assoc()){

            $question1 = "select points from exam_details where exam_id=".$examid." and exam_qid=".$row['qid'];
            $result1 = $conn->query($question1);
            $points = 0;
            if($result1->num_rows>0){
                while($row1  = $result1->fetch_assoc()) {
                    $points = $row1['points'];
                }
            }

            $question2 = "select * from exam_details where exam_id=".$examid;
            $result2 = $conn->query($question2);
            $examname = 0;
            if($result2->num_rows>0){
                while($row2  = $result2->fetch_assoc()) {
                    $examname = $row2['exam_name'];
                }
            }

            $data[$count][0] = $row['ucid'];
            $data[$count][1] = $row['examid'];
            $data[$count][2] = $row['qid'];
            $data[$count][3] = $row['answer'];
            $data[$count][4] = $row['question'];
            $data[$count][5] = $row['case1'];
            $data[$count][6] = $row['case2'];
            $data[$count][7] = $row['case3'];
            $data[$count][8] = $row['case4'];
            $data[$count][9] = $row['case5'];
            $data[$count][10] = $row['case6'];
            $data[$count][11] = $row['keyword'];
            $data[$count][12] = $row['function_name'];
            $data[$count][13] = $row['comments'];
            $data[$count][14] = $row['colon'];
            $data[$count][15] = $examname;
            $data[$count][16] = $points;
            $data[$count][17] = $row['tc3'];
            $data[$count][18] = $row['tc4'];
            $data[$count][19] = $row['tc5'];
            $data[$count][20] = $row['tc6'];
            $data[$count][21] = $row['c1a'];
            $data[$count][22] = $row['a1'];
            $data[$count][23] = $row['c2a'];
            $data[$count][24] = $row['a2'];
            $data[$count][25] = $row['c3a'];
            $data[$count][26] = $row['a3'];
            $data[$count][27] = $row['c4a'];
            $data[$count][28] = $row['a4'];
            $data[$count][29] = $row['c5a'];
            $data[$count][30] = $row['a5'];
            $data[$count][31] = $row['c6a'];
            $data[$count][32] = $row['a6'];
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
