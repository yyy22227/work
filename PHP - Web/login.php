<?php
  session_start();

  if (isset($_SESSION['account'])==true){
    header("location: index.php");
    exit();
  }
?>
<!DOCTYPE HTML>
<html>
  <head>
    <title>--台 科 家 教 網--</title>
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
                <h1><a href="#" id="logo" style="color:#000000;border:3px green dotted;background-color:white">登 入</a></h1>
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
<br>
        <div class="container">
        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
            <div class="jumbotron" style="background: linear-gradient( red,  yellow)";>
            <form action="action.php" method="post">
                <div class="input-group"><input type="text" class="form-control" placeholder="Account" name="account"></div>
                <p></p>
                <div class="input-group"><input type="password" class="form-control" placeholder="Password" name="password"></div>
                <p></p><input  type="radio" name="role" value="teacher">教師
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input  type="radio" name="role" value="student">學生
                
                <p></p><button class="btn btn-primary" type="submit" name="action" value="login">Login</button>
              </form>



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