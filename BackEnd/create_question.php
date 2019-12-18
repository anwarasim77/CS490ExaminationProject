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
if(isset($_POST['question'])) {

    $question = $_POST['question'];
    $topic = $_POST['topic'];
    $constraint = $_POST['constraint'];
    $difficulty = $_POST['difficulty'];
    $funcName = $_POST['funcName'];

    $TCOne = $_POST['TCOne'];
    $TCTwo = $_POST['TCTwo'];
    $TC3 = $_POST['TCThree'];
    $TC4 = $_POST['TCFour'];
    $TC5 = $_POST['TCFive'];
    $TC6 = $_POST['TCSix'];

    $OutOne = $_POST['OutOne'];
    $OutTwo = $_POST['OutTwo'];
    $Out3 = $_POST['OutThree'];
    $Out4 = $_POST['OutFour'];
    $Out5 = $_POST['OutFive'];
    $Out6 = $_POST['OutSix'];




    echo "<br>";
    $s = "use rp583";
    $conn->query($s);

    $s = 'SELECT MAX(qid) as max FROM question_bank';
    $result = $conn->query($s);

    $qid = "0";

    if ($result->num_rows > 0) {
        while($row = $result -> fetch_assoc()){
            $qid = $row['max'];
            echo "<br>";
            //echo $qid;
            echo "<br>";
        }

    }else{
        echo "Could not determine what ID to give to exam: ".$qid;
    }
    $qid = strval($qid+1);

    $s = "insert into question_bank values(".$qid.", '".$question."', '".$topic."', '".$difficulty."', '".$constraint."', '".$funcName."','".$TCOne."','".$OutOne."','".$TCTwo."','".$OutTwo."', '".$TC3."','".$Out3."','".$TC4."','".$Out4."', '".$TC5."','".$Out5."','".$TC6."','".$Out6."')";

    #$s=$TC3;
    #echo $s;
    $conn->query($s) or die($conn->error); //execute query s or if error print the error


    //add row for newly made question to test bank

    $conn->close();

}else{
    echo "post is not set";
    $conn->close();
}


?>

