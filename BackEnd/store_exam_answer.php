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

if(isset($_POST['user']) and isset($_POST['examid'])) {
    $ucid = $_POST['user'];
    $examid = $_POST['examid'];
    $qid = $_POST['qid'];
    $answer = $_POST['ans'];
    $case1 = $_POST['Out1'];
    $case2 = $_POST['Out2'];
    $case3 = $_POST['Out3'];
    $case4 = $_POST['Out4'];
    $case5 = $_POST['Out5'];
    $case6 = $_POST['Out6'];
    $keyword = $_POST['Const'];
    $func_name = $_POST['Func'];
    $comment = $_POST['comment'];
    $colon = $_POST['Syntax'];
    $a1 = $_POST['a1'];
    $a2 = $_POST['a2'];
    $a3 = $_POST['a3'];
    $a4 = $_POST['a4'];
    $a5 = $_POST['a5'];
    $a6 = $_POST['a6'];

    //use specific database and retrieve respective password
    $s = "use rp583";
    $conn->query($s);

    $sql = "insert into answers values('".$ucid."', '".$examid."', '".$qid."', '".$answer."', '".$case1."', '".$case2."', '".$case3."', '".$case4."', '".$case5."', '".$case6."', '".$keyword."', '".$func_name."', '".$comment."', '".$colon."', '".$a1."', '".$a2."', '".$a3."', '".$a4."', '".$a5."', '".$a6."')";
    #echo "Inserted values into answers table for student: ".$ucid;
    $result = $conn->query($sql);

    $conn->close();


}else{
    echo "Post is not set";
    $conn->close();
}

?>
