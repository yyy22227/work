<?php

require('function.php');

if (!isset($_SESSION['account'])){
	switch ($_POST['action']) {
		case 't_register':
			$a=teacher_register($_POST['t_name'],$_POST['t_account'],$_POST['t_password'],$_POST['t_re_password'],$_POST['t_sex'],$_POST['t_city'],$_POST['t_phone'],$_POST['t_email'],$_POST['t_ID'],$_POST['t_department'],$_POST['t_specialty'],"file/default.jpg");
			$YN = 1;
			$account = $_POST['t_account'];
			$role = 'teacher';
			break;
		
		case 's_register':
			$a=student_register($_POST['s_name'],$_POST['s_account'],$_POST['s_password'],$_POST['s_re_password'],$_POST['s_sex'],$_POST['s_city'],$_POST['s_phone'],$_POST['s_email'],"file/default.jpg");
			$YN = 1;
			$account = $_POST['s_account'];
			$role = 'student';
			break;
		case 'login':
			$YN = login($_POST['account'],$_POST['password'],$_POST['role']);
			$account = $_POST['account'];
			$role = $_POST['role'];
			$a=NULL;
			break;
	}
	if ($a != NULL){
		//echo $a;
		showError($a);
		header('location:error.php');

	}
	else{
		if ($YN == 0){
			header('location:login.php');
		}
		else{
			$_SESSION['account'] = $account;
			$_SESSION['role'] = $role;

			header('location:index.php');
			}
	}
}
else{
    if(isset($_POST['action'])){
        switch ($_POST['action']) {
		case 's_update':
			student_update($_SESSION['account'],$_POST['s_password'],$_POST['s_name'],$_POST['s_sex'],$_POST['s_city'],$_POST['s_phone'],$_POST['s_email']);
			header('location:personal_card.php');
			break;
		case 't_update':
			teacher_update($_SESSION['account'],$_POST['t_password'],$_POST['t_name'],$_POST['t_sex'],$_POST['t_city'],$_POST['t_phone'],$_POST['t_email'],$_POST['t_department'],$_POST['t_specialty']);
			header('location:personal_card.php');
			break;
		/*case 'upload':
			upload($_SESSION['account'],$_SESSION['role']);
			break;*/
	}
	}else{
        switch($_GET['event']){
        case 'add_case':
            if($_GET['subject']==null || $_GET['city']==null || $_GET['case_time']==null || $_GET['salary']==null || $_GET['details']==null){
                header( "location:index.php"); 
            }else{
                 $conn = new mysqli('sql305.byethost7.com','b7_20212335','asdf0147','b7_20212335_team6');
                mysqli_set_charset($conn,"utf8");
                if($_SESSION['role']=='teacher'){
                    $sql = "INSERT INTO teacher_case(teacher_id,subject,city,case_time,salary,details)
                        VALUES ({$_SESSION['id']},'{$_GET['subject']}','{$_GET['city']}','{$_GET['case_time']}','{$_GET['salary']}','{$_GET['details']}');";
                }else if($_SESSION['role']=='student'){
                    $sql = "INSERT INTO student_case(student_id,subject,city,case_time,salary,details)
                        VALUES ({$_SESSION['id']},'{$_GET['subject']}','{$_GET['city']}','{$_GET['case_time']}','{$_GET['salary']}','{$_GET['details']}');";
                }

                $result = $conn->query($sql);
                mysqli_close($conn);
                
                header( "location:index.php"); 
            }
            
           break;
        case 'add_message':
            include_once('mess.php');
            
            class MessageBoard extends db{
                    var $messages = array();
                        function __construct(){
                            parent::__construct();
                            $this->receiveMessage();
                        }
                        function receiveMessage(){
                            if(isset($_GET['content'])&&$_GET['content']!=null){
                                $this->saveData(date("y-m-d h:i:s",time()),$_GET['content']);
                            }
                        }
                        function saveData($t,$c){
                            if($_SESSION['role']=='student'){
                                $sql = "INSERT INTO student_message (student_id,case_type,case_id,message_time,content) 
                                        VALUES ('{$_SESSION['id']}','{$_GET['case_type']}','{$_GET['case_id']}','$t','$c');";

                            }else if($_SESSION['role']=='teacher'){
                                $sql = "INSERT INTO teacher_message (teacher_id,case_type,case_id,message_time,content) 
                                        VALUES ('{$_SESSION['id']}','{$_GET['case_type']}','{$_GET['case_id']}','$t','$c');";
                            }
                            $result=mysqli_query($this->conn, $sql);
                        }
                }

                    $mb = new MessageBoard();

                    mysqli_close($conn);
                    header( "location:show_case.php?member_id={$_GET['member_id']}&case_type={$_GET['case_type']}&case_id={$_GET['case_id']}&member_type={$_GET['member_type']}");
            break;
        case 'add_case_applicant':
            $conn = new mysqli('sql305.byethost7.com','b7_20212335','asdf0147','b7_20212335_team6');
            mysqli_set_charset($conn,"utf8");
            $t = date("y-m-d h:i:s",time());
            
            if($_SESSION['role']=='student'){
                $sql = "INSERT INTO teacher_case_applicant(case_id,applicant_id,application_time) VALUES ({$_GET['case_id']},{$_SESSION['id']},'$t');"; 
            }else if($_SESSION['role']=='teacher'){
                $sql = "INSERT INTO student_case_applicant(case_id,applicant_id,application_time) VALUES ({$_GET['case_id']},{$_SESSION['id']},'$t');"; 
            }
            $result = $conn->query($sql);
            mysqli_close($conn);

             header( "location:show_case.php?member_id={$_GET['member_id']}&case_type={$_GET['case_type']}&case_id={$_GET['case_id']}&member_type={$_GET['member_type']}");


            break;
        case 'confirm_application':
            $conn = new mysqli('sql305.byethost7.com','b7_20212335','asdf0147','b7_20212335_team6');
            mysqli_set_charset($conn,"utf8");

            echo $_GET['case_id']."<br>";
            echo $_GET['applicant_id']."<br>";
            echo $_GET['case_type'];

            switch($_GET['case_type']){
                case 'student':
                    $sql = "UPDATE student_case SET status='完成' WHERE id={$_GET['case_id']}";
                    echo $sql;
                    $result = $conn->query($sql);        
                    $sql = "UPDATE student_case_applicant SET status='完成' WHERE case_id={$_GET['case_id']}&&applicant_id={$_GET['applicant_id']}";
                    $result = $conn->query($sql);
                    break;
                case 'teacher':
                    $sql = "UPDATE teacher_case SET status='完成' WHERE id={$_GET['case_id']}";
                    echo $sql;
                    $result = $conn->query($sql);        
                    $sql = "UPDATE teacher_case_applicant SET status='完成' WHERE case_id={$_GET['case_id']}&&applicant_id={$_GET['applicant_id']}";
                    $result = $conn->query($sql);
                    break;
            }

            
            mysqli_close($conn);

            header( "location:show_case_applicant.php");
            break;
        case 'cancel_application':
            $conn = new mysqli('sql305.byethost7.com','b7_20212335','asdf0147','b7_20212335_team6');
            mysqli_set_charset($conn,"utf8");

            echo $_GET['case_id']."<br>";
            echo $_GET['applicant_id']."<br>";
            echo $_GET['case_type'];
            switch($_GET['case_type']){
                case 'student':
                    $sql = "UPDATE student_case SET status='尋找中' WHERE id={$_GET['case_id']}";
                    echo $sql;
                    $result = $conn->query($sql);        
                    $sql = "UPDATE student_case_applicant SET status='申請中' WHERE case_id={$_GET['case_id']}&&applicant_id={$_GET['applicant_id']}";
                    $result = $conn->query($sql);
                    break;
                case 'teacher':
                    $sql = "UPDATE teacher_case SET status='尋找中' WHERE id={$_GET['case_id']}";
                    echo $sql;
                    $result = $conn->query($sql);        
                    $sql = "UPDATE teacher_case_applicant SET status='申請中' WHERE case_id={$_GET['case_id']}&&applicant_id={$_GET['applicant_id']}";
                    $result = $conn->query($sql);
                    break;
            }
            mysqli_close($conn);

            header( "location:show_case_applicant.php");
            break;
        case 'edit_case':
            if($_GET['subject']==null || $_GET['city']==null || $_GET['case_time']==null || $_GET['salary']==null || $_GET['details']==null){
                header( "location:index.php"); 
            }else{
                $conn = new mysqli('sql305.byethost7.com','b7_20212335','asdf0147','b7_20212335_team6');
                mysqli_set_charset($conn,"utf8");
                

                $sql = "UPDATE {$_GET['case_type']}  
                SET subject = '{$_GET['subject']}',city = '{$_GET['city']}',case_time = '{$_GET['case_time']}',salary = '{$_GET['salary']}',details = '{$_GET['details']}'
                WHERE id={$_GET['case_id']};" ;
                $result = $conn->query($sql);

                echo $sql; 

                mysqli_close($conn);
                
                header( "location:index.php"); 
            }
           break;
        case 'delete_case':
            $conn = new mysqli('sql305.byethost7.com','b7_20212335','asdf0147','b7_20212335_team6');
            mysqli_set_charset($conn,"utf8");
            $sql = "DELETE FROM {$_GET['case_type']} WHERE id={$_GET['case_id']}";
            $result = $conn->query($sql);
            
            header( "location:index.php"); 
            break;
        default:
            break;
            }

        }
	}

?>