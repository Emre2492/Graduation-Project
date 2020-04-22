<?php

session_start();
require_once 'config/config.php';
require_once 'config/lists.php';

if(!$_SESSION['isLoggedIn']) {
	header("location: ../index.php");    
}

if (empty($_GET['id'])){ 
	header("location: library.php");
	exit();
}

require_once 'layouts/layout.header.php';
$book = Book::getBookByID($_GET['id']);
$detailedList = Book::getDetailedRentedInfo($_GET['id']);
?>
<body>
	<div id="content">	
		<?php require_once 'layouts/layout.navbar.php'; ?>

		<div class="heading-buttons bg-white innerAll">
			<h1 class="content-heading padding-none pull-left">Kitap Bilgileri</h1>
			<div class="clearfix"></div>
		</div>

		<div class="innerAll spacing-x2">
			<div class="widget">
				<h4 class="innerAll half bg-gray border-bottom margin-bottom-none"><?= $book->getTitle(); ?></h4>
				<div class="row innerAll half border-bottom">
					<div class="col-md-8">
					<?php
						echo '<ul class="list-unstyled">' .
							 	'<li><b>Baslik:</b> ' . $book->getTitle() . '</li>' .
							 	'<li><b>ISBN:</b> ' . $book->getISBN() . '</li>' .
							 	'<li><b>Yazar:</b> ' . $book->getAuthor() . '</li>' .
							 	'<li><b>Yayinci:</b> ' . $book->getPublisher() . '</li>' 
						;
						if(!empty($detailedList))
							echo '<li><b>Iade Tarihi:</b> ' . $detailedList['returnDate'] . '</li>';
						if ($detailedList['userEmail'] == $_SESSION['email'] && $detailedList['returnDate'] < date("Y-m-d"))
							echo '<li><b style="color: red">KITAP TESLIM TARIHI GECMIS!!!</b></li>';
						if ($_SESSION['userAuthType'] == 1 || $_SESSION['userAuthType'] == 4) 
							echo '<li><b><a href="edit_book.php?id=' . $_GET['id'] . '">Kitabi duzenle</a></b></li>' .
								 '<li><b><a href="book_handle.php?id=' . $_GET['id'] . '&action=0">Kitabi sil</a></b></li>';
						echo '</ul>'
					?>
					</div>
					<script type="text/javascript">
						function bookHandler(path, params) {
							// https://stackoverflow.com/questions/133925/javascript-post-request-like-a-form-submit
    						method = "post"; // Set method to post by default if not specified.

    						// The rest of this code assumes you are not using a library.
    						// It can be made less wordy if you use one.
    						var form = document.createElement("form");
    						form.setAttribute("method", method);
    						form.setAttribute("action", path);

    						for(var key in params) {
        						if(params.hasOwnProperty(key)) {
            						var hiddenField = document.createElement("input");
            						hiddenField.setAttribute("type", "hidden");
            						hiddenField.setAttribute("name", key);
            						hiddenField.setAttribute("value", params[key]);

            						form.appendChild(hiddenField);
        						}
    						}

    						document.body.appendChild(form);
    						form.submit();
						}
					</script>
					<div style="padding-right: 5px;">
						<span class="pull-right">
							<?php if(!empty($detailedList) && $detailedList['userEmail'] != $_SESSION['email']) { ?>
							<a nohref class="display-block innerAll inner-2x bg-inverse">
								<span class="display-block text-center">
									<i class="fa fa-fw fa-3x fa-ban text-white"></i>
									<p class="strong innerT text-condensed text-medium text-white margin-none">Kitap alinamaz</p>
									<p class="text-normal margin-none strong text-white">Bu kitap baska<br> bir kullanici tarafindan alinmis</p>
								</span>
							</a>
							<?php } elseif (!empty($detailedList) && $detailedList['userEmail'] == $_SESSION['email']) { ?>
							<a nohref class="display-block innerAll inner-2x bg-primary" onclick="bookHandler('book_handle.php', {'userEmail': '<?= $_SESSION['email']; ?>' , 'bookID': '<?= $_GET['id']; ?>' , 'type' : 'return'})">
								<span class="display-block text-center">
									<i class="fa fa-fw fa-3x fa-exchange text-white"></i>
									<p class="strong innerT text-condensed text-medium text-white margin-none">Iade Et</p>
									<p class="text-normal margin-none strong text-white">Kitabi iade etmek icin <br> tiklayin</p>
								</span>
							</a>
							<?php } else { ?>
							<a nohref class="display-block innerAll inner-2x bg-success" onclick="bookHandler('book_handle.php', {'userEmail': '<?= $_SESSION['email']; ?>' , 'bookID': '<?= $_GET['id']; ?>' , 'type' : 'rent'})">
								<span class="display-block text-center">
									<i class="fa fa-fw fa-3x fa-plus text-white"></i>
									<p class="strong innerT text-condensed text-medium text-white margin-none">Kitabi kirala</p>
									<p class="text-normal margin-none strong text-white">Bu kitabi <br>15 gunlugune kirala</p>
								</span>
							</a>
							<?php } ?>
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php require_once 'layouts/layout.footer.php';	?>