<?php
  require('function.php');

  if (!isset($_SESSION['account'])){
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
                <h1><a href="#" id="logo" style="color:#000000;border:3px green dotted;background-color:white">編 輯 資 料</a></h1>
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
        <div class = "container">
          <div class="col-md-5" >
              <table style="width:100%" id="t01">
                <tr><th><a href="<?php photo($_SESSION['account']); ?>"><img src="<?php photo($_SESSION['account']); ?>"width="300" height="300" style="border-radius:50%;"></a></th></tr>
                <tr><th><form action="upload.php" enctype="multipart/form-data" method="post">
                    選擇檔案：<input id="file" name="file" type="file">
                    <input id="submit" name="submit" type="submit" value="開始上傳">
                </form></th></tr>
                <tr><th>      
                <?php
                  name($_SESSION['account'],$_SESSION['role']);
                ?>
                </th></tr>
                <tr><th>評價：<span class="glyphicon glyphicon-star" aria-hidden="true"></span><span class="glyphicon glyphicon-star" aria-hidden="true"></span><span class="glyphicon glyphicon-star" aria-hidden="true"></span><span class="glyphicon glyphicon-star" aria-hidden="true"></span><span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span></th></tr>
                  <tr><th><?php
                  data($_SESSION['account'],$_SESSION['role']);
                  ?></th></tr>

              </table>
        </div>
        
<?php
if ($_SESSION['role']=='student'){ ?>
            <form class="form-horizontal" action="action.php" method="POST">
                <div class="input-group"><input type="text" class="form-control" placeholder="Username" name="s_name"></div>
                <p></p>
                <div class="input-group"><input type="password" class="form-control" placeholder="Password" name="s_password"></div>
                <p></p>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input  type="radio" name="s_sex" value="male">男
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input  type="radio" name="s_sex" value="female">女
                <p></p>
                <div class="input-group"><input type="text" class="form-control" placeholder="city" name="s_city"></div>
                <p></p>
                <div class="input-group"><input type="text" class="form-control" placeholder="phone" name="s_phone"></div>
                <p></p>
                <div class="input-group"><input type="text" class="form-control" placeholder="email" name="s_email"></div>
                <p></p>
                <button class="btn btn-primary" type="submit" name="action" value="s_update">update</button>
                
            </form>
<?php 
}
elseif ($_SESSION['role']=='teacher'){?>
            <form class="form-horizontal" action="action.php" method="POST">
                <div class="input-group"><input type="text" class="form-control" placeholder="Username" name="t_name"></div>
                <p></p>
                <div class="input-group"><input type="password" class="form-control" placeholder="Password" name="t_password"></div>
                <p></p>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input  type="radio" name="t_sex" value="male">男
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input  type="radio" name="t_sex" value="female">女
                <p></p>
                <div class="input-group"><input type="text" class="form-control" placeholder="city" name="t_city"></div>
                <p></p>
                <div class="input-group"><input type="text" class="form-control" placeholder="phone" name="t_phone"></div>
                <p></p>
                <div class="input-group"><input type="text" class="form-control" placeholder="email" name="t_email"></div>
                <p></p>
                <div class="input-group"><input type="text" class="form-control" placeholder="department" name="t_department"></div>
                <p></p>
                <div class="input-group"><input type="text" class="form-control" placeholder="specialty" name="t_specialty"></div>
                <p></p>                
                <button class="btn btn-primary" type="submit" name="action" value="t_update">update</button>
                
            </form>
<?php } ?>
        



<br>
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