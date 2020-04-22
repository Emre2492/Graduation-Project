<?php

session_start();
require_once 'config/config.php';
require_once 'config/lists.php';

if(!$_SESSION['isLoggedIn']) {
	header("location: ../index.php");    
}
$user = User::getUserByID($_SESSION['id'], $_SESSION['userAuthType']);
$preConditions = true;
$isSuccess = false;


if (isset($_POST['submit'])) {
	if (empty(trim($_POST['name']))){
		$name_err = "Ad bos birakilamaz";
		$preConditions = false;
	}

	if (empty(trim($_POST['surname']))){
		$surname_err = "Soyad bos birakilamaz";
		$preConditions = false;
	}

	if (empty(trim($_POST['email']))){
		$email_err = "Eposta bos birakilamaz";
		$preConditions = false;
	}

	if ($preConditions) {
		$user->setName($_POST['name']);
		$user->setSurname($_POST['surname']);
		$user->setEmail($_POST['email']);
		
		if ($_SESSION['userAuthType'] != 3 && !empty($_POST['office'])) {
			$user->setRoom($_POST['office']);
		}
		
		$user->update();
		$logger = new Logger();
		$logger->log("UPDATEPROFILE", $_SESSION['id'], $_SESSION['userAuthType'], $_SESSION['id'] . " updated their profile.");
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
			<h1 class="content-heading padding-none pull-left">Profilimi duzenle</h1>
			<div class="clearfix"></div>
		</div>

		<div class="innerAll spacing-x2">
			<div class="widget widget-inverse">
				<div class="widget-head">
					<h4 class="heading">Bilgilerim</h4>
				</div>
				<div class="widget-body">
					<?php if($isSuccess): ?>
						<div class="alert alert-success">
  							<strong>Basarili!</strong> Kullanici bilgileri basari ile guncellendi! Sistemde tamami ile etkin olabilmesi icin lutfen yeniden oturum aciniz.
						</div>
					<?php endif; ?>
					<form method="post" action="" class="form-horizontal" role="form">
						<div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
							<label class="col-sm-2 control-label" for="name">Kullanici adi:</label>
							<div class="col-sm-10">
								<input type="text" id="name" name="name" placeholder="Kullanicinin adini giriniz" class="form-control" value="<?= $user->getName(); ?>">
								<span class="help-block"><?php echo (!empty($name_err)) ? $name_err : ''; ?></span>
							</div>
						</div>

						<div class="form-group <?php echo (!empty($surname_err)) ? 'has-error' : ''; ?>">
							<label class="col-sm-2 control-label" for="surname">Kullanici soyadi:</label>
							<div class="col-sm-10">
								<input type="text" id="surname" name="surname" placeholder="Kullanicinin soyadini giriniz" class="form-control" value="<?= $user->getSurname(); ?>">
								<span class="help-block"><?php echo (!empty($surname_err)) ? $surname_err : ''; ?></span>
							</div>
						</div>

						<div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
							<label class="col-sm-2 control-label" for="email">Kullanici e-posta adresi:</label>
							<div class="col-sm-10">
								<input type="text" id="email" name="email" placeholder="Orn: aaaa@bbb.com" class="form-control" value="<?= $user->getEmail(); ?>">
								<span class="help-block"><?php echo (!empty($email_err)) ? $email_err : ''; ?></span>
							</div>
						</div>

						<div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
							<label class="col-sm-2 control-label" for="email">Kullanici sifresi:</label>
							<div class="col-sm-10">
								<a href="change_password.php" class="btn btn-primary">Sifrenizi degistirmek icin tiklayiniz</a>
							</div>
						</div>

						<?php if ($_SESSION['userAuthType'] != 3): ?>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="office">Ofis:</label>
							<div class="col-sm-10">
								<input type="text" id="office" name="office" placeholder="Orn: A315" class="form-control" value="<?= $user->getRoom(); ?>">
							</div>
						</div>
						<?php endif; ?>

						<div class="row text-right">
            				<button type="submit" name="submit" class="btn btn-primary">Bilgilerimi Guncelle</button>
        				</div>
					</form>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<?php require_once 'layouts/layout.footer.php';	?>