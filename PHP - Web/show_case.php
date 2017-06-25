<?php
  session_start();

?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>台科家教網</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->


		<script>
			function check_delete(){
				if(confirm("視窗內文字")){
					//var value="abc";   
					//location.href="delete_case.php?value=" value;
					
					var case_id = "<?php echo $_GET['case_id'] ?>";
					var case_type = "<?php echo $_GET['case_type'] ?>";
					var value = "action.php?case_type="+case_type+"&case_id="+case_id+"&event=delete_case";
					
					location.replace(value);
				}else{
					alert("你按下取消");
				}
			}
			
			</script>
	</head>
	<body class="container">
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header">

					<!-- Inner -->
						<div class="inner">
							<header>
							<?php
								if($_GET['case_type']=='teacher_case')
									echo "<h1><a href=# id=logo style='color:#000000;border:3px green dotted;background-color:white'>老 師 案 件</a></h1>";
								else if($_GET['case_type']=='student_case')
									echo "<h1><a href=# id=logo style='color:#000000;border:3px green dotted;background-color:white'>學 生 案 件</a></h1>";
							?>							
							</header>
						</div>

					<!-- Nav -->
						<nav id="nav">
							<ul>
								<li><a href="index.php" id="top_menu">首頁</a></li>
								
								<li>
									<a href="#">選擇功能</a>
									<ul>
										<li><a href="teacher.php" id="top_menu">家教列表</a></li>
										<li><a href="student.php" id="top_menu">學生列表</a></li>
										<?php
											if(!isset($_SESSION['role'])){
											}else if($_SESSION['role']=='teacher'){
												echo "<li>"."<a href=add_case.php?event=teacher_case >刊登教案</a>"."</li>";
											}else{
												echo "<li>"."<a href=add_case.php?event=student_case >刊登學生</a>"."</li>";
											}
										?>
									</ul>
								</li>

								<?php
								if(!isset($_SESSION['account'])){
								?>
								<li><a href="login.php">登入</a></li>
								<li><a href="register.php">註冊</a></li>
    							<?php
    							}
    							else{
    							?>

                				<li><a href="personal_card.php">個人資料</a></li>
                				<li><a href="logout.php">登出</a></li>
								<?php } ?>
							</ul>
						</nav>

				</div>


	<div class="wrapper style1" align="center">
		<div class="container" >
			<div class="8u 12u(mobile)" id="sidebar">
				<hr class="first" />
					<section>
						<header>
							<h3><a href="#" style='font-size:50px'>～　案 件 人　～</a></h3>
						</header>
						<?php 
							$conn  = mysqli_connect('sql305.byethost7.com','b7_20212335','asdf0147','b7_20212335_team6');
							mysqli_set_charset($conn,"utf8");
							$sql = "SELECT * FROM {$_GET['member_type']} WHERE id = {$_GET['member_id']}";
							$result = $conn->query($sql);
							
							while($mes = $result->fetch_assoc()){
								echo "<div class = row 50%>";
        						echo "<div class = 5u>";
								?>
									<a href="#" class="image fit"><img src="<?php echo $mes['photo_path'] ?>" width="300" height="300" style="border-radius:50%; alt="" /></a>
								<?php
								echo "<h4>".$mes['name']."</h4>";
								echo "</div>";
								echo "<div class=6u>";
								echo "<br/>";
								echo "案件人ID:".$mes['id']."<br>";
								echo "性別:".$mes['gender']."<br>";
								echo "城市:".$mes['city']."<br>";
								echo "<input type = 'button' value= '更多資訊' onclick=location.href='card.php?member_type={$_GET['member_type']}&member_id={$_GET['member_id']}'>";
								echo "</div>";
								echo "</div>";

							}
							$result = $conn->query($sql);
						?>
				</section>
			</div>
		</div>
	</div>
	

	<div class="wrapper style1" align="center">
		<div class="container" >
			<div class="8u 12u(mobile)" id="content" >
				<article id="main">
					<section>
						<header>
							<h3><a href="#" style='font-size:50px'>～　案 件 資 訊　～</a></h3>
						</header>
							<?php
								$conn  = mysqli_connect('sql305.byethost7.com','b7_20212335','asdf0147','b7_20212335_team6');
								mysqli_set_charset($conn,"utf8");
							
								$sql = "SELECT * FROM {$_GET['case_type']} WHERE id = {$_GET['case_id']};";
									$result = $conn->query($sql);
									while($mes = $result->fetch_assoc()){
										$case_status = $mes['status'];
										echo "<table style='color:black;text-align:center'>";
										echo "<tr><td style=padding:15px align=center ></td></tr>";
										echo "<tr><td style=padding:15px;align=center;font-size:40px>科目:{$mes['subject']}</td></tr>";
										echo "<tr><td style=padding:15px;align=center;font-size:40px>城市:{$mes['city']}</td></tr>";
										echo "<tr><td style=padding:15px;align=center;font-size:40px>授課時段:{$mes['case_time']}</td></tr>";
										echo "<tr><td style=padding:15px;align=center;font-size:40px>薪資:{$mes['salary']}</td></tr>";
										echo "<tr><td style=padding:15px;align=center;font-size:40px>狀態:{$mes['status']}</td></tr>";
										echo "<tr><td style=padding:15px;align=center;font-size:40px>細節:{$mes['details']}</td></tr>";
										echo "</table>";
								}

								
								

								if(!isset($_SESSION['role'])){
									echo "<br>--未登入--<br>";
								}else if($_GET['case_type']=='teacher_case'){
									$sql = "SELECT * FROM teacher_case_applicant WHERE case_id={$_GET['case_id']}&&applicant_id={$_SESSION['id']};";
									$result = $conn->query($sql);
								}else{
									$sql = "SELECT * FROM student_case_applicant WHERE case_id={$_GET['case_id']}&&applicant_id={$_SESSION['id']};";
									$result = $conn->query($sql);
								}
								
								if(!isset($_SESSION['role'])){}
								else if($_SESSION['role']==$_GET['member_type'] && $_SESSION['id']==$_GET['member_id']){
									echo "<input type='button' style='background-color:blue' value='查看申請者'
									onclick=location.href='show_case_applicant.php'> ";
									echo "<input type='button' style='background-color:green' value='修改案件'
									onclick=location.href='edit_case.php?member_id={$_GET['case_id']}&case_type={$_GET['case_type']}&case_id={$_GET['case_id']}&member_type={$_GET['member_type']}'> ";				
									echo "<input type='button' style='background-color:red' value='刪除案件' onclick='check_delete()'>";
								}else if($case_status!='尋找中'){
									$check = $result->fetch_assoc();
									if($check['status']=='完成'){
										$sql = "SELECT * FROM {$_GET['member_type']} WHERE id = {$_GET['member_id']}";
										$result2 = $conn->query($sql);
										$mes = $result2->fetch_assoc();
										echo "<br>--已得標--<br>";
										echo "案件人手機：".$mes['phone'];
									}else{
										echo "<br>--已結束--<br>";
									}
								}else if($result->num_rows==1 && $_GET['member_type']!=$_SESSION['role']){
										echo "<br>--已申請--<br>";
								}else if($_SESSION['role']==$_GET['member_type']){
										echo "<br>--身分相同無法申請--<br>";
								}else{
									echo "<input type='button' value='提交申請'
									onclick=location.href='action.php?event=add_case_applicant&case_id={$_GET['case_id']}&member_id={$_GET['member_id']}&case_type={$_GET['case_type']}&member_type={$_GET['member_type']}'>"."<br>";
								}
							$result = $conn->query($sql);
							?>
					</section>
				</article>
			</div>
		</div>
	</div>


	<div class="wrapper style1" align="center">
		<div class="container" >	
			<header>
				<a href="#" style='font-size:50px'>～　留 言 板　～</a></h3>
			</header>
				<article class="6u 12u(mobile) special">
						<section>
							<?php $message = array();
								include_once('mess.php');

								$conn  = mysqli_connect('sql305.byethost7.com','b7_20212335','asdf0147','b7_20212335_team6');
								mysqli_set_charset($conn,"utf8");


								$sql = "SELECT * FROM teacher_message WHERE case_type = '{$_GET['case_type']}'&&case_id ='{$_GET['case_id']}';";
								$result_teacher1 = mysqli_query($conn, $sql);
            
								while($row = $result_teacher1->fetch_assoc()){
									$sql = "SELECT * FROM teacher WHERE id = {$row['teacher_id']};";
									$result_teacher2 = mysqli_query($conn, $sql);
									$name = $result_teacher2->fetch_assoc();
									
									if($_GET['case_type']=='teacher_case' && $row['teacher_id']==$_GET['member_id'])
										$temp = new Message($name['name'],$row['message_time'],$row['content'],1,$name['photo_path']);
									else
										$temp = new Message($name['name'],$row['message_time'],$row['content'],2,$name['photo_path']);
										
									//$temp = new Message($name['name'],$row['message_time'],$row['content'],$f);
									array_push($message,$temp);
								}
                
                
								$sql = "SELECT * FROM student_message WHERE case_type = '{$_GET['case_type']}'&&case_id='{$_GET['case_id']}';";
								$result_student1 = mysqli_query($conn, $sql);

								while($row = $result_student1->fetch_assoc()){
									$sql = "SELECT * FROM student WHERE id = {$row['student_id']};";
									$result_student2 = mysqli_query($conn, $sql);
									$name = $result_student2->fetch_assoc();

									if($_GET['case_type']=='student_case' && $row['student_id']==$_GET['member_id'])
										$temp = new Message($name['name'],$row['message_time'],$row['content'],1,$name['photo_path']);
									else
										$temp = new Message($name['name'],$row['message_time'],$row['content'],2,$name['photo_path']);
										
									//$temp = new Message($name['name'],$row['message_time'],$row['content'],$f);
									array_push($message,$temp);
								}

                				sort($message);

                				foreach($message as $m){
                    				$m->show();
                				}

								//確認是否登入
								if(isset($_SESSION['account'])){
									echo "<form action='action.php'>";
									echo "Content:"."<input type ='textarea' name='content'>"."</textarea>";
									echo "<input type ='textarea' name='event' value='add_message' style='display:none'>"."</textarea>";
									echo "<input type ='textarea' name='member_id' value='{$_GET['member_id']}' style='display:none'>"."</textarea>";
									echo "<input type ='textarea' name='case_type' value='{$_GET['case_type']}' style='display:none'>"."</textarea>";
									echo "<input type ='textarea' name='case_id' value='{$_GET['case_id']}' style='display:none'>"."</textarea>";
									echo "<input type ='textarea' name='member_type' value='{$_GET['member_type']}' style='display:none'>"."</textarea>";
									echo "<input type = 'submit' >";
									echo "</form>";
								}else{
									echo "-----------------------登入後才可留言-----------------------";
								}
								

 								mysqli_close($conn);
							 ?>

							
						</section>
					</div>
				</div>
			</article>
		</div>
	</div>


	

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/jquery.onvisible.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>
							