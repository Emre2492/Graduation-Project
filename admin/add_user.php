<?php

session_start();
require_once 'config/config.php';
require_once 'config/lists.php';
require_once 'config/helpers.php';

if($_SESSION['userAuthType'] != 1) {
	header("location: index.php");    
}

$preConditions = true;
$isSuccess = false;
$randPass = "";
$id = "";

if(isset($_GET['type'])) {
	$mode = true;

	switch ($_GET['type']) {
		case 1:
			$widgetHead = "Yeni calisan ekle";
			$type = 1;

			if (isset($_POST['submit'])) {
				if (empty(trim($_POST['name']))){
					$name_err = "Ad bos birakilamaz";
					$preConditions = false;
				}
				if (empty(trim($_POST['surname']))){
					$name_err = "Soyad bos birakilamaz";
					$preConditions = false;
				}

				if (empty(trim($_POST['email']))){
					$title_err = "Eposta bos birakilamaz";
					$preConditions = false;
				}

				if (empty($_POST['title'])){
					$dean_err = "Unvan secmelisiniz!";
					$preConditions = false;
				}

				if ($preConditions) {

					$tempObj = new Staff();
					$randPass = generateRandomPassword();
					$tempObj->setName($_POST['name']);
					$tempObj->setSurname($_POST['surname']);
					$tempObj->setEmail($_POST['email']);
					$tempObj->setPassword(md5($randPass));
					$tempObj->setType($_POST['title']);
					$id = $_POST['email'];
					
					if(!empty($_POST['office']))
						$tempObj->setRoom($_POST['office']);

					$tempObj->create();
					$logger = new Logger();
					$logger->log("CREATESTAFF", $_SESSION['id'], $_SESSION['userAuthType'], $_SESSION['id'] . " created a user: (" . $_POST['email'] . ")");
					unset($logger);

					$isSuccess = true;
				}
			}
			break;
		
		case 2:
			$widgetHead = "Yeni ogrenci ekle";
			$type = 2;

			if (isset($_POST['submit'])) {
				if (empty(trim($_POST['name']))){
					$name_err = "Ad bos birakilamaz";
					$preConditions = false;
				}
				if (empty(trim($_POST['surname']))){
					$surname_err = "Soyad bos birakilamaz";
					$preConditions = false;
				}

				if (empty(trim($_POST['email']))){
					$email_err = "Eposta bos birakilamaz";
					$preConditions = false;
				}

				if (empty($_POST['faculty'])){
					$faculty_err = "Fakulte secmelisiniz!";
					$preConditions = false;
				}

				if (empty($_POST['department'])){
					$department_err = "Bolum secmelisiniz!";
					$preConditions = false;
				}

				if ($preConditions) {
					$tempObj = new Student();
					$randPass = generateRandomPassword();
					$tempObj->setName($_POST['name']);
					$tempObj->setSurname($_POST['surname']);
					$tempObj->setEmail($_POST['email']);
					$tempObj->setPassword(md5($randPass));
					$tempObj->setFaculty($_POST['faculty']);
					$tempObj->setDepartment($_POST['department']);

					$id = $tempObj->create();
					$logger = new Logger();
					$logger->log("CREATESTUDENT", $_SESSION['id'], $_SESSION['userAuthType'], $_SESSION['id'] . " created a user: (" . $_POST['email'] . ")");
					unset($logger);

					$isSuccess = true;
				}
			}
			break;
		default:
			# code...
			break;
	}
	if(isset($_POST['submit'])){
		try {
			$mail = new MailWorker(true);
      		$mail->addAddress($_POST['email']);
        	$mail->Subject = "UZEM PLUS: Yeni parolaniz";
        	$mail->Body = "
                            Sayin kullanici,<br>
                            UZEM PLUS'a hosgeldiniz. Hesabiniz({$id}) icin yeni bir sifre olusturulmustur. Sifreniz asagida yer almaktadir.<br>

                            <pre>
                                {$randPass}
                            </pre>
                            <br>

                            Iyi gunler dileriz,<br>
                            UZEM PLUS
                          ";

        	$mail->send();

        } catch (Exception $exception) {
        	echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }

        unset($mail);
    }

} else {
	$mode = false;
	$widgetHead = "Yeni kullanici tipini seciniz";
}



require_once 'layouts/layout.header.php';
?>

