<?php
session_start();
require('function.php');


if($_FILES['file']['error']>0){
  exit("檔案上傳失敗！");
}

move_uploaded_file($_FILES["file"]["tmp_name"],iconv("utf-8", "big5", 'file/'.$_SESSION['account'].'.jpg'));
echo '<a href="file/'.$_FILES['file']['name'].'">file/'.$_FILES['file']['name'].'</a>';

$tmp='file/'.$_SESSION['account'].'.jpg';
$account=$_SESSION['account'];
$db = db_connection();
if ($_SESSION['role']=='teacher'){
	echo "$tmp";
	$result = $db->query("UPDATE teacher SET photo_path='$tmp' WHERE account='$account'");
}
elseif ($_SESSION['role']=='student') {
	$result = $db->query("UPDATE student SET photo_path='$tmp' WHERE account='$account'");
}

header('location:update.php');
?>