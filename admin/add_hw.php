<?php

session_start();
require_once 'config/config.php';
require_once 'config/lists.php';

if(!in_array($_SESSION['userAuthType'], $accademic2)) {
	header("location: index.php");    
}	

if (empty($_GET['code'])){ 
	header("location: index.php");
	exit();
}

$preConditions = true;
$isSuccess = false;
$lecture = $_GET['code'];

if (isset($_POST['submit'])) {

	if (empty(trim($_POST['content']))){
		$content_err = "Bos birakilamaz";
		$preConditions = false;
	}

	if (empty(trim($_POST['title']))){
		$title_err = "Bos birakilamaz";
		$preConditions = false;
	}

	if (empty($_POST['dueDate'])){
		$dean_err = "Bos birakilamaz!";
		$preConditions = false;
	}

	if ($preConditions) {
		$assignment = new Assignment();
		$assignment->setTitle($_POST['title']);
		$assignment->setContent($_POST['content']);
		$assignment->setDueDate($_POST['dueDate']);
		$assignment->setLecCode($lecture);

		$assignment->create();
		$logger = new Logger();
		$logger->log("CREATEHW", $_SESSION['id'], $_SESSION['userAuthType'], $_SESSION['id'] . " created " . $assignment->getID());
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
			<h1 class="content-heading padding-none pull-left">Odev Olustur</h1>
			<div class="clearfix"></div>
		</div>

		<div class="innerAll spacing-x2">
			<div class="widget widget-inverse">
				<div class="widget-head">
					<h4 class="heading">Yeni odev bilgileri</h4>
				</div>
				<div class="widget-body">
					<?php if($isSuccess): ?>
						<div class="alert alert-success">
  							<strong>Basarili!</strong> Odev basari ile olusturuldu.
						</div>
						<?php endif; ?>
					<form method="post" action="" class="form-horizontal" role="form">
						

						<div class="form-group <?php echo (!empty($title_err)) ? 'has-error' : ''; ?>">
							<label class="col-sm-2 control-label" for="title">Odev Basligi</label>
							<div class="col-sm-10">
								<input type="text" id="title" name="title" placeholder="Odev Basligi" class="form-control" >
								<span class="help-block"><?php echo (!empty($title_err)) ? $title_err : ''; ?></span>
							</div>
						</div>

						<div class="form-group <?php echo (!empty($duedate_err)) ? 'has-error' : ''; ?>">
							<label class="col-sm-2 control-label" for="dean">Son Teslim Tarihi</label>
							<div class="col-sm-10">
								<input id="date" type="date" name="dueDate" class="form-control">
								<span class="help-block"><?php echo (!empty($duedate_err)) ? $duedate_err : ''; ?></span>
							</div>
						</div>

						<div class="form-group">
							
						</div>

						<div class="form-group <?php echo (!empty($content_err)) ? 'has-error' : ''; ?>">
							<label class="col-sm-2 control-label" for="title">Odev Icerigi</label>
							<div class="col-sm-10">
								<textarea class="form-control" name="content" rows="8"></textarea>
								<span class="help-block"><?php echo (!empty($content_err)) ? $title_err : ''; ?></span>
							</div>
						</div>

						<div class="row text-right">
            				<button type="submit" name="submit" class="btn btn-primary">Odev olustur</button>
        				</div>
					</form>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<?php require_once 'layouts/layout.footer.php';	?>