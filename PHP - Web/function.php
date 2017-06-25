<?php 

session_start();

function db_connection(){
	$db = new mysqli('sql305.byethost7.com','b7_20212335','asdf0147','b7_20212335_team6');
	if ($db->connect_error){
		die("Connection Error:". $db->connect_error);
	}

	mysqli_query($db,"SET NAMES 'utf8'");
	return $db;
}

function showError($message){

	$_SESSION['message'] = $message;

}

function student_register($name,$account,$password,$re_password,$gender,$city,$phone,$email,$photo){

	if ($password != $re_password){
		return '輸入密碼與再次輸入密碼不同';
	}
	else{
		$db = db_connection();
		$check = $db->query("SELECT name FROM student WHERE account='$account'");
		$a=mysqli_fetch_row($check);
		if ($a!=NULL){
			return '此帳號已經被註冊過，請換新帳號';
		}
		else{
			$sql = "INSERT INTO student(name,account,password,gender,city,phone,email,photo_path) VALUES ('$name','$account','$password','$gender','$city','$phone','$email','$photo');";
			$result = $db->query($sql);
			return NULL;
		}
}
}


function teacher_register($name,$account,$password,$re_password,$gender,$city,$phone,$email,$ID,$department,$specialty,$photo){

	if ($password != $re_password){
		return '輸入密碼與再次輸入密碼不同';
	}
	else{
		$db = db_connection();
		$check = $db->query("SELECT name FROM teacher WHERE account='$account'");
		$a=mysqli_fetch_row($check);
		if ($a!=NULL){
			return '此帳號已經被註冊過，請換新帳號';
		}
		else{
			$sql = "INSERT INTO teacher(name,account,password,gender,city,phone,email,studentID,department,specialty,photo_path) VALUES ('$name','$account','$password','$gender','$city','$phone','$email','$ID','$department','$specialty','$photo');";
			$result = $db->query($sql);
			return NULL;
		}
	}
}

function role($role){
	if ($role=='teacher'){
		$result=mysqli_query("SELECT * FROM teacher WHERE account='$account' && password='$password'");
	}
	elseif ($role=='student') {
		$result=mysqli_query("SELECT * FROM student WHERE account='$account' && password='$password'");
	}
	return $result;
}

function login($account,$password,$role){
	$db = db_connection();
	if ($role=='teacher'){
		$result = $db->query("SELECT * FROM teacher WHERE account='$account' && password='$password'");
		
	}
	elseif ($role=='student') {
		$result = $db->query("SELECT * FROM student WHERE account='$account' && password='$password'");
	}
	else{
		$sql='123';
	}
	$a=mysqli_fetch_row($result);
	$_SESSION['id'] = $a[0];
	
	//echo $a;
	if ($a==NULL){
		return 0;
	}
	else {
		return 1;
	}
}

function data($account,$role){
	$db = db_connection();
	if ($role=='teacher'){
		$result = $db->query("SELECT gender,city,department,specialty,email FROM teacher WHERE account='$account'");
		$row=mysqli_fetch_row($result);
		echo "性別：  ";
		echo $row[0]; ?><tr><th><?php
		echo "地區：  ";
		echo $row[1]; ?><tr><th><?php
		echo "系級：  ";
		echo $row[2]; ?><tr><th><?php
		echo "科目：  ";
		echo $row[3]; ?><tr><th><?php
		echo "E-mail：  ";
		echo $row[4];
	}
	elseif ($role=='student') {
		$result = $db->query("SELECT gender,city,email FROM student WHERE account='$account'");
		$row=mysqli_fetch_row($result);
		echo "性別：  ";
		echo $row[0]; ?><tr><th><?php
		echo "地區：  ";
		echo $row[1]; ?><tr><th><?php
		echo "E-mail：  ";
		echo $row[2];
	}

}

function name($account,$role){
	$db = db_connection();
	$account = $db->real_escape_string($account);
	$result = '';
	if ($role=='teacher'){
		$result = $db->query("SELECT name FROM teacher WHERE account='$account'");
	}
	elseif ($role=='student') {
		$result = $db->query("SELECT name FROM student WHERE account='$account'");
	}

	$row=mysqli_fetch_row($result);
	echo $row[0];

}


function photo($account){

	$db = db_connection();
	if ($_SESSION['role']=='teacher'){
		$result = $db->query("SELECT photo_path FROM teacher WHERE account='$account'");
	}
	elseif ($_SESSION['role']=='student') {
		$result = $db->query("SELECT photo_path FROM student WHERE account='$account'");
	}
	$tmp=mysqli_fetch_row($result);
	//echo $tmp[0];
	if($tmp[0]==''){
		echo 'img/me.jpg';
	}
	else {
		echo 'file/';
		echo $account;
		echo '.jpg';
	}
}


function student_update($account,$password,$name,$gender,$city,$phone,$email){
	$db = db_connection();

	if ($password != NULL){
		$result = $db->query("UPDATE student SET password='$password' WHERE account='$account'");
	}
	if ($name != NULL){
		$result = $db->query("UPDATE student SET name='$name' WHERE account='$account'");
	}
	if ($gender != NULL){
		$result = $db->query("UPDATE student SET gender='$gender' WHERE account='$account'");
	}
	if ($city != NULL){
		$result = $db->query("UPDATE student SET city=$city WHERE account='$account'");
	}
	if ($phone != NULL){
		$result = $db->query("UPDATE student SET phone='$phone' WHERE account='$account'");
	}
	if ($email != NULL){
		$result = $db->query("UPDATE student SET email='$email' WHERE account='$account'");
	}
}

function teacher_update($account,$password,$name,$gender,$city,$phone,$email,$department,$specialty){
	$db = db_connection();

	if ($password != NULL){
		$result = $db->query("UPDATE teacher SET password='$password' WHERE account='$account'");
	}
	if ($name != NULL){
		$result = $db->query("UPDATE teacher SET name='$name' WHERE account='$account'");
	}
	if ($gender != NULL){
		$result = $db->query("UPDATE teacher SET gender='$gender' WHERE account='$account'");
	}
	if ($city != NULL){
		$result = $db->query("UPDATE teacher SET city=$city WHERE account='$account'");
	}
	if ($phone != NULL){
		$result = $db->query("UPDATE teacher SET phone='$phone' WHERE account='$account'");
	}
	if ($email != NULL){
		$result = $db->query("UPDATE teacher SET email='$email' WHERE account='$account'");
	}
	if ($department != NULL){
		$result = $db->query("UPDATE teacher SET department='$department' WHERE account='$account'");
	}
	if ($specialty != NULL){
		$result = $db->query("UPDATE teacher SET specialty='$specialty' WHERE account='$account'");
	}
}
?>



