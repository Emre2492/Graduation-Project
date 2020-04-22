<?php

session_start();
require_once 'config/config.php';
require_once 'config/lists.php';

if(!in_array($_SESSION['userAuthType'], $accademic2)) {
	header("location: index.php");    
}	

if($_SESSION['userAuthType'] == 1){
	$pollTo = "ALL";
}

elseif ($_SESSION['userAuthType'] == 4) {
	$faculty = Faculty::findStaffFaculty($_SESSION['id']);
	$pollTo = $faculty['abbr'];
}

elseif ($_SESSION['userAuthType'] == 5){
	$department = Department::findStaffDepartment($_SESSION['id']);
	$pollTo = $department['abbr'];
}

else {
	$pollTo = $_GET['lecCode'];
}

$preConditions = true;
$isSuccess = false;

if (isset($_POST['submit'])) {
	if (empty(trim($_POST['title']))){
		$title_err = "Bos birakilamaz!";
		$preConditions = false;
	}

	if ($preConditions) {
		$tempObj = new Poll();

		$tempObj->setTitle($_POST['title']);
		$tempObj->setPollTo($pollTo);

		$pollID = $tempObj->create();

		$logger = new Logger();
		$logger->log("CREATEPOLL", $_SESSION['id'], $_SESSION['userAuthType'], $_SESSION['id'] . " created a poll (" . $_POST['title'] . ")");
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
			<h1 class="content-heading padding-none pull-left">Yeni Anket Ekle</h1>
			<div class="clearfix"></div>
		</div>

		<div class="innerAll spacing-x2">
			<div class="widget widget-inverse">
				<div class="widget-head">
					<h4 class="heading">Anket Bilgileri</h4>
				</div>
				<div class="widget-body">
					<?php if($isSuccess): ?>
						<div class="alert alert-success">
  							<strong>Basarili!</strong> Anket basari ile olusturuldu!.
						</div>
						<?php endif; ?>
					<form method="post" action="" class="form-horizontal" role="form">
						
						<div class="form-group <?php echo (!empty($title_err)) ? 'has-error' : ''; ?>">
							<label class="col-sm-2 control-label" for="title">Anket Basligi</label>
							<div class="col-sm-10">
								<input type="text" id="title" name="title" placeholder="Orn: Merhaba Dunya" class="form-control">
								<span class="help-block"><?php echo (!empty($title_err)) ? $title_err : ''; ?></span>
							</div>
						</div>

						<div class="row text-right">
            				<button type="submit" name="submit" class="btn btn-primary">Anket Ekle</button>
        				</div>
					</form>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<?php require_once 'layouts/layout.footer.php';	?>
