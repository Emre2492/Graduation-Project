<?php

session_start();
require_once 'config/config.php';
require_once 'config/lists.php';

if(!in_array($_SESSION['userAuthType'], $accademic2)) {
	header("location: index.php");    
}

if (empty($_GET['id'])){ 
	header("location: index.php");
	exit();
}

$poll = Poll::getPollByID($_GET['id']);
$preConditions = true;
$isSuccess = false;

if (isset($_POST['submit'])) {

	if (empty(trim($_POST['title']))){
		$title_err = "Bos birakilamaz!";
		$preConditions = false;
	}

	if ($preConditions) {
		$tempObj = new Pollanswer();
		$tempObj->setTitle($_POST['title']);
		$tempObj->setPollID($poll->getID());
		$tempObj->create();
		
		$logger = new Logger();
		$logger->log("CREATEPOLLQ", $_SESSION['id'], $_SESSION['userAuthType'], $_SESSION['id'] . " created a poll question");
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
			<h1 class="content-heading padding-none pull-left">Yeni Anket Sorusu Ekle</h1>
			<div class="clearfix"></div>
		</div>

		<div class="innerAll spacing-x2">
			<div class="widget widget-inverse">
				<div class="widget-head">
					<h4 class="heading">#<?= $poll->getID(); ?> icin soru ekle</h4>
				</div>
				<div class="widget-body">
					<?php if($isSuccess): ?>
						<div class="alert alert-success">
  							<strong>Basarili!</strong> Anket sorusu basari ile olusturuldu!. <a href="show_poll.php?id=<?= $poll->getID(); ?>">Anketi goruntule</a>
						</div>
						<?php endif; ?>
					<form method="post" action="" class="form-horizontal" role="form">
						
						<div class="form-group">
							<label class="col-sm-2 control-label">Soru eklenecek anket:</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" value="<?= $poll->getTitle(); ?>" disabled>
							</div>
						</div>

						<div class="form-group <?php echo (!empty($title_err)) ? 'has-error' : ''; ?>">
							<label class="col-sm-2 control-label" for="title">Soru basligi:</label>
							<div class="col-sm-10">
								<input type="text" id="title" name="title" class="form-control" placeholder="Soru basligi giriniz">
								<span class="help-block"><?php echo (!empty($title_err)) ? $title_err : ''; ?></span>
							</div>
						</div>

						<div class="row text-right">
            				<button type="submit" name="submit" class="btn btn-primary">Anket sorusu Ekle</button>
        				</div>
					</form>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<?php require_once 'layouts/layout.footer.php';	?>