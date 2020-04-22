<?php

session_start();
require_once 'config/config.php';
require_once 'config/lists.php';
require_once 'config/helpers.php';

if(!in_array($_SESSION['userAuthType'], $accademic2)) {
	header("location: index.php");    
}	

if (empty($_GET['code'])){ 
	header("location: index.php");
	exit();
} 

$isSuccess = false;
$preConditions = true;

if (isset($_POST['submit'])) {

	if (empty(trim($_POST['title']))){
		$title_err = "Bos birakilamaz!";
		$preConditions = false;
	}

	if ($preConditions) {
		$uploadDirectory = 'uzemFiles/envs/';

    	$dotdot = ".";
   		$fileFull = $_FILES['envFile']['name'];
    	$expl = explode($dotdot, $fileFull);
    	$extension = end($expl);
    	$uploadFileName = random_filename(12, $uploadDirectory) . '.' . $extension;
    	$feedback = move_uploaded_file($_FILES['envFile']['tmp_name'], $uploadDirectory.$uploadFileName);

    	if ($feedback) {
        	$e = new Environment();
        	$e->setTitle($_POST['title']);
        	$e->setLectureCode($_GET['code']);
        	$e->setPath($uploadFileName);
        	$e->create();

			$logger = new Logger();
			$logger->log("CREATEENV", $_SESSION['id'], $_SESSION['userAuthType'], $_SESSION['id'] . " created an environment.");
			unset($logger);

			$isSuccess = true;
   		}
	}
	
}

require_once 'layouts/layout.header.php';
?>

<body>
	<div id="content">	
		<?php require_once 'layouts/layout.navbar.php'; ?>

		<div class="heading-buttons bg-white innerAll">
			<h1 class="content-heading padding-none pull-left">Materyal Olustur</h1>
			<div class="clearfix"></div>
		</div>

		<div class="innerAll spacing-x2">
			<div class="widget widget-inverse">
				<div class="widget-head">
					<h4 class="heading"><?= $_GET['code']; ?> icin yeni materyal olustur</h4>
				</div>
				<div class="widget-body">
					<?php if($isSuccess): ?>
						<div class="alert alert-success">
  							<strong>Basarili!</strong> Materyal basari ile olusturuldu
						</div>
					<?php endif; ?>
					<form method="post" action="" class="form-horizontal" role="form" enctype="multipart/form-data">

						<div class="form-group <?php echo (!empty($title_err)) ? 'has-error' : ''; ?>">
							<label class="col-sm-2 control-label" for="surname">Materyal basligi:</label>
							<div class="col-sm-5">
								<input type="text" name="title" class="form-control">
								<span class="help-block"><?php echo (!empty($title_err)) ? $title_err : ''; ?></span>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label" for="surname">Materyal dosyasini seciniz:</label>
							<div class="col-sm-10">
								<input type="file" name="envFile">
							</div>
						</div>

						<div class="row text-right">
            				<button type="submit" name="submit" class="btn btn-primary">Materyal Olustur</button>
        				</div>
					</form>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<?php require_once 'layouts/layout.footer.php';	?>