<?php

session_start();
require_once 'config/config.php';

if(!($_SESSION['userAuthType'] == 1 || $_SESSION['userAuthType'] == 4)) {
	header("location: index.php");    
}

if (empty($_GET['id'])){ 
	header("location: library.php");
	exit();
}	

$book = Book::getBookByID($_GET['id']);
$preConditions = true;
$isSuccess = false;

if (isset($_POST['submit'])) {
	if (empty(trim($_POST['title']))){
		$title_err = "Bos birakilamaz";
		$preConditions = false;
	}

	if (empty($_POST['isbn'])){
		$isbn_err = "Bos birakilamaz!";
		$preConditions = false;
	}

	if (empty($_POST['author'])){
		$author_err = "Bos birakilamaz!";
		$preConditions = false;
	}

	if (empty($_POST['publisher'])){
		$publisher_err = "Bos birakilamaz!";
		$preConditions = false;
	}

	if ($preConditions) {
		$book->setTitle($_POST['title']);
		$book->setAuthor($_POST['author']);
		$book->setISBN($_POST['isbn']);
		$book->setPublisher($_POST['publisher']);
		$book->update();

		$logger = new Logger();
		$logger->log("UPDATEBOOK", $_SESSION['id'], $_SESSION['userAuthType'], $_SESSION['id'] . ", updated a book (id=" . $book->getID() . ", isbn=" . $book->getISBN() .")");
		unset($logger);

		$isSuccess = true;
		$book = Book::getBookByID($_GET['id']);
	}

}

require_once 'layouts/layout.header.php';
?>

<body>
	<div id="content">	
		<?php require_once 'layouts/layout.navbar.php'; ?>

		<div class="heading-buttons bg-white innerAll">
			<h1 class="content-heading padding-none pull-left">Kitap duzenle</h1>
			<div class="clearfix"></div>
		</div>

		<div class="innerAll spacing-x2">
			<div class="widget widget-inverse">
				<div class="widget-head">
					<h4 class="heading">Kitabin bilgilerini duzenle</h4>
				</div>
				<div class="widget-body">
					<?php if($isSuccess): ?>
						<div class="alert alert-success">
  							<strong>Basarili!</strong> Kitap bilgileri basari ile degistirildi!.
						</div>
						<?php endif; ?>
					<form method="post" action="" class="form-horizontal" role="form">

						<div class="form-group <?php echo (!empty($isbn_err)) ? 'has-error' : ''; ?>">
							<label class="col-sm-2 control-label" for="isbn">ISBN:</label>
							<div class="col-sm-10">
								<input type="text" id="isbn" name="isbn" placeholder="Kitabin ISBN no. giriniz" class="form-control" value="<?= $book->getISBN(); ?>">
								<span class="help-block"><?php echo (!empty($isbn_err)) ? $isbn_err : ''; ?></span>
							</div>
						</div>
						
						<div class="form-group <?php echo (!empty($title_err)) ? 'has-error' : ''; ?>">
							<label class="col-sm-2 control-label" for="title">Kitap basligi:</label>
							<div class="col-sm-10">
								<input type="text" id="title" name="title" placeholder="Kitabin adini giriniz" class="form-control" value="<?= $book->getTitle(); ?>">
								<span class="help-block"><?php echo (!empty($title_err)) ? $title_err : ''; ?></span>
							</div>
						</div>

						<div class="form-group <?php echo (!empty($author_err)) ? 'has-error' : ''; ?>">
							<label class="col-sm-2 control-label" for="author">Yazar:</label>
							<div class="col-sm-10">
								<input type="text" id="author" name="author" placeholder="Kitabin yazar adini giriniz" class="form-control" value="<?= $book->getAuthor(); ?>">
								<span class="help-block"><?php echo (!empty($author_err)) ? $author_err : ''; ?></span>
							</div>
						</div>

						<div class="form-group <?php echo (!empty($author_err)) ? 'has-error' : ''; ?>">
							<label class="col-sm-2 control-label" for="publisher">Yayinci:</label>
							<div class="col-sm-10">
								<input type="text" id="publisher" name="publisher" placeholder="Kitabin yazar adini giriniz" class="form-control" value="<?= $book->getPublisher(); ?>">
								<span class="help-block"><?php echo (!empty($publisher_err)) ? $publisher_err : ''; ?></span>
							</div>
						</div>

						<div class="row text-right">
            				<button type="submit" name="submit" class="btn btn-primary">Kitabi Guncelle</button>
        				</div>
					</form>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<?php require_once 'layouts/layout.footer.php';	?>
