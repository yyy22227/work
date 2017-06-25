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
							<header>
								<?php echo "<h1><a href=# id=logo style='color:#000000;border:3px green dotted;background-color:white'>個 人 資 料</a></h1>";	?>
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
						<?php 
							$conn  = mysqli_connect('sql305.byethost7.com','b7_20212335','asdf0147','b7_20212335_team6');
							mysqli_set_charset($conn,"utf8");
							$sql = "SELECT * FROM {$_GET['member_type']} WHERE id = {$_GET['member_id']}";
							$result = $conn->query($sql);
							while($mes = $result->fetch_assoc()){

        						echo "<div class = 6u>";
						
								?><a href="#" class="image fit"><img src="<?php echo $mes['photo_path'] ?>" width="350" height="350" style="border-radius:50%; alt="" /></a><?php
								echo "</div>";
								echo "<br>";
								
								
								echo "<table style='color:green;border:3px #FFAC55 dashed;padding:5px; rules=all cellpadding=5;text-align:center;background-color:pink'>";
								echo "<tr><td style=padding:15px align=center ></td></tr>";
								echo "<tr><td style=padding:15px;align=center;font-size:40px>姓名:{$mes['name']}</td></tr>";
								echo "<tr><td style=padding:15px;align=center;font-size:40px>性別:{$mes['gender']}</td></tr>";
								echo "<tr><td style=padding:15px;align=center;font-size:40px>城市:{$mes['city']}</td></tr>";
								echo "<tr><td style=padding:15px;align=center;font-size:40px>信箱:{$mes['email']}</td></tr>";
								if($_GET['member_type']=='teacher'){
									echo "<tr><td style=padding:15px;align=center;font-size:40px>科系:{$mes['department']}</td></tr>";
									echo "<tr><td style=padding:15px;align=center;font-size:40px>專長:{$mes['specialty']}</td></tr>";
								}
								
								echo "</table>";

								
								
								echo "</div>";

							}
							$result = $conn->query($sql);
						?>
				</section>
			</div>
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
							