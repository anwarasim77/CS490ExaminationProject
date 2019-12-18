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

if(isset($_POST['examid'])) {
    //get all questions for when given exam name and examid

    $examname = $_POST['examid'];

    $s = "use rp583";
    $conn->query($s);

    $s = "SELECT * FROM exam_details where exam_id = '".$examname."'";
    $result = $conn->query($s);
    $count=0;
    if ($result->num_rows > 0) {
        while($row = $result -> fetch_assoc()) {
            $qid = $row['exam_qid'];
            $s2 = "SELECT question FROM question_bank where qid = " . $qid;
            $result2 = $conn->query($s2);
            $question = 'no questions retrieved';

            while ($row2 = $result2->fetch_assoc()) {
                $question = $row2['question'];
            }
            //$data[$count][0] = $row['exam_qid'];
            $data[$count][0] = $row['exam_qid'];
            $data[$count][1] = $question;
            $data[$count][2] = $row['exam_name'];
            $count++;
        }

    }else{
        $data = Array();
         $data->response="could not retrieve all questions for exam: ".$examname;
    }
    $data = json_encode($data);
    echo $data;
    $conn->close();

}else{
    echo "post is not set";
    $conn->close();
}


?>
