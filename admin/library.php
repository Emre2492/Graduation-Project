<?php
//https://stackoverflow.com/questions/8307963/increase-current-date-by-5-days

session_start();
require_once 'config/config.php';

if(!$_SESSION['isLoggedIn']) {
	header("location: ../index.php");    
}

$searchMode = false;
$books = Book::getLastBooks(25);
$rentalList = Book::getRentedBooksList();

if(isset($_POST['submit']) && !empty(trim($_POST['bookName']))){
	$searchMode = true;
	$books = Book::search($_POST['bookName']);
}

require_once 'layouts/layout.header.php';
?>

<body>
	<div id="content">	
		<?php require_once 'layouts/layout.navbar.php'; ?>

		<div class="heading-buttons bg-white innerAll">
			<h1 class="content-heading padding-none pull-left"><?= SITENAME; ?> Kutuphane</h1>
			<div class="clearfix"></div>
		</div>

		<div class="innerAll spacing-x2">
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
				<div class="input-group innerB">
      				<input type="text" class="form-control" placeholder="Bir kitap arayin" name="bookName">
      				<span class="input-group-btn">
        				<button class="btn btn-primary rounded-none" type="submit" name="submit"><i class="fa fa-search"></i></button>
      				</span>
				</div>
			</form>

			<div class="row">
				<div class="widget">
					<h4 class="innerAll half bg-gray border-bottom margin-bottom-none"><?php if ($searchMode) echo 'Arama sonuclariniz'; else echo 'Yeni eklenen kitaplarimiz'; ?></h4>
					<div class="row innerAll half border-bottom">
						<div class="widget-body">
							<?php if(!empty($books)){ ?>
							<table class="table table-striped table-white">
								<thead>
									<tr>
										<th class="center" style="width: 4%;">#</th>
										<th class="center" style="width:2%;">ISBN</th>
										<th style="width:23%;">Yazar</th>
										<th style="width:auto;">Baslik</th>
										<th style="width:auto;">Yayinci</th>
										<th style="width: auto;">Uygun?</th>
										<th class="center" style="width:8%;">Baglanti</th>
									</tr>
								</thead>
								<tbody>
									<?php 			
										foreach ($books as $book) {
											$isAvailable = (in_array($book->getID(), $rentalList)) ? '<i class="fa fa-times"></i>' : '<i class="fa fa-check"></i>';
											echo '<tr>'.
											 	'<td>' . $book->getID() . '</td>' .
											 	'<td>' . $book->getISBN() . '</td>' .
											 	'<td>' . $book->getAuthor() . '</td>' .
											 	'<td>' . $book->getTitle() . '</td>' .
											 	'<td>' . $book->getPublisher() . '</td>' .
											 	'<td class="center">' . $isAvailable . '</td>' .
											 	'<td class="center"><a href="show_book.php?id=' . $book->getID() . '"><i class="fa fa-eye"></i></a></td>' .
												 '</tr>'
											;
										}
									} else {
										echo "<p>Aradiginiz kitap bulunamadi!</p>";
									}
								?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>

	<?php require_once 'layouts/layout.footer.php';	?>