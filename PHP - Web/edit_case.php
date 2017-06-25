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
									echo "<h1><a href=# id=logo style='color:#000000;border:3px green dotted;background-color:white'>老 師 案 件 編 輯</a></h1>";
								else if($_GET['case_type']=='student_case')
									echo "<h1><a href=# id=logo style='color:#000000;border:3px green dotted;background-color:white'>學 生 案 件 編 輯</a></h1>";
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


    <div class="12u 12u(mobile) important(mobile)" id="content" style="text-align:center">

		<article id="main">
		    <header>
				<div class ="w3-container w3-red">
					<div class="container">
						<?php
							if(isset( $_GET['case_type'])!=true || !isset($_SESSION['role'])){
								header( "location:index.php");
							}
							
							echo "<form action='action.php'>";
							switch($_GET['case_type']){
								case 'teacher_case':
									if($_SESSION['role']=='student')
										header( "location:index.php");
									echo "<h1 style=font-size:60px;background-color:pink;color:black>教 師 案 件 編 輯</h1>";		
									break;
								case 'student_case':
									if($_SESSION['role']=='teacher')
										header( "location:index.php");
									echo "<h1 style=font-size:60px;background-color:pink;color:white>學 生 案 件 編 輯</h1>";
									break;
							}

								$conn  = mysqli_connect('sql305.byethost7.com','b7_20212335','asdf0147','b7_20212335_team6');
								mysqli_set_charset($conn,"utf8");
							
								$sql = "SELECT * FROM {$_GET['case_type']} WHERE id = {$_GET['case_id']};";
									$result = $conn->query($sql);
									while($mes = $result->fetch_assoc()){
										echo "<input type ='textarea' name='case_type' value={$_GET['case_type']} style='display:none'>"."</textarea>";
										echo "<input type ='textarea' name='case_id' value={$_GET['case_id']} style='display:none'>"."</textarea>";
										echo "<input type ='textarea' name='event' value='edit_case' style='display:none'>"."</textarea>";
										echo "<br>";
										echo "<input type='text' name='subject' placeholder='科目' value={$mes['subject']}>";
										echo "<br>";
										echo "<input type='text' name='city' placeholder='城市' value={$mes['city']}>";
										echo "<br>";
										echo "<input type='text' name='case_time' placeholder='時間' value={$mes['case_time']}>";
										echo "<br>";
										echo "<input type='text' name='salary' placeholder= '薪資' value={$mes['salary']}>";
										echo "<br>";
										echo "<center><textarea name='details' cols='50' rows='5' placeholder='請輸入詳細資訊...'>{$mes['details']}</textarea>";
										echo "<input type='submit' value='送出'>";
										echo "</form>";
									}
								
							?>
						</div>
					</div>
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
							