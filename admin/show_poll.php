<?php 

session_start();
require_once 'config/config.php';

if (empty($_GET['id'])){ 
	header("location: index.php");
	exit();
}

if(!$_SESSION['isLoggedIn']) {
	header("location: index.php");    
}

$poll = Poll::getPollByID($_GET['id']);
$pollAnswers = Pollanswer::getAnswersByPollID($poll->getID());

switch ($_SESSION['userAuthType']) {
	case 1:
	case 2:
	case 4:
	case 5:
		$mode = 'acc';
		break;
	
	case 3:
		$mode = 'stu';
		break;
}

$isSuccess = false;
if (isset($_POST['submit'])) {
	foreach ($_POST as $key => $value) {
		if(is_numeric($key))
		{
			Pollanswer::upvote($key, $value);
		}
	}
	$logger = new Logger();
	$logger->log("ANSPOLL", $_SESSION['id'], $_SESSION['userAuthType'], $_SESSION['id'] . ", answered a poll (" . "id=" . $_GET['id'] .")");
	unset($logger);
	$isSuccess = true;
}

require_once 'layouts/layout.header.php';
?>

<body>
	<div id="content">	
		<?php require_once 'layouts/layout.navbar.php'; ?>

		<div class="heading-buttons bg-white innerAll">
			<h1 class="content-heading padding-none pull-left">Anket</h1>
			<div class="clearfix"></div>
		</div>

		<div class="innerAll spacing-x2">
			<div class="row">
				<div class="widget">
					<h4 class="innerAll half bg-gray border-bottom margin-bottom-none"><?= $poll->getTitle(); ?></h4>
					<div class="row innerAll half border-bottom">
						<div class="widget-body">
						<?php if(!empty($pollAnswers)){
							if($mode == 'acc'){	
							?>
							<table class="table table-striped table-white">
								<thead>
									<tr>
										<th>#</th>
										<th>Baslik</th>
										<th>1</th>
										<th>2</th>
										<th>3</th>
										<th>4</th>
										<th>5</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$count = 1;
									foreach ($pollAnswers as $ans) {
										echo '<tr>'.
											'<td>' . $count++ . '</td>' .	
											'<td>' . $ans->getTitle() . '</td>' .
											'<td>' . $ans->getOne() . '</td>' .
											'<td>' . $ans->getTwo() . '</td>' .
											'<td>' . $ans->getThree() . '</td>' .
											'<td>' . $ans->getFour() . '</td>'.
											'<td>' . $ans->getFive() . '</td>' 
											;
									}
									?>
								</tbody>
							</table>
							<?php } elseif($mode == 'stu') { ?>
							<?php if($isSuccess): ?>
								<div class="alert alert-success">
  									<strong>Basarili!</strong> Anket cevaplariniz basari ile gonderildi.
								</div>
							<?php endif; ?>
							<form action="" method="post">
								<table class="table table-striped table-white">
									<thead>
										<tr>
											<th>#</th>
											<th>Baslik</th>
											<th>1</th>
											<th>2</th>
											<th>3</th>
											<th>4</th>
											<th>5</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$count = 1;
										foreach ($pollAnswers as $ans): ?>
										<tr>
											<td><?= $count++; ?></td>
											<td><?= $ans->getTitle(); ?></td>
											<td><input type="radio" name="<?= $ans->getID(); ?>" value="one"></td>
											<td><input type="radio" name="<?= $ans->getID(); ?>" value="two"></td>
											<td><input type="radio" name="<?= $ans->getID(); ?>" value="three"></td>
											<td><input type="radio" name="<?= $ans->getID(); ?>" value="four"></td>
											<td><input type="radio" name="<?= $ans->getID(); ?>" value="five"></td>
										</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
								<button class="btn btn-primary pull-right" name="submit" type="submit">Gonder</button>
							</form>
							<?php }
							} else 
								echo '<p>Herhangi bir anket sorusu bulunmamakta</p>'; 
							?>
							<?php if ($mode == 'acc') { ?>
								<a href="add_pollq.php?id=<?= $_GET['id']; ?>" class="btn btn-primary pull-right">Yeni soru ekle</a>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php require_once 'layouts/layout.footer.php';	?>


