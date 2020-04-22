<?php

session_start();
require_once 'config/config.php';

if($_SESSION['userAuthType'] != 1) {
	header("location: index.php");    
}	

$preConditions = true;
$isSuccess = false;

if (isset($_POST['submit'])) {
	if (empty(trim($_POST['abbr']))){
		$abbr_err = "Bos birakilamaz";
		$preConditions = false;
	}

	if (empty(trim($_POST['title']))){
		$title_err = "Bos birakilamaz";
		$preConditions = false;
	}

	if (empty($_POST['dean'])){
		$dean_err = "Bos birakilamaz!";
		$preConditions = false;
	}

	if ($preConditions) {
		$tempObj = new Faculty();
		$tempObj->setAbbr($_POST['abbr']);
		$tempObj->setTitle($_POST['title']);
		$tempObj->setDean($_POST['dean']);

		$tempObj->create();
		$logger = new Logger();
		$logger->log("CREATEFACULTY", $_SESSION['id'], $_SESSION['userAuthType'], $_SESSION['id'] . " created " . $_POST['abbr']);
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
			<h1 class="content-heading padding-none pull-left">Yeni Fakulte Ekle</h1>
			<div class="clearfix"></div>
		</div>

		<div class="innerAll spacing-x2">
			<div class="widget widget-inverse">
				<div class="widget-head">
					<h4 class="heading">Yeni Fakulte Bilgileri</h4>
				</div>
				<div class="widget-body">
					<?php if($isSuccess): ?>
						<div class="alert alert-success">
  							<strong>Basarili!</strong> Yeni fakulte basari ile olusturuldu!.
						</div>
						<?php endif; ?>
					<form method="post" action="" class="form-horizontal" role="form">
						
						<div class="form-group <?php echo (!empty($abbr_err)) ? 'has-error' : ''; ?>">
							<label class="col-sm-2 control-label" for="abbr">Fakulte Kodu</label>
							<div class="col-sm-10">
								<input type="text" id="abbr" name="abbr" placeholder="Orn: ENSCI" class="form-control">
								<span class="help-block"><?php echo (!empty($abbr_err)) ? $abbr_err : ''; ?></span>
							</div>
						</div>

						<div class="form-group <?php echo (!empty($title_err)) ? 'has-error' : ''; ?>">
							<label class="col-sm-2 control-label" for="title">Fakulte Basligi</label>
							<div class="col-sm-10">
								<input type="text" id="title" name="title" placeholder="Orn: Engineering and Natural Sciences" class="form-control">
								<span class="help-block"><?php echo (!empty($title_err)) ? $title_err : ''; ?></span>
							</div>
						</div>

						<div class="form-group <?php echo (!empty($dean_err)) ? 'has-error' : ''; ?>">
							<label class="col-sm-2 control-label" for="dean">Fakulte Dekani</label>
							<div class="col-sm-10">
								<select class="form-control" name="dean">
									<option disabled selected value="NA">Bir dekan seciniz</option>
									<?php
										$staffList = Staff::readAll(); 

										foreach ($staffList as $staff):
									?>
										<option value="<?= $staff->getID(); ?>"><?= $staff->getName() . ' ' . $staff->getSurname(); ?></option>
									<?php endforeach;?>
								</select>
								<span class="help-block"><?php echo (!empty($dean_err)) ? $dean_err : ''; ?></span>
							</div>
						</div>

						<div class="row text-right">
            				<button type="submit" name="submit" class="btn btn-primary">Fakulte Olustur</button>
        				</div>
					</form>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<?php require_once 'layouts/layout.footer.php';	?>