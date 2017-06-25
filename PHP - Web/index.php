<?php
session_start();
//require('function.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>--台 科 家 教 網--</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="homepage">
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header">

					<!-- Inner -->
						<div class="inner">
							<header>
								<h1><a href="index.php" id="logo" style="color:orangered">台 科 家 教 網</a></h1>
								<hr />
							</header>
							<footer>
								<a href="teacher.php" class="button circled scrolly">家教列表</a>
								<a href="student.php" class="button circled scrolly">學生列表</a>
								<?php
									if(!isset($_SESSION['role'])){
										echo "<a href=# class=button style='background-color:gray' circled scrolly>刊登教案</a>";
										echo "<a href# class=button style='background-color:gray' circled scrolly>刊登學生</a>";
									}else if($_SESSION['role']=='teacher'){
										echo "<a href=add_case.php?event=teacher_case class=button circled scrolly>刊登教案</a>";
										echo "<a href=# class=button style='background-color:gray' circled scrolly>刊登學生</a>";
									}else{
										echo "<a href=# class=button  style='background-color:gray' circled scrolly>刊登教案</a>";
										echo "<a href=add_case.php?event=student_case class=button circled scrolly>刊登學生</a>";
									}
								?>
								
								
							</footer>
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