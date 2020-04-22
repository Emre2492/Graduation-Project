<?php

session_start();
require_once 'config/config.php';

if(!$_SESSION['isLoggedIn']) {
	header("location: ../index.php");    
}
elseif ($_SESSION['userAuthType'] != 3) {
	header("location: index.php");
}

require_once 'layouts/layout.header.php';
?>

<body>
	<div id="content">	
		<?php require_once 'layouts/layout.navbar.php'; ?>

		<div class="heading-buttons bg-white innerAll">
			<h1 class="content-heading padding-none pull-left">Mesajlar</h1>
			<div class="clearfix"></div>
		</div>

		<div class="innerAll spacing-x2">
				<table class="table table-bordered table-striped table-white">
					<thead>
					<tr>
						<th class="center" style="width:2%;">No.</th>
						<th style="width:23%;">Name</th>
						<th style="width:auto;">Message</th>
						<th class="text-right" style="width:8%;">Action</th>
					</tr>
					</thead>
					<tbody>
						<?php 
						$messages = Message::getGrouppedMessageList();
						$count = 1; 
						foreach($messages as $message) {
							$messageFrom = Student::getStudentByID($message->getMessageFrom());
							$image = ($messageFrom->getImage() != null) ? 'userpics/' . $messageFrom->getImage() : '../assets/images/default.png';
						?>
						<tr>
							<td class="center"><?= $count++; ?></td>
							<td> <img src="<?= $image; ?>" width="20" class="img-circle"> <span><?= $messageFrom->getName() . ' ' . $messageFrom->getSurname(); ?></span></td>
							<td><?= $message->getContent(); ?> </td>
							<td class="text-right">
								<div class="btn-group btn-group-xs ">
									<a href="show_message.php?from=<?= $messageFrom->getID(); ?>" class="btn btn-inverse"><i class="fa fa-eye"></i></a>
									<a href="delete_message.php?from=<?= $messageFrom->getID(); ?>&confirm=1" class="btn btn-danger"><i class="fa fa-times"></i></a>

								</div>
							</td>
						</tr>
						<?php } ?>
					</tbody>			
				</table>
			</div>
	</div>

	<?php require_once 'layouts/layout.footer.php';	?>