<body>
	<div id="content">	
		<?php require_once 'layouts/layout.navbar.php'; ?>

		<div class="heading-buttons bg-white innerAll">
			<h1 class="content-heading padding-none pull-left">Yeni Kullanici Ekle</h1>
			<div class="clearfix"></div>
		</div>

		<div class="innerAll spacing-x2">
			<div class="widget widget-inverse">
				<div class="widget-head">
					<h4 class="heading"><?= $widgetHead; ?></h4>
				</div>
				<div class="widget-body">
					<?php 
						if($mode){
							if($isSuccess): 
					?>
						<div class="alert alert-success">
  							<strong>Basarili!</strong> Yeni kullanici basari ile olusturuldu!.
						</div>
						<?php endif; ?>
					<form method="post" action="" class="form-horizontal" role="form">
						<?php if ($type == 1): endif; ?>
						<div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
							<label class="col-sm-2 control-label" for="name">Kullanici adi:</label>
							<div class="col-sm-10">
								<input type="text" id="name" name="name" placeholder="Kullanicinin adini giriniz" class="form-control">
								<span class="help-block"><?php echo (!empty($name_err)) ? $name_err : ''; ?></span>
							</div>
						</div>

						<div class="form-group <?php echo (!empty($surname_err)) ? 'has-error' : ''; ?>">
							<label class="col-sm-2 control-label" for="surname">Kullanici soyadi:</label>
							<div class="col-sm-10">
								<input type="text" id="surname" name="surname" placeholder="Kullanicinin soyadini giriniz" class="form-control">
								<span class="help-block"><?php echo (!empty($surname_err)) ? $surname_err : ''; ?></span>
							</div>
						</div>

						<div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
							<label class="col-sm-2 control-label" for="email">Kullanici e-posta adresi:</label>
							<div class="col-sm-10">
								<input type="text" id="email" name="email" placeholder="Orn: aaaa@bbb.com" class="form-control">
								<span class="help-block"><?php echo (!empty($email_err)) ? $email_err : ''; ?></span>
							</div>
						</div>

						<?php if ($type == 1): ?>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="office">Kullanicinin ofisi:</label>
							<div class="col-sm-10">
								<input type="text" id="office" name="office" placeholder="Orn: A315" class="form-control">
							</div>
						</div>
						<?php endif; ?>

						<?php if ($type == 1): ?>
						<div class="form-group <?php echo (!empty($title_err)) ? 'has-error' : ''; ?>">
							<label class="col-sm-2 control-label" for="title">Kullanici unvani:</label>
							<div class="col-sm-10">
								<select class="form-control" name="title">
									<option disabled selected>Bir unvan seciniz</option>
									<?php
										foreach ($accademic as $index => $title):
									?>
										<option value="<?= $index; ?>"><?= $index . ' ' . $title; ?></option>
									<?php endforeach;?>
								</select>
								<span class="help-block"><?php echo (!empty($title_err)) ? $title_err : ''; ?></span>
							</div>
						</div>
						<?php endif; ?>

						<?php if ($type == 2): ?>
						<div class="form-group <?php echo (!empty($faculty_err)) ? 'has-error' : ''; ?>">
							<label class="col-sm-2 control-label" for="title">Fakulte seciniz:</label>
							<div class="col-sm-10">
								<select class="form-control" name="faculty">
									<option disabled selected>Bir fakulte seciniz</option>
									<?php
										$faculties = Faculty::getAllFacultyAbbrList();
										foreach ($faculties as $index => $abbr):
									?>
										<option value="<?= $index; ?>"><?= $abbr; ?></option>
									<?php endforeach;?>
								</select>
								<span class="help-block"><?php echo (!empty($faculty_err)) ? $faculty_err : ''; ?></span>
							</div>
						</div>
						<?php endif; ?>

						<?php if ($type == 2): ?>
						<div class="form-group <?php echo (!empty($department_err)) ? 'has-error' : ''; ?>">
							<label class="col-sm-2 control-label" for="title">Bolum seciniz:</label>
							<div class="col-sm-10">
								<select class="form-control" name="department">
									<option disabled selected>Bir bolum seciniz</option>
									<?php
										$departments = Department::getAllDepartmentAbbrList();
										foreach ($departments as $index => $abbr):
									?>
										<option value="<?= $index; ?>"><?= $abbr; ?></option>
									<?php endforeach;?>
								</select>
								<span class="help-block"><?php echo (!empty($department_err)) ? $department_err : ''; ?></span>
							</div>
						</div>
						<?php endif; ?>

						<div class="row text-right">
            				<button type="submit" name="submit" class="btn btn-primary">Kullanici Olustur</button>
        				</div>
					</form>
					<div class="clearfix"></div>

					<?php } else { ?>

					<div class="col-md-10 col-md-offset-1">
						<div class="col-md-6">
							<a href="add_user.php?type=1" class="display-block innerAll inner-2x bg-success">
								<span class="display-block text-center">
									<i class="fa fa-fw fa-3x fa-plus text-white"></i>
									<p class="strong innerT text-condensed text-medium text-white margin-none">Calisan Ekle</p>
									<p class="text-normal margin-none strong text-white">Sistemde yeni bir calisan hesabi olusturur</p>
								</span>
							</a>
						</div>

						<div class="col-md-6">
							<a href="add_user.php?type=2" class="display-block innerAll inner-2x bg-info">
								<span class="display-block text-center">
									<i class="fa fa-fw fa-3x fa-plus" text-white"></i>
									<p class="strong innerT text-condensed text-medium text-white margin-none">Ogrenci Ekle</p>
									<p class="text-normal margin-none strong text-white">Sistemde yeni bir ogrenci hesabi olusturur</p>
								</span>
							</a>
						</div>
					</div>
						<div class="clearfix"></div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<?php require_once 'layouts/layout.footer.php';	?>