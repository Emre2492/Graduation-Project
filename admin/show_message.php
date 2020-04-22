<?php

session_start();
require_once 'config/config.php';

if(!$_SESSION['isLoggedIn']) {
	header("location: ../index.php");
	exit();    
}
elseif ($_SESSION['userAuthType'] != 3) {
	header("location: index.php");
	exit();
}

if (empty($_GET['from'])){ 
	header("location: messages.php");
	exit();
}

if(isset($_POST['newMessage'])){
	$message = new Message();
	
	$message->setMessageFrom($_SESSION['id']);
	$message->setMessageTo($_GET['from']);
	$message->setContent($_POST['message']);
	
	$message->create();
	$messages = Message::getConversationWith($_GET['from']);

}
Message::changeStatus($_GET['from']);
require_once 'layouts/layout.header.php';
?>

<body>
	<div id="content">	
		<?php require_once 'layouts/layout.navbar.php'; ?>

		<div class="heading-buttons bg-white innerAll">
			<h1 class="content-heading padding-none pull-left">Konusma gecmisi</h1>
			<div class="clearfix"></div>
		</div>

		<div class="innerAll spacing-x2">
			<div class="widget widget-inverse widget-chat" data-builder-exclude="">

				<div class="widget-head">
					<h4 class="heading"><i class="icon-comment-fill-1"></i> Chat</h4>
				</div>
				<div class="widget-body padding-none border-bottom">
	
					<div class="slim-scroll chat-items" data-scroll-height="350px" data-scroll-size="0" style="height: 235px; overflow: hidden; outline: none;" tabindex="5004">
			
						<?php
							$messages = Message::getConversationWith($_GET['from']);
							$fromUser = Student::getStudentByID($_GET['from']);
							$fromUserPic = ($fromUser->getImage() == null) ? '../assets/images/default.png' : '../assets/images/profile_pics/' . $fromUser->getImage();
							$myPic = ($_SESSION['image'] == null) ? '../assets/images/default.png' : '../assets/images/profile_pics/' . $_SESSION['image'];

							foreach ($messages as $message) {
						?>
						<div class="media innerAll border-bottom <?php if($message->getMessageFrom() == $_SESSION['id']) echo "right"; ?>">
							<small class="author"><a href="show_user.php?id=<?= $message->getMessageFrom(); ?>&type=3" title="" class="strong"><?php if($message->getMessageFrom() == $_SESSION['id']) echo $_SESSION['name']; else echo $fromUser->getName(); ?></a></small>
							<img src="<?php if($message->getMessageFrom() == $_SESSION['id']) echo $myPic; else echo $fromUserPic; ?>" alt="" class="img-circle media-object <?php if($message->getMessageFrom() == $_SESSION['id']) echo 'pull-right'; else echo 'pull-left'; ?>" width="50px;" height="50px;">
						
							<div class="media-body">
								<small class="date"><cite><?= $message->getTimestamp(); ?></cite></small>
								<p><?= $message->getContent(); ?></p>
							</div>
						</div>
						<?php } ?>		
					</div>
					<!-- // Slim Scroll END -->
	
				</div>
	
				<div class="chat-controls bg-default innerAll half">
					<div class="">
						<form class="margin-none" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?from=' . $_GET['from']; ?>" method="post">
							<div class="input-group">
								<input type="text" name="message" class="form-control" placeholder="Mesajinizi yaziniz...">
								<div class="input-group-btn">
									<button type="submit" class="btn btn-primary" name="newMessage"><i class="fa fa-comments-o"></i></button>
								</div>
							</div>
						</form>
					</div>
				</div>
	
			</div>
		</div>
	</div>
	<?php include_once 'layouts/layout.footer.php'; ?>