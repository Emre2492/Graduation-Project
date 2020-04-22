<?php

session_start();

if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'])
	header("location: index.php");

require_once 'config/config.php';

$isSuccess = false;

if(isset($_POST['submit'])){
	if(empty(trim($_POST["userEmail"]))){ 
		$useremail_err = 'Lütfen kullanıcı ID\'izi giriniz.';
	}

	elseif (!User::checkIfRegistered($_POST["userEmail"], $_POST['userType'])) {
	 	$useremail_err = 'Bu eposta ile kayitli kullanici bulunamadi!';
	 } 

	else {
		$userEmail = $_POST["userEmail"];
		User::resetPassword($userEmail, $_POST['userType']);
		$isSuccess = true;
		$logger = new Logger();
		$logger->log("INFO", User::getUserByEmail($userEmail, $_POST['userType'])->getID(), $_POST['userType'], "Password reset");
		unset($logger);
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
		<h4 class="innerAll margin-none border-bottom text-center"><i class="fa fa-lock"></i> Uzem Sifremi Unuttum</h4>

		<div class="login spacing-x2">
			
			<div class="placeholder text-center">
				<img src="../assets/images/logo.png" width="350" height="150">
			</div>
			<div class="col-sm-6 col-sm-offset-3">
				<div class="panel panel-default">
					<div class="panel-body innerAll">
						<?php if($isSuccess): ?>
						<div class="alert alert-success">
  							<strong>Basarili!</strong> Yeni sifreniz e-posta adresinize gonderildi.
						</div>
						<?php endif; ?>
		  				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		  	  				<div class="form-group <?php echo (!empty($useremail_err)) ? 'has-error' : ''; ?>">
			    				<label for="userEmail">Kullanici e-posta adresi</label>
			    				<input type="text"  name="userEmail" class="form-control" value="" id="userEmail" placeholder="E-posta adresi">		    			
						 		<span class="help-block"><?php echo (!empty($useremail_err)) ? $useremail_err : ''; ?></span>
			  				</div>
			  				<div class="form-group">
			  					<label>Kullanici tipini seciniz</label>
			  					<div class="radio">
									<label class="form-check-label" for="ogrenci">
										<input class="form-check-input" type="radio" name="userType" id="student" value="student" checked>
    									Ogrenci
									</label>
								</div>
								<div class="radio">
									<label class="form-check-label" for="akademisyen">
										<input class="form-check-input" type="radio" name="userType" id="staff" value="staff">
    									Akademisyen
									</label>
								</div>
							</div>
							<input type="submit" name="submit" id="submit" class="btn btn-primary btn-block" value="Yeni Sifre Olustur" ><br>
							<a href="javascript:history.back()" class="btn btn-primary btn-block ">Geri</a><br>			
						</form>
		  			</div>
				</div>
			</div>
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