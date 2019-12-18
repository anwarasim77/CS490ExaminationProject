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

if(isset($_POST['user']) and isset($_POST['examid']) and isset($_POST['Questions']) and isset($_POST['points'])) {
    $name = $_POST['user'];
    $examid = $_POST['examid'];
    $qid = $_POST['Questions'];
    $points = $_POST['points'];

    $s = "use rp583";
    $conn->query($s);

    $c = 0;
    //mark 0's for students who didn't take exam
    for($i=0; $i<count($qid); $i++){
        $case1 = $points[$c];
        $c=$c+1;
        $case2 = $points[$c];
        $c=$c+1;
        $case3 = $points[$c];
        $c=$c+1;
        $case4 = $points[$c];
        $c=$c+1;
        $case5 = $points[$c];
        $c=$c+1;
        $case6 = $points[$c];
        $c=$c+1;
        $keyword = $points[$c];
        $c=$c+1;
        $funcname = $points[$c];
        $c=$c+1;
        $syntax = $points[$c];
        $c=$c+1;
        $comment = $points[$c];
        $c=$c+1;
        $s = "update answers set case1=".$case1.", case2=".$case2.", case3=".$case3.",case4=".$case4.", case5=".$case5.", case6=".$case6.", keyword='".$keyword."', function_name='".$funcname."', comments='".$comment."', colon=".$syntax." where ucid='".$name."' and qid=".$qid[$i]." and examid=".$examid;
        $result = $conn->query($s);
        echo $s;
    }

    //$data = "updated answers table";
    $data = json_encode($points);
    //echo var_dump($points);
}else{
    echo "Post is not set";
}
$conn->close();
?>
