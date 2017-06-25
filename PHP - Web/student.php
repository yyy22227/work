<!DOCTYPE HTML>
<?php session_start() ?>
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
								<h1><a href="#" id="logo" style="color:#000000;border:3px green dotted;background-color:white">學 生 列 表</a></h1>
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
										class Cases{
											var $subject;
											var $city;
											var $time;
											var $salary;
											var $status;
											var $details;
											var $student_id;
											var $case_id;
											var $name;

											function __construct($a,$b,$c,$d,$e,$f,$g,$h,$n){
												$this->subject = $a;
												$this->city = $b;
												$this->time = $c;
												$this->salary = $d;
												$this->status = $e;
												$this->details = $f;
												$this->student_id = $g;
												$this->case_id = $h;
												$this->name = $n;
											}
											function show(){
													echo "<td style=padding:15px>".$this->subject."</td>";
													echo "<td style=padding:15px>".$this->name."</td>";
													echo "<td style=padding:15px>".$this->city."</td>";
													echo "<td style=padding:15px>".$this->time."</td>";
													echo "<td style=padding:15px>".$this->salary."</td>";
													echo "<td style=padding:15px>".$this->status."</td>";
													echo "<td style=padding:15px>"."<input type='button' value='查看更多'onclick=location.href='show_case.php?member_id={$this->student_id}&case_type=student_case&case_id=$this->case_id&member_type=student'>"."</td>";
													echo "</tr style=padding:15px>";
											}
											}
										$student_case = array();
											$conn  = mysqli_connect('sql305.byethost7.com','b7_20212335','asdf0147','b7_20212335_team6');
											$sql = "SELECT * FROM student_case;";
											mysqli_set_charset($conn,"utf8");
											$result = mysqli_query($conn, $sql);

											while($row = $result->fetch_assoc()){
												$sql = "SELECT * FROM student WHERE id ={$row['student_id']}";
												$result2=mysqli_query($conn,$sql);
												$row2 = $result2->fetch_assoc();
											$temp = new Cases($row['subject'],$row['city'],$row['case_time']
											,$row['salary'],$row['status'],$row['details'],$row['student_id'],$row['id'],$row2['name']);
												array_push($student_case,$temp);
											}
											
											echo "-----目前總共有 ".$result->num_rows." 筆案例-----";
											echo "<div class = container>";
												echo "<table>";
												echo "<tr>";
												echo "<th style=padding:15px;background-color:yellow>科目";
												echo "<th style=padding:15px;background-color:yellow>學生";
												echo "<th style=padding:15px;background-color:yellow>城市";
												echo "<th style=padding:15px;background-color:yellow>授課時段";
												echo "<th style=padding:15px;background-color:yellow>薪資";
												echo "<th style=padding:15px;background-color:yellow>狀態";
												echo "<th style=width:30px>";
												echo "</tr>";

											foreach($student_case as $m){
												$m->show();     
											}
											echo "</table>";

											mysqli_close($conn);
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