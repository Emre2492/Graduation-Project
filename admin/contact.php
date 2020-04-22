<?php

session_start();
require_once 'config/config.php';
require_once 'config/lists.php';

if(!$_SESSION['isLoggedIn']) {
	header("location: ../index.php");    
}

require_once 'layouts/layout.header.php';

$err = false;
$isSuccess = false;
if (isset($_POST['submit'])) {
	if (empty(trim($_POST['messageBody']))) {
		$err = true;
	} else {
		$mail = new MailWorker(true);
		$logger = new Logger();

            try {
                $mail->addAddress(ADMINEMAIL);
                $mail->addReplyTo($_SESSION['email'], $_SESSION['name']." ".$_SESSION['surname']);
                $mail->Subject = "UZEM PLUS: " . $_SESSION['id'] . "'dan yeni mesaj";
                $mail->Body = "
                            Sayin yonetici,<br>
                            UZEM PLUS uzerinden size bir mesaj gonderilmistir. Kullanicinin mesaji asagidadir. Bu mesaji yanitlayarak direk kullaniciya e-mail gonderebilirsiniz.<br><br>

                            <b>Kullanici ID</b>:" . $_SESSION['id'] . "<br>" .
                            "<b>Adi Soyadi:</b>:" . $_SESSION['name']." ".$_SESSION['surname'] . "<br>" .
                            "<b>Kullanici tipi:</b>" . $userType[$_SESSION['userAuthType']] . "<br><br>" .

                            "Size gonderilen mesaj:<br>

                            <pre>
                                " . $_POST['messageBody'] . "
                            </pre>
                            <br>

                            Iyi gunler dileriz,<br>
                            UZEM PLUS
                          ";

            $mail->send();
            $logger->log("INFO", $_SESSION['id'], $_SESSION['userAuthType'],  $_SESSION['id'] . " sent an email to administrator.");

            } catch (Exception $exception) {
                echo 'Message could not be sent.';
                $logger->log("ERROR", $_SESSION['id'], $_SESSION['userAuthType'],  $_SESSION['id'] . " couldn't send an email to administrator. ERROR = " . $mail->ErrorInfo);
            }

            unset($mail);
            unset($logger);
            $isSuccess = true;
	}
}

?>

