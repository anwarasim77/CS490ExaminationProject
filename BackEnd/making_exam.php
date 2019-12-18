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
if(isset($_POST['Questions']) and isset($_POST['examname']) and isset($_POST['points'])) {

    $examname = $_POST['examname'];
    $questions = $_POST['Questions'];
    $points = $_POST['points'];
    //echo $questions[1;

    $s = "use rp583";
    $conn->query($s);

    $s = 'SELECT MAX(id) as max FROM exams';


    $result = $conn->query($s);
    //print_r($result);
    $examid = "0";

    if ($result->num_rows > 0) {
        while($row = $result -> fetch_assoc()){
            $examid = strval($row['max']);
            //echo $examid;
        }

    }else{
        echo "Could not determine what ID to give to exam: ".$examname;
    }
    $examid+=1;

    $s = "insert into exams values(".$examid.", '".$examname."', 'false')";
    echo $s;
    $conn->query($s) or die($conn->error); //execute query s or if error print the error

    for($i=0; $i<count($questions); $i++){
        $s = 'Insert into exam_details(exam_id, exam_name, exam_qid, points) values('.$examid.', "'.$examname.'", '.$questions[$i].', '.$points[$i].')';
        //echo "hello";
        $conn->query($s) or die($conn->error);
    }


    $conn->close();

}else{
    echo "post is not set";
    $conn->close();
}


?>
