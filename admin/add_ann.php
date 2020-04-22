<?php

session_start();
require_once 'config/config.php';
require_once 'config/lists.php';

if(!in_array($_SESSION['userAuthType'], $management)) {
	header("location: index.php");    
}	

$preConditions = true;
$isSuccess = false;

switch ($_SESSION['userAuthType']) {
	case 1:
		$annTo = "ALL";
		break;	

	case 4:
		$faculty = Faculty::findStaffFaculty($_SESSION['id']);
		$annTo = $faculty['abbr'];
		break;

	case 5:
		$department = Department::findStaffDepartment($_SESSION['id']);
		$annTo = $department['abbr'];
		break;
	
	default:
		# code...
		break;
}

if (isset($_POST['submit'])) {
	if (empty(trim($_POST['annContent']))){
		$content_err = "Bos birakilamaz!";
		$preConditions = false;
	}

	if (empty(trim($_POST['title']))){
		$title_err = "Bos birakilamaz";
		$preConditions = false;
	}

	if ($preConditions) {
		$tempObj = new Announce();

		$tempObj->setTitle($_POST['title']);
		$tempObj->setContent($_POST['annContent']);
		$tempObj->setAnnTo($annTo);

		$tempObj->create();
		$logger = new Logger();
		$logger->log("CREATEANN", $_SESSION['id'], $_SESSION['userAuthType'], $_SESSION['id'] . " created an announcement (" . $_POST['title'] . ")");
		unset($logger);

		$isSuccess = true;
	}

}

require_once 'layouts/layout.header.php';
?>

<body>
	
	<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=x21cdnet82w9w2ewrqy12iaze2tx8nqcqcxgwr5uvwsbnneh"></script>
	<script>tinymce.init({ selector:'textarea' });</script>
	<div id="content">	
		<?php require_once 'layouts/layout.navbar.php'; ?>

		<div class="heading-buttons bg-white innerAll">
			<h1 class="content-heading padding-none pull-left">Yeni Duyuru Ekle</h1>
			<div class="clearfix"></div>
		</div>

		<div class="innerAll spacing-x2">
			<div class="widget widget-inverse">
				<div class="widget-head">
					<h4 class="heading">Duyuru Bilgileri</h4>
				</div>
				<div class="widget-body">
					<?php if($isSuccess): ?>
						<div class="alert alert-success">
  							<strong>Basarili!</strong> Duyuru basari ile olusturuldu!.
						</div>
						<?php endif; ?>
					<form method="post" action="" class="form-horizontal" role="form">
						
						<div class="form-group <?php echo (!empty($title_err)) ? 'has-error' : ''; ?>">
							<label class="col-sm-2 control-label" for="title">Duyuru Basligi</label>
							<div class="col-sm-10">
								<input type="text" id="title" name="title" placeholder="Orn: Merhaba Dunya" class="form-control">
								<span class="help-block"><?php echo (!empty($title_err)) ? $title_err : ''; ?></span>
							</div>
						</div>

						<div class="form-group <?php echo (!empty($content_err)) ? 'has-error' : ''; ?>">
							<label class="col-sm-2 control-label" for="title">Duyuru Icerigi</label>
							<div class="col-sm-10">
								<textarea class="form-control" name="annContent" rows="8"></textarea>
								<span class="help-block"><?php echo (!empty($content_err)) ? $title_err : ''; ?></span>
							</div>
						</div>

						<div class="row text-right">
            				<button type="submit" name="submit" class="btn btn-primary">Duyuru Ekle</button>
        				</div>
					</form>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<?php require_once 'layouts/layout.footer.php';	?>