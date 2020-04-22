<?php

session_start();

if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'])
	header("location: index.php");

if(isset($_GET['loginType'])){
	$loginType = $_GET['loginType'];
	switch ($loginType) {
		case 1:
			$loginTypeName = "Akademisyen";
			break;
		case 2:
		default:
			$loginTypeName = "Öğrenci";
			break;
	}
} else {
	$loginType = 2;
	$loginTypeName = "Öğrenci";
}
require_once 'config/config.php';

if(isset($_POST["giris"])){
	if(empty(trim($_POST["usernumber"]))){ 
		$usernumber_err = 'Lütfen kullanıcı ID\'izi giriniz.';
	} else {
		$usernumber = $_POST["usernumber"];
	}

	if(empty(trim($_POST['password']))){
		$password_err = 'Lütfen kullancı şifrenizi giriniz.';
	} else {
		$password = md5($_POST['password']);
	}

	if(empty($usernumber_err) && empty($password_err)){
		$logger = new Logger();
		if ($loginType == 1 && Staff::authUser($usernumber, $password)) {
										
			$user = Staff::getStaffInfoAsArrayByEmail($usernumber);
			
			foreach ($user as $key => $value) {
				$_SESSION[$key] = $value;
			}

			$_SESSION['userAuthType'] = $user['type'];
			$_SESSION['isLoggedIn'] = true;
			$logger->log("LOGIN", $user['id'], $user['type'], $user['id'] . " logged in.");
			$logger = null;

			header("location: index.php");
		} elseif ($loginType == 2 && Student::authUser($usernumber, $password)) {
			$user = Student::getStudentInfoAsArray($usernumber);
			
			foreach ($user as $key => $value) {
				$_SESSION[$key] = $value;
			}
			
			$_SESSION['userAuthType'] = 3;
			$_SESSION['isLoggedIn'] = true;
			$logger->log("LOGIN", $user['id'], 3, $user['id'] . " logged in.");
			$logger = null;

			header("location: index.php");
		} else {
			$login_err = "Giriş yapılamadı!";
		}
	}
}
?>
<html>
<head>
	<title>UZEM</title>
	
	<!-- Meta -->
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />
	
	<link rel="stylesheet" href="../assets/css/admin/module.admin.page.login.min.css" />
	
	<script src="../assets/components/library/jquery/jquery.min.js?v=v1.2.3"></script>
	<script src="../assets/components/library/jquery/jquery-migrate.min.js?v=v1.2.3"></script>
	<script src="../assets/components/library/modernizr/modernizr.js?v=v1.2.3"></script>
	<script src="../assets/components/plugins/less-js/less.min.js?v=v1.2.3"></script>
	<script src="../assets/components/modules/admin/charts/flot/assets/lib/excanvas.js?v=v1.2.3"></script>
	<script src="../assets/components/plugins/browser/ie/ie.prototype.polyfill.js?v=v1.2.3"></script>	
</head>
<body class=" loginWrapper">
	<div id="content">
		<h4 class="innerAll margin-none border-bottom text-center"><i class="fa fa-lock"></i> Uzem <?= $loginTypeName; ?> Girişi</h4>

		<div class="login spacing-x2">
			
			<div class="placeholder text-center">
				<img src="../assets/images/logo.png" width="350" height="150">
			</div>
			<div class="col-sm-6 col-sm-offset-3">
				<div class="panel panel-default">
					<div class="panel-body innerAll">
		  				<form action="" method="post">
		  	  				<div class="form-group <?php echo (!empty($usernumber_err)) ? 'has-error' : ''; ?>">
			    				<label for="exampleInputNumber1"><?= $loginTypeName; ?> ID</label>
			    				<input type="text"  name="usernumber" class="form-control" value="" id="exampleInputNumber1" placeholder="<?= $loginTypeName; ?> ID">
								<!--Email </label><input type=\"email\"  name=\"usernumber\" class=\"form-control\" value=\"$_COOKIE[usernumber]\" id=\"exampleInputNumber1\" placeholder=\"Email\">";
								?>-->
		    			
						 		<span class="help-block"><?php echo (!empty($usernumber_err)) ? $usernumber_err : ''; ?></span>
			  				</div>
			  				<div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
			    				<label for="exampleInputPassword1">Şifre</label>
			    				<input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Şifre" value="">
								<span class="help-block"><?php echo (!empty($password_err)) ? $password_err : ''; ?></span>
			  				</div>
			  				<input type="submit" name="giris" id="giris" class="btn btn-primary btn-block" value="Giriş" ><br>
								<a href="../index.php" class="btn btn-primary btn-block ">Geri</a><br>
					 		<div>
								<span class="psw"><a href="new_password.php">Şifremi unuttum</a></span>
							</div>
		  					<div class="checkbox">
			    				<label>
			      					<input name="hatirla" type="checkbox">Beni Hatırla
		    					</label>
			  				</div>					
						</form>
		  			</div>
				</div>
			</div>
			<?php if($loginType == 2): ?>
			<div class="col-sm-6 col-sm-offset-3 text-center">
				
			</div>
			<?php endif; ?>
		</div>
	</div>	
	<script>
	var basePath = '',
		commonPath = 'assets/',
		rootPath = '.',
		DEV = false,
		componentsPath = 'assets/components/';
	
	var primaryColor = '#cb4040',
		dangerColor = '#b55151',
		infoColor = '#466baf',
		successColor = '#8baf46',
		warningColor = '#ab7a4b',
		inverseColor = '#45484d';
	
	var themerPrimaryColor = primaryColor;
	</script>
	
	<script src="../assets/components/library/bootstrap/js/bootstrap.min.js?v=v1.2.3"></script>
	<script src="../assets/components/plugins/nicescroll/jquery.nicescroll.min.js?v=v1.2.3"></script>
	<script src="../assets/components/plugins/breakpoints/breakpoints.js?v=v1.2.3"></script>
	<script src="../assets/components/core/js/animations.init.js?v=v1.2.3"></script>
	<script src="../assets/components/helpers/themer/assets/plugins/cookie/jquery.cookie.js?v=v1.2.3"></script>
	<script src="../assets/components/core/js/core.init.js?v=v1.2.3"></script>	
</body>
</html>