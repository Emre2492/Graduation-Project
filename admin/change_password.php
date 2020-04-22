<?php

session_start();
require_once 'config/config.php';
require_once 'config/lists.php';
require_once 'config/helpers.php';

if(!$_SESSION['isLoggedIn']) {
	header("location: ../index.php");    
}
$user = User::getUserByID($_SESSION['id'], $_SESSION['userAuthType']);
$preConditions = true;
$isSuccess = false;


if (isset($_POST['submit'])) {
	if (empty(trim($_POST['first']))){
		$first_err = "Bos birakilamaz!";
		$preConditions = false;
	}

	if (empty(trim($_POST['second']))){
		$second_err = "Bos birakilamaz!";
		$preConditions = false;
	}

	if($_POST['first'] != $_POST['second']){
		$first_err = $second_err = "Sifreler birbirleri ile uyusmuyor!";
		$preConditions = false;
	}

	if ($preConditions) {
		$user->setPassword(md5($_POST['first']));
		
		$user->update();
		$logger = new Logger();
		$logger->log("UPDATEPASS", $_SESSION['id'], $_SESSION['userAuthType'], $_SESSION['id'] . " updated their password.");
		unset($logger);

		$isSuccess = true;
	}
}
require_once 'layouts/layout.header.php';
?>

<body>
	<div id="content">	
		<?php require_once 'layouts/layout.navbar.php'; ?>

		<div class="heading-buttons bg-white innerAll">
			<h1 class="content-heading padding-none pull-left">Sifremi degistir</h1>
			<div class="clearfix"></div>
		</div>

		<div class="innerAll spacing-x2">
			<div class="widget widget-inverse">
				<div class="widget-head">
					<h4 class="heading">Yeni sifre bilgileri</h4>
				</div>
				<div class="widget-body">
					<?php if($isSuccess): ?>
						<div class="alert alert-success">
  							<strong>Basarili!</strong> Sifreniz basari ile degistirildi.
						</div>
					<?php endif; ?>
					<form method="post" action="" class="form-horizontal" role="form">
						<div class="form-group <?php echo (!empty($first_err)) ? 'has-error' : ''; ?>">
							<label class="col-sm-2 control-label" for="first">Yeni sifreniz:</label>
							<div class="col-sm-10">
								<input type="password" id="first" name="first" placeholder="Yeni sifreniz" class="form-control">
								<span class="help-block"><?php echo (!empty($first_err)) ? $first_err : ''; ?></span>
							</div>
						</div>

						<div class="form-group <?php echo (!empty($second_err)) ? 'has-error' : ''; ?>">
							<label class="col-sm-2 control-label" for="second">Yeni sifrenizi tekrar yaziniz:</label>
							<div class="col-sm-10">
								<input type="password" id="second" name="second" class="form-control" placeholder="Yeni sifreniz tekrar">
								<span class="help-block"><?php echo (!empty($second_err)) ? $second_err : ''; ?></span>
							</div>
						</div>

						<div class="row text-right">
            				<button type="submit" name="submit" class="btn btn-primary">Sifremi Guncelle</button>
        				</div>
					</form>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<?php require_once 'layouts/layout.footer.php';	?>