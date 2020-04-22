<?php

session_start();
$pageTitle = "Anasayfa";
$pageClass = "home";

require_once 'config/config.php';

if(!$_SESSION['isLoggedIn']) {
	header("location: ../index.php");    
}

require_once 'layouts/layout.header.php';

?>
<body>
	<div id="content">	
		<?php require_once 'layouts/layout.navbar.php'; ?>

		<div class="innerAll spacing-x2">
			<div class="row">
				<div class="widget">
					<div class="row innerAll half border-bottom">
						<div class="widget-body">
							<h1>UZEM+ Hosgeldiniz Sayin <?= $_SESSION['name'] . ' ' . $_SESSION['surname']; ?></h1>
							<p style="margin-top: 15px;">
								<?php 
									switch ($_SESSION['userAuthType']) {
										case 1:
											echo '<p><b>Sevgili Rektor</b></p>
												<p>Uzem+ ‘da ders ekleme işlemleri dışında tüm işlemlerde tam yetkiye sahiphiniz.</p>';
											break;
										case 2:
											echo '<p><b>Sevgili Akademisyenler,</b></p>
													<p>Uzem+ ‘da Haftalık ders programınızı düzenleyebilir ve verdiğiniz derslerin (ödev,doküman,anket ,not girişini vb.) işlemlerinizi  gerçekleştirebilirsiniz, derse eklenmeyi bekleyen öğrencileri ders sayfası  üzerinden derse ekleyebilirsiniz.</p>';
											break;
										case 3:
											echo '<p><b>Sevgili öğrenciler,</b></p>
													<p>Haftalık ders programında yer alan saatte dersleri SENKRON(Canlı) olarak kendi fakülte veya program bağlantınıza tıklayarak takip edebilirsiniz. İlgili dersin öğretim üyelerinden herhangi birinin yüklediği ders notlarına erişip indirebilirsiniz.Dersde kayıtlı olan arkadaşlarınız ile  mesajlaşma bölümünden haberleşebilirsiniz ve dersler ile  ilgili bilgilere (ödev,duyuru,anket,ders notları..)ulaşabilirsiniz.</p>';
											break;
										case 4:
											echo '<p><b>Sevgili Bölüm Başkanı,</b></p>
													<p>Uzem+ ‘da Haftalık ders programınızı düzenleyebilir ve verdiğiniz derslerin (ödev,doküman,anket ,not girişini vb.) işlemlerinizi  gerçekleştirebilirsiniz.Ayrıca bölüm ve kitap ekleme yetkisine sahipsiniz.</p>';
											break;
										case 5:
											echo '<p><b>Sevgili Bölüm Başkanı,</b></p>
													<p>Uzem+ ‘da Haftalık ders programınızı düzenleyebilir ve verdiğiniz derslerin (ödev,doküman,anket ,not girişini vb.) işlemlerinizi  gerçekleştirebilirsiniz,ayrıca bölüm içinde ders açma yetkisine sahipsiniz.Bölüm içerinde duyuru yayınlayabilirsiniz.</p>';
											break;
										default:
											echo '';
											break;
									}
								?>
 							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php require_once 'layouts/layout.footer.php'; ?>
