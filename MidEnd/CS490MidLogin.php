<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

    if(isset($_POST['task'])){
        
        $Task=$_POST['task'];

        if($Task=="login"){
            
            $u = $_POST['username'];
                $_SESSION['username'] = $u;

            $p = $_POST['password'];

            $info="username=".$u."&password=".$p;
            $url="afsaccess3.njit.edu/~rp583/beta/get_role.php";

            OurBackEnd($info,$url);
        }
        else{
            if($Task=="getAvalExam"){
                $username = $_POST['user'];
                $info = "task=".$Task."&username=".$username;
                $url ="afsaccess3.njit.edu/~rp583/beta/get_exam_to_take.php";
                OurBackEnd($info,$url);
                
            }
            else{
                if($Task=="logout"){
                    session_destroy();
                }
                else{
                    if($Task=="create exam"){
                        
                        $info="task=".$Task;
                        $url= "afsaccess3.njit.edu/~rp583/beta/get_all_questions.php";
                        OurBackEnd($info,$url);

                    }
                    else{
                        if($Task=="submit created exam"){
                            $examname = $_POST['examname'];
                            $Questions = $_POST['Questions'];
                            $points = $_POST['points'];
                            
                            $Qarr="";
                            $Parr="";

                            for($i=0;$i<count($Questions);$i++){
                                $Qarr.="&Questions[]=".$Questions[$i];
                                $Parr.="&points[]=".$points[$i];
                            }


                            $info="examname=".$examname.$Qarr.$Parr;
                            $url= "afsaccess3.njit.edu/~rp583/beta/making_exam.php";
                            OurBackEnd($info,$url);
                        }
                        else{
                            if($Task=="add Q"){
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

                                $info = "question=".$question."&topic=".$topic."&constraint=".$constraint."&TCOne=".$TCOne."&TCTwo=".$TCTwo."&difficulty=".$difficulty."&OutOne=".$OutOne."&OutTwo=".$OutTwo."&funcName=".$funcName."&TCThree=".$TCThree."&OutThree=".$OutThree."&TCFour=".$TCFour."&OutFour=".$OutFour."&TCFive=".$TCFive."&OutFive=".$OutFive."&TCSix=".$TCSix."&OutSix=".$OutSix;
                                
                                $url= "afsaccess3.njit.edu/~rp583/beta/create_question.php";
                                OurBackEnd($info,$url);
                            }
                            else{
                                if($Task=="studentTakeExam"){
                                    $ExamID = $_POST['examid'];
                                    $info = "task=".$Task."&examid=".$ExamID;
                                    $url= "afsaccess3.njit.edu/~rp583/beta/get_exam_questions.php";
                                    OurBackEnd($info,$url);
                                }
                                else{
                                    if($Task=="StudentSubmitExam"){
                                        $ExamID = $_POST['examid'];
                                        $Qid = $_POST['Qid'];
                                        $Ans=$_POST['Ans'];
                                        $user=$_POST['user'];
                                        
                                        Gradeit($Qid,$Ans,$ExamID,$user);
                                        
                                    }
                                    else{
                                        if($Task=="ExamToBeGraded"){
                                            $info = "task=".$Task;
                                            $url = "afsaccess3.njit.edu/~rp583/beta/get_ungraded_exam.php";
                                            OurBackEnd($info,$url);
                                        }
                                        else{
                                            if($Task=="ExamToBeGradedList"){
                                                $examID=$_POST['examID'];
                                                $info = "task=".$Task."&examid=".$examID;
                                                $url= "afsaccess3.njit.edu/~rp583/beta/mark_graded.php";
                                                OurBackEnd($info,$url);
                                            }
                                            else{
                                                if($Task=="TeacherExamToReview"){
                                                    $info = "task=".$Task;
                                                    $url = "afsaccess3.njit.edu/~rp583/beta/get_all_exams.php";
                                                    OurBackEnd($info,$url);
                                                }
                                                else{
                                                    if($Task=="TeacherExamToReviewChooseStudent"){
                                                        $examID=$_POST['examid'];
                                                        $info = "task=".$Task."&examid=".$examID;
                                                        $url = "afsaccess3.njit.edu/~rp583/beta/get_all_students.php";
                                                        OurBackEnd($info,$url);
                                                    }
                                                    else{
                                                        if($Task=="GetResultToEdit"){
                                                            $examid=$_POST['examid'];
                                                            $user=$_POST['user'];
                                                            $info = "task=".$Task."&username=".$user."&examid=".$examid;
                                                            $url = "afsaccess3.njit.edu/~rp583/beta/get_student_answers.php";
                                                            OurBackEnd($info,$url);
                                                        }
                                                        else{
                                                            if($Task=="UpdatingStudentsScore"){
                                                                $examid = $_POST['examid'];
                                                                $Questions = $_POST['Questions'];
                                                                $points = $_POST['points'];
                                                                $user = $_POST['user'];

                                                                $Qarr="";
                                                                $Parr="";
                                    
                                                                for($i=0;$i<count($Questions);$i++){
                                                                    $Qarr.="&Questions[]=".$Questions[$i];
                                                                }
                                                                for($i=0;$i<count($points);$i++){
                                                                    $Parr.="&points[]=".$points[$i];
                                                                }
                                    
                                    
                                                                $info="examid=".$examid."&user=".$user.$Qarr.$Parr;
                                                                $url= "afsaccess3.njit.edu/~rp583/beta/update_answers.php";
                                                                OurBackEnd($info,$url);
                                                            }
                                                            else{
                                                                if($Task=="StudeViewsGradedExam1"){
                                                                    $info = "task=".$Task;
                                                                    $url = "afsaccess3.njit.edu/~rp583/beta/get_graded_exam.php";
                                                                    OurBackEnd($info,$url);
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    else
    {
        echo "You are not supposed to be here :/";
    }

///////////////////////////////////////////////////////////////////////////////////////////////
function OurBackEnd($info,$url){
    
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/x-www-form-urlencoded"));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $info);
        $json_response = curl_exec($curl);
        $response=json_decode($json_response);
    }

    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    curl_close($curl);
    if($status == 200 && isset($json_response)){
        echo $json_response;
    }
    else{
        $access = new \stdClass();
        $access->response="Something went wrong in our backend. Error:".$status;
        $JsonAccess = json_encode($access);
        echo $JsonAccess;
    }
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
function Gradeit($Qid,$ans,$ExamID,$user){$tesing;

$T1Match;
$T2Match;
$T3Match;
$T4Match;
$T5Match;
$T6Match;
$Syntax;
$ConstMatch;
$FuncMatch;
$output;
$comment="";
$a1;
$a2;
$a3;
$a4;
$a5;
$a6;
$curl = curl_init();
    for($i=0;$i<count($Qid);$i++){
    $T1Match=0;
    $T2Match=0;
    $T3Match=0;
    $T4Match=0;
    $T5Match=0;
    $T6Match=0;
    $Syntax=0;
    $ConstMatch=0;
    $FuncMatch=0;
    $comment="";
    $a1="N/A";
    $a2="N/A";
    $a3="N/A";
    $a4="N/A";
    $a5="N/A";
    $a6="N/A";
        {
            $info="qid=".$Qid[$i]."&examid=".$ExamID;
            
            curl_setopt($curl, CURLOPT_URL, "afsaccess3.njit.edu/~rp583/beta/get_question_details.php");
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/x-www-form-urlencoded"));
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $info);
            $json_response = curl_exec($curl);
            $response=json_decode($json_response);
        }
        
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    
        
        if($status == 200 && isset($json_response)){
            $ans[$i] = str_replace("PLUSSIGN","+",$ans[$i]);
            $t = trim(preg_replace('/\s+/',' ', $ans[$i])); ///removes extra white space
            $studentfname= substr($t,4,strpos($t,"(")-4);

            if (preg_match("/def .*(.*) *:.*/", $ans[$i])) {
                $Syntax=0;
            }else{
                $ans[$i]=substr($ans[$i], 0, strpos($ans[$i],")")+1).":".substr($ans[$i], strpos($ans[$i],")")+1);
                $Syntax=3;
                $comment.="Syntax error! missing colon. ";
            }

            $testcase=$response->case1;

            $myfile = fopen("test.py", "w") or die("Unable to open file!");

            if($response->constraint=="print"){
                fwrite($myfile, "#!/usr/bin/python\n".$ans[$i]."\n\n".$studentfname."(".$testcase.")");
                fclose($myfile);
            }
            else{
                fwrite($myfile, "#!/usr/bin/python\n".$ans[$i]."\n\nprint(".$studentfname."(".$testcase."))");
                fclose($myfile);
            }

            $command = escapeshellcmd("python test.py");
            $output = shell_exec($command);
            $a1=$output;
            //echo $output;
            if(gettype($output)=="double" || gettype($output)=="integer"){
                if($output==$response->output1 || (abs($output - $response->output1) < 0.00001)){
                    $T1Match=0;
                }else{
                    $T1Match=5;
                }
            }else{
                
                if(strcmp(trim($output),trim($response->output1))==0){
                    $T1Match=0;
                }else{
                    $T1Match=5;
                }
            }
            
            $testcase=$response->case2;

            $myfile = fopen("test.py", "w") or die("Unable to open file!");

            if($response->constraint=="print"){
                fwrite($myfile, "#!/usr/bin/python\n".$ans[$i]."\n\n".$studentfname."(".$testcase.")");
                fclose($myfile);
            }
            else{
                fwrite($myfile, "#!/usr/bin/python\n".$ans[$i]."\n\nprint(".$studentfname."(".$testcase."))");
                fclose($myfile);
            }

            $command = escapeshellcmd("python test.py");
            $output = shell_exec($command);
            $a2=$output;
            
            if(gettype($output)=="double" || gettype($output)=="integer"){
                if($output==$response->output2 || (abs($output - $response->output2) < 0.00001)){
                    $T2Match=0;
                }else{
                    $T2Match=5;
                }
            }else{
                
                if(strcmp(trim($output),trim($response->output2))==0){
                    $T2Match=0;
                }else{
                    $T2Match=5;
                }
            }
            
            $testcase=$response->case3;
            if($testcase!="notestcase"){

                

                $myfile = fopen("test.py", "w") or die("Unable to open file!");

                if($response->constraint=="print"){
                    fwrite($myfile, "#!/usr/bin/python\n".$ans[$i]."\n\n".$studentfname."(".$testcase.")");
                    fclose($myfile);
                }
                else{
                    fwrite($myfile, "#!/usr/bin/python\n".$ans[$i]."\n\nprint(".$studentfname."(".$testcase."))");
                    fclose($myfile);
                }

                $command = escapeshellcmd("python test.py");
                $output = shell_exec($command);
                $a3=$output;
                //echo $output;
                
                if(gettype($output)=="double" || gettype($output)=="integer"){
                    if($output==$response->output3 || (abs($output - $response->output3) < 0.00001)){
                        $T3Match=0;
                    }else{
                        $T3Match=5;
                    }
                }else{
                    
                    if(strcmp(trim($output),trim($response->output3))==0){
                        $T3Match=0;
                    }else{
                        $T3Match=5;
                    }
                }
                
            }
            
            $testcase=$response->case4;
            if($testcase!="notestcase"){


                $myfile = fopen("test.py", "w") or die("Unable to open file!");

                if($response->constraint=="print"){
                    fwrite($myfile, "#!/usr/bin/python\n".$ans[$i]."\n\n".$studentfname."(".$testcase.")");
                    fclose($myfile);
                }
                else{
                    fwrite($myfile, "#!/usr/bin/python\n".$ans[$i]."\n\nprint(".$studentfname."(".$testcase."))");
                    fclose($myfile);
                }

                $command = escapeshellcmd("python test.py");
                $output = shell_exec($command);
                $a4=$output;
                //echo $output;
                
                if(gettype($output)=="double" || gettype($output)=="integer"){
                    if($output==$response->output4 || (abs($output - $response->output4) < 0.00001)){
                        $T4Match=0;
                    }else{
                        $T4Match=5;
                    }
                }else{
                    if(strcmp(trim($output),trim($response->output4))==0){
                        $T4Match=0;
                    }else{
                        $T4Match=5;
                    }
                }

            }
             
            $testcase=$response->case5;
            if($testcase!="notestcase"){


                $myfile = fopen("test.py", "w") or die("Unable to open file!");

                if($response->constraint=="print"){
                    fwrite($myfile, "#!/usr/bin/python\n".$ans[$i]."\n\n".$studentfname."(".$testcase.")");
                    fclose($myfile);
                }
                else{
                    fwrite($myfile, "#!/usr/bin/python\n".$ans[$i]."\n\nprint(".$studentfname."(".$testcase."))");
                    fclose($myfile);
                }

                $command = escapeshellcmd("python test.py");
                $output = shell_exec($command);
                $a5=$output;
                //echo $output;
                
                if(gettype($output)=="double" || gettype($output)=="integer"){
                    if($output==$response->output5 || (abs($output - $response->output5) < 0.00001)){
                        $T5Match=0;
                    }else{
                        $T5Match=5;
                    }
                }else{
                    if(strcmp(trim($output),trim($response->output5))==0){
                        $T5Match=0;
                    }else{
                        $T5Match=5;
                    }
                }

            }

            $testcase=$response->case6;
            if($testcase!="notestcase"){

                $myfile = fopen("test.py", "w") or die("Unable to open file!");

                if($response->constraint=="print"){
                    fwrite($myfile, "#!/usr/bin/python\n".$ans[$i]."\n\n".$studentfname."(".$testcase.")");
                    fclose($myfile);
                }
                else{
                    fwrite($myfile, "#!/usr/bin/python\n".$ans[$i]."\n\nprint(".$studentfname."(".$testcase."))");
                    fclose($myfile);
                }

                $command = escapeshellcmd("python test.py");
                $output = shell_exec($command);
                $a6=$output;
                //echo $output;
                
                if(gettype($output)=="double" || gettype($output)=="integer"){
                    if($output==$response->output6 || (abs($output - $response->output6) < 0.00001)){
                        $T6Match=0;
                    }else{
                        $T6Match=5;
                    }
                }else{
                    if(strcmp(trim($output),trim($response->output6))==0){
                        $T6Match=0;
                    }else{
                        $T6Match=5;
                    }
                }

            }

            if(strpos($ans[$i],$response->constraint ) !== false || $response->constraint=="None"){
                $ConstMatch=0;
            }else{
                $ConstMatch=3;
                $comment.=$response->constraint." was supposed to be included in the answer. ";
            }

            if((strpos($ans[$i],$response->func_name) !== false) || $studentfname==$response->func_name){
                $FuncMatch=0;
            }else{
                $FuncMatch=3;
                $comment.="Function name did not match. ";
            }

        }
        else{
            $access = new \stdClass();
            $access->response="Something went wrong in our backend. Error:".$status;
            $JsonAccess = json_encode($access);
            echo $JsonAccess;
        }
        ////////////////Graded a question on top now sending to database///////////////////////////////////
        $Total=$response->points;
        $Total=$Total-($T1Match+$T2Match+$T3Match+$T4Match+$T5Match+$T6Match+$Syntax+$ConstMatch+$FuncMatch);
        
        
        {//$Qid,$ans,$ExamID,$user
            $info="qid=".$Qid[$i]."&examid=".$ExamID."&ans=".$ans[$i]."&user=".$user."&Out1=".$T1Match."&Out2=".$T2Match."&Func=".$FuncMatch."&Const=".$ConstMatch."&Total=".$Total."&Out3=".$T3Match."&Out4=".$T4Match."&Out5=".$T5Match."&Out6=".$T6Match."&Syntax=".$Syntax."&a1=".$a1."&a2=".$a2."&a3=".$a3."&a4=".$a4."&a5=".$a5."&a6=".$a6."&comment=".$comment;
            
            curl_setopt($curl, CURLOPT_URL, "afsaccess3.njit.edu/~rp583/beta/store_exam_answer.php");
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/x-www-form-urlencoded"));
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $info);
            $json_response = curl_exec($curl);
            $response=json_decode($json_response);
        }
        
        if($status == 200 && isset($json_response)){
            //echo $json_response;
        }
        else{
            $access = new \stdClass();
            $access->response="Something went wrong in our backend. Error:".$status;
            $JsonAccess = json_encode($access);
            echo $JsonAccess;
        }
        
    }
    curl_close($curl);
    //echo $tesing;
    //echo "Test1=".$T1Match." Test2=".$T2Match." key=".$ConstMatch." func=".$FuncMatch;


}

?>