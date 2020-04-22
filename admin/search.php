<?php

session_start();
require_once 'config/config.php';

if(!$_SESSION['isLoggedIn']) {
	header("location: ../index.php");    
}

if (empty($_GET['q'])){ 
	header("location: index.php");
	exit();
}

$books = Book::search($_GET['q']);
$rentalList = Book::getRentedBooksList();
$lectures = Lecture::search($_GET['q']);

require_once 'layouts/layout.header.php';
?>

<body>
	<div id="content">	
		<?php require_once 'layouts/layout.navbar.php'; ?>

		<div class="heading-buttons bg-white innerAll">
			<h1 class="content-heading padding-none pull-left">Arama sonuclari</h1>
			<div class="clearfix"></div>
		</div>

		<div class="innerAll spacing-x2">
			<div class="row">
				<div class="widget">
					<h4 class="innerAll half bg-gray border-bottom margin-bottom-none">Kitaplar</h4>
					<div class="row innerAll half border-bottom">
						<?php if(!empty($books)) { ?>
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
								?>
							</tbody>
						</table>
						<?php } else { ?>
						<div class="widget-body">
							<p><?= $_GET['q']; ?> ile ilgili kitap bulunamadi.</p>
						</div>
						<?php } ?>
						<div class="clearfix"></div>	
					</div>
				</div>
			</div>	
				
			<div class="row">
				<div class="widget">
					<h4 class="innerAll half bg-gray border-bottom margin-bottom-none">Dersler</h4>
					<div class="row innerAll half border-bottom">
						<?php if(!empty($lectures)) { ?>
						<table class="table table-striped table-white">
							<thead>
								<tr>
									<th class="center" style="width: 4%;">#</th>
									<th class="center" style="width:2%;">Ders Kodu</th>
									<th style="width:23%;">Dersi veren akademisyen</th>
									<th style="width:auto;">Dersin basligi</th>
									<th class="center" style="width:8%;">Baglanti</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$count = 1; 
								foreach ($lectures as $lecture) {
									$professor = Staff::getStaffByID($lecture->getProfessor());

									echo '<tr>'.
										'<td class="center">' . $count++ . '</td>' .
										'<td>' . $lecture->getLecCode() . '</td>' .
										'<td>' . $professor->getName() . ' ' . $professor->getSurname() . '</td>' .
										'<td>' . $lecture->getTitle() . '</td>' .
										'<td class="center"><a href="lecture_page.php?code=' . $lecture->getLecCode() . '"><i class="fa fa-eye"></i></a></td>' . 
									 '</tr>';
								}
								?>
							</tbody>
						</table>
						<?php } else { ?>
						<div class="widget-body">
							<p><?= $_GET['q']; ?> basligi ile ders bulunamadi.</p>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php require_once 'layouts/layout.footer.php';	?>