<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if(isset($_POST['task'])){

    $Task=$_POST['task'];

        if($Task=="login"){

            $Username = $_POST['Username'];
            $_SESSION['Username'] = $Username;

            $Password = $_POST['Password'];

            $secured = "username=".$Username."&password=".$Password."&task=".$Task;

            logincheck($secured);

        }    

        if($Task==("create exam")){

            $tasksend = "task=".$Task; 
            midendreq($tasksend);
        }

        if($Task==("logout")){

            session_destroy();
            
        }

        if($Task==("add Q")){
            $question = $_POST['question'];
            $topic = $_POST['topic'];
            $constraint = $_POST['constraint'];
            $TCOne = $_POST['TCOne'];
            $TCTwo = $_POST['TCTwo'];
            $difficulty = $_POST['difficulty'];
            $OutOne = $_POST['OutOne'];
            $OutTwo = $_POST['OutTwo'];
            $funcName = $_POST['funcName'];
            $TCThree = $_POST['TCThree'];
            $TCFour = $_POST['TCFour'];
            $TCFive = $_POST['TCFive'];
            $TCSix = $_POST['TCSix'];

            $OutThree = $_POST['OutThree'];
            $OutFour = $_POST['OutFour'];
            $OutFive = $_POST['OutFive'];
            $OutSix = $_POST['OutSix'];

            $tasksend = "task=".$Task."&question=".$question."&topic=".$topic."&constraint=".$constraint."&TCOne=".$TCOne."&TCTwo=".$TCTwo."&difficulty=".$difficulty."&OutOne=".$OutOne."&OutTwo=".$OutTwo."&funcName=".$funcName."&TCThree=".$TCThree."&OutThree=".$OutThree."&TCFour=".$TCFour."&OutFour=".$OutFour."&TCFive=".$TCFive."&OutFive=".$OutFive."&TCSix=".$TCSix."&OutSix=".$OutSix;
            midendreq($tasksend);
        }

        if($Task==("submit created exam")){
            $examname = $_POST['examname'];
            $Questions = $_POST['Questions'];
            $points = $_POST['points'];
            $Qarr="";
            $Parr="";

            for($i=0;$i<count($Questions);$i++){
                $Qarr.="&Questions[]=".$Questions[$i];
                $Parr.="&points[]=".$points[$i];
            }

            $tasksend = "task=".$Task."&examname=".$examname.$Qarr.$Parr;
            midendreq($tasksend);
        }
        
        if($Task==("getAvalExam")){
            $tasksend = "task=".$Task."&user=".$_SESSION['Username'];
            midendreq($tasksend);
        }
    
        if($Task==("storeExam")){
            $examid = $_POST['eid'];
            $_SESSION['eid']=$examid;   
        }

        if($Task==("studentTakeExam")){
            $tasksend = "task=".$Task."&examid=".$_SESSION['eid'];
            midendreq($tasksend);
        }

        if($Task==("StudentSubmitExam")){
            $Qid = $_POST['QuestionID'];
            $Ans=$_POST['Ans'];
            $ansApp="";
            $qapp="";
            for($i=0;$i<count($Ans);$i++){
                $ansApp.="&Ans[]=".$Ans[$i];
                $qapp.="&Qid[]=".$Qid[$i];
            }
            $tasksend = "task=".$Task."&examid=".$_SESSION['eid']."&user=".$_SESSION['Username'].$ansApp.$qapp;
            midendreq($tasksend);
            unset($_SESSION['eid']);
        }

        if($Task==("ExamToBeGraded")){
            $tasksend = "task=".$Task;
            midendreq($tasksend);
        }

        if($Task==("ExamToBeGradedList")){
            $examID=$_POST['examID'];
            $tasksend = "task=".$Task."&examID=".$examID;
            midendreq($tasksend);
        }

        if($Task==("TeacherExamToReview")){
            $tasksend = "task=".$Task;
            midendreq($tasksend);
        }
        if($Task==("TeacherExamToReviewSession")){
            $examID=$_POST['examID'];
            $_SESSION['RevEid']=$examID;
        }

        if($Task==("TeacherExamToReviewChooseStudent")){
            $tasksend = "task=".$Task."&examid=".$_SESSION['RevEid'];
            midendreq($tasksend);
        }
        if($Task==("TeacherExamToReviewChooseStudentSession")){
            $User=$_POST['RevUser'];
            $_SESSION['RevUser']=$User;
        }

        if($Task==("GetResultToEdit")){
            $tasksend = "task=".$Task."&examid=".$_SESSION['RevEid']."&user=".$_SESSION['RevUser'];
            midendreq($tasksend);
        }

        if($Task==("UpdatingStudentsScore")){
            $Qid = $_POST['Questions'];
            $Ans=$_POST['points'];
            $ansApp="";
            $qapp="";
            for($i=0;$i<count($Ans);$i++){
                $ansApp.="&points[]=".$Ans[$i];
            }
            for($i=0;$i<count($Qid);$i++){
                $qapp.="&Questions[]=".$Qid[$i];
            }
            $tasksend = "task=".$Task."&examid=".$_SESSION['RevEid']."&user=".$_SESSION['RevUser'].$ansApp.$qapp;
            midendreq($tasksend);
        }
        
        if($Task==("StudeViewsGradedExam1")){
            $tasksend = "task=".$Task;
            midendreq($tasksend);
        }

        if($Task==("StudeViewsGradedExam2")){
            $examID=$_POST['examID'];
            $_SESSION['StdntExid']=$examID;
        }
        if($Task==("StudentViewOwnExam")){
            $tasksend = "task=GetResultToEdit"."&examid=".$_SESSION['StdntExid']."&user=".$_SESSION['Username'];
            midendreq($tasksend);
        }
        
}

function logincheck($secured){
    $curlp = curl_init();
    curl_setopt($curlp, CURLOPT_URL, "https://web.njit.edu/~ma854/CS490MidLogin.php");
    curl_setopt($curlp, CURLOPT_HEADER, false);
    curl_setopt($curlp, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curlp, CURLOPT_HTTPHEADER, array("Content-type: application/x-www-form-urlencoded"));
    curl_setopt($curlp, CURLOPT_POST, true);
    curl_setopt($curlp, CURLOPT_POSTFIELDS, $secured);
    $fin = curl_exec($curlp);
    echo $fin;
}
function midendreq($Task){
    $curlp = curl_init();
    curl_setopt($curlp, CURLOPT_URL, "https://web.njit.edu/~ma854/CS490MidLogin.php");
    curl_setopt($curlp, CURLOPT_HEADER, false);
    curl_setopt($curlp, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curlp, CURLOPT_HTTPHEADER, array("Content-type: application/x-www-form-urlencoded"));
    curl_setopt($curlp, CURLOPT_POST, true);
    curl_setopt($curlp, CURLOPT_POSTFIELDS, $Task);
    $fin = curl_exec($curlp);
    echo $fin;
}

?>