<body>
	<div id="content">	
		<?php require_once 'layouts/layout.navbar.php'; ?>
		<div class="heading-buttons bg-white innerAll">
			<h1 class="content-heading padding-none pull-left">Iletisim</h1>
			<div class="clearfix"></div>
		</div>

		<div class="innerAll spacing-x2">

			<!-- Form -->
			<form class="form-horizontal margin-none"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
	
				<!-- Widget -->
				<div class="widget widget-inverse">
	
					<!-- Widget heading -->
					<div class="widget-head">
						<h4 class="heading">Iletisim formu</h4>
					</div>
					<!-- // Widget heading END -->
		
					<div class="widget-body">
						<?php if($isSuccess): ?>
						<div class="alert alert-success">
  							<strong>Basarili!</strong> Mesajiniz tarafimiza gonderilmistir.
						</div>
						<?php endif; ?>
						<!-- Row -->
						<div class="row">
			
							<!-- Column -->
							<div class="col-md-4">
				
								<!-- Group -->
								<div class="form-group">
									<label class="col-md-4 control-label" for="firstname">Adiniz</label>
									<div class="col-md-8">
										<input class="form-control" id="firstname" name="firstname" type="text" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABHklEQVQ4EaVTO26DQBD1ohQWaS2lg9JybZ+AK7hNwx2oIoVf4UPQ0Lj1FdKktevIpel8AKNUkDcWMxpgSaIEaTVv3sx7uztiTdu2s/98DywOw3Dued4Who/M2aIx5lZV1aEsy0+qiwHELyi+Ytl0PQ69SxAxkWIA4RMRTdNsKE59juMcuZd6xIAFeZ6fGCdJ8kY4y7KAuTRNGd7jyEBXsdOPE3a0QGPsniOnnYMO67LgSQN9T41F2QGrQRRFCwyzoIF2qyBuKKbcOgPXdVeY9rMWgNsjf9ccYesJhk3f5dYT1HX9gR0LLQR30TnjkUEcx2uIuS4RnI+aj6sJR0AM8AaumPaM/rRehyWhXqbFAA9kh3/8/NvHxAYGAsZ/il8IalkCLBfNVAAAAABJRU5ErkJggg==&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;" value="<?= $_SESSION['name']; ?>" disabled>
									</div>
								</div>
								<!-- // Group END -->
					
								<!-- Group -->
								<div class="form-group">
									<label class="col-md-4 control-label" for="lastname">Soyadiniz</label>
									<div class="col-md-8">
										<input class="form-control" id="lastname" name="lastname" type="text" value="<?= $_SESSION['surname']; ?>" disabled>
									</div>
								</div>
								<!-- // Group END -->

								<!-- Group -->
								<div class="form-group">
									<label class="col-md-4 control-label" for="studentID">Ogrenci Numaraniz</label>
									<div class="col-md-8">
										<input class="form-control" id="studentID" name="studentID" type="text" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABHklEQVQ4EaVTO26DQBD1ohQWaS2lg9JybZ+AK7hNwx2oIoVf4UPQ0Lj1FdKktevIpel8AKNUkDcWMxpgSaIEaTVv3sx7uztiTdu2s/98DywOw3Dued4Who/M2aIx5lZV1aEsy0+qiwHELyi+Ytl0PQ69SxAxkWIA4RMRTdNsKE59juMcuZd6xIAFeZ6fGCdJ8kY4y7KAuTRNGd7jyEBXsdOPE3a0QGPsniOnnYMO67LgSQN9T41F2QGrQRRFCwyzoIF2qyBuKKbcOgPXdVeY9rMWgNsjf9ccYesJhk3f5dYT1HX9gR0LLQR30TnjkUEcx2uIuS4RnI+aj6sJR0AM8AaumPaM/rRehyWhXqbFAA9kh3/8/NvHxAYGAsZ/il8IalkCLBfNVAAAAABJRU5ErkJggg==&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;" value="<?= $_SESSION['id']; ?>" disabled>
									</div>
								</div>
								<!-- // Group END -->
					
							</div>
							<!-- // Column END -->
				
							<!-- Column -->
							<div class="col-md-8">
										
								<!-- Group -->
								<div class="form-group">
									<label class="col-md-4 control-label" for="email">E-mail</label>
									<div class="col-md-8">
										<input class="form-control" id="email" name="email" type="email" value="<?= $_SESSION['email']; ?>" disabled>
									</div>
								</div>
								<!-- // Group END -->

								<div class="form-group <?php if($err) echo 'has-error'; ?>">
									<label class="col-md-4 control-label" for="messageBody">Mesajiniz</label>
									<div class="col-md-8">
										<textarea class="form-control" rows="7" name="messageBody" id="messageBody"></textarea>
										<?php if($err) echo '<p class="has-error help-block">Mesaj kismi bos kalamaz</p>'; ?>
									</div>
								</div>
					
							</div>
							<!-- // Column END -->
				
						</div>
						<!-- // Row END -->						
		
						<hr class="separator">
			
						<!-- Form actions -->
						<div class="form-actions">
							<button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> Gonder</button>
							<button type="button" class="btn btn-default" onclick="location.href='index.php'"><i class="fa fa-times"></i> Vazgec</button>
						</div>
						<!-- // Form actions END -->
			
					</div>
				</div>
				<!-- // Widget END -->
	
			</form>
			<!-- // Form END -->
		</div>
	</div>
	<script src="../assets/components/modules/admin/forms/elements/inputmask/assets/lib/jquery.inputmask.bundle.min.js?v=v1.2.3"></script>
	<script src="../assets/components/modules/admin/forms/elements/inputmask/assets/custom/inputmask.init.js?v=v1.2.3"></script>
	<script src="../assets/components/modules/admin/forms/validator/assets/lib/jquery-validation/dist/jquery.validate.min.js?v=v1.2.3"></script>
	<script src="../assets/components/modules/admin/forms/validator/assets/custom/form-validator.init.js?v=v1.2.3"></script>
	<?php require_once 'layouts/layout.footer.php';	?>