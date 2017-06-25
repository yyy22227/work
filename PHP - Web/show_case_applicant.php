<?php session_start()?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>台科家教網</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body class="container">
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header">

					<!-- Inner -->
						<div class="inner">
							
								<h1><a href="#" id="logo" style="color:#000000;border:3px green dotted;background-color:white">申 請 列 表</a></h1>
							
							
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
						<div class="12u 12u(mobile) important(mobile)" id="content" style="text-align:center">
							<article id="main">
								<header>
									<?php
									if(!isset($_SESSION['role'])){
										echo "------------------------------------------無資料------------------------------------------";
									}else if($_SESSION['role']=='student'){
											$conn = mysqli_connect('sql305.byethost7.com','b7_20212335','asdf0147','b7_20212335_team6');
											mysqli_set_charset($conn,"utf8");
											
											$sql = "SELECT * FROM student_case_applicant";
											$result = $conn->query($sql);
											
											echo "-----目前總共有 "."N"." 筆"."學生"."案例-----";
											echo "<div class = container>";
											echo "<table>";
											echo "<tr>";
											echo "<th style=padding:15px>會員ID";
											echo "<th style=padding:15px>案件ID";
											echo "<th style=padding:15px>申請ID";
											echo "<th style=padding:15px>姓名";
											echo "<th style=padding:15px>性別";
											echo "<th style=padding:15px>電話";
											echo "<th style=padding:15px>日期";
											echo "<th>狀態";
											echo "<th style=width:30px>";


											while($r = $result->fetch_assoc()){
												echo "</tr>";
												echo "<td style=padding:15px>".$r['id']."</td>";
												echo "<td style=padding:15px>".$r['case_id']."</td>";
												echo "<td style=padding:15px>".$r['applicant_id']."</td>";

												$sql = "SELECT * FROM teacher WHERE id={$r['applicant_id']}";
												$result2 = $conn->query($sql);
												$applicant = $result2->fetch_assoc();

												echo "<td style=padding:15px>".$applicant['name']."</td>";
												echo "<td style=padding:15px>".$applicant['gender']."</td>";
												echo "<td style=padding:15px>".$applicant['phone']."</td>";
												echo "<td style=padding:15px>".$r['application_time']."</td>";
												
												

												$sql = "SELECT * FROM student_case WHERE id={$r['case_id']}";
												$result3 = $conn->query($sql);
												$c =  $result3->fetch_assoc();

												if($c['status']=='完成'){
													echo "<td style=padding:15px>"."案件已完成"."</td>";
													echo "<td style=padding:15px>"."<input type='button' value='取消申請' onclick=location.href='action.php?event=cancel_application&&case_id={$r['case_id']}&&applicant_id={$r['applicant_id']}&&case_type=student'>"."</td>";
												}else{
													echo "<td style=padding:15px>"."<input type='button' value='確認申請' onclick=location.href='action.php?event=confirm_application&&case_id={$r['case_id']}&&applicant_id={$r['applicant_id']}&&case_type=student'>"."</td>";
												}
												
												
											}
											echo "</table>";
											mysqli_close($conn);

										}else if($_SESSION['role']=='teacher'){
											$conn = mysqli_connect('sql305.byethost7.com','b7_20212335','asdf0147','b7_20212335_team6');
											mysqli_set_charset($conn,"utf8");
											$sql = "SELECT * FROM teacher_case_applicant";
											$result = $conn->query($sql);
											
											echo "-----"."老師"."案例-----";
											echo "<div class = container>";
											echo "<table>";
											echo "<tr>";
											echo "<th style=padding:15px>會員ID";
											echo "<th style=padding:15px>案件ID";
											echo "<th style=padding:15px>申請ID";
											echo "<th style=padding:15px>姓名";
											echo "<th style=padding:15px>性別";
											echo "<th style=padding:15px>電話";
											echo "<th style=padding:15px>日期";
											echo "<th>狀態";
											echo "<th style=width:30px>";


											while($r = $result->fetch_assoc()){
												echo "</tr>";
												echo "<td style=padding:15px>".$r['id']."</td>";
												echo "<td style=padding:15px>".$r['case_id']."</td>";
												echo "<td style=padding:15px>".$r['applicant_id']."</td>";

												$sql = "SELECT * FROM student WHERE id={$r['applicant_id']}";
												$result2 = $conn->query($sql);
												$applicant = $result2->fetch_assoc();

												echo "<td style=padding:15px>".$applicant['name']."</td>";
												echo "<td style=padding:15px>".$applicant['gender']."</td>";
												echo "<td style=padding:15px>".$applicant['phone']."</td>";
												echo "<td style=padding:15px>".$r['application_time']."</td>";
												
												

												$sql = "SELECT * FROM teacher_case WHERE id={$r['case_id']}";
												$result3 = $conn->query($sql);
												$c =  $result3->fetch_assoc();

												if($c['status']=='完成'){
													echo "<td style=padding:15px>"."案件已完成"."</td>";
													echo "<td style=padding:15px>"."<input type='button' value='取消申請' onclick=location.href='action.php?event=cancel_application&&case_id={$r['case_id']}&&applicant_id={$r['applicant_id']}&&case_type=teacher'>"."</td>";
												}else{
													echo "<td style=padding:15px>"."<input type='button' value='確認申請' onclick=location.href='action.php?event=confirm_application&&case_id={$r['case_id']}&&applicant_id={$r['applicant_id']}&&case_type=teacher'>"."</td>";
												}
												
												
											}
											echo "</table>";
											mysqli_close($conn);

										}else{
											echo "------------------------------------------無資料------------------------------------------";
										}

									?>
								</header>
								
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

