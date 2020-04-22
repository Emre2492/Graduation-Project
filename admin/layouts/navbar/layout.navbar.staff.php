<?php require_once 'config/lists.php'; ?>
<div class="navbar navbar-fixed-top navbar-primary main" role="navigation">
    
    <div class="navbar-header pull-left">
        <div class="navbar-brand">
            <div class="pull-left">
                <a href="" class="toggle-button toggle-sidebar btn-navbar"><i class="fa fa-bars"></i></a>
            </div>
            <a href="index.php" class="appbrand innerL"><?= SITENAME . ' '  .$userType[$_SESSION['userAuthType']]; ?></a>
         
        </div>
    </div>
  
    <ul class="nav navbar-nav navbar-left">
        <li class=" hidden-xs">
            <form class="navbar-form navbar-left " role="search" action="search.php" method="get">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Aranacak kelimeyi ya da ISBN'i girin..."/>
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-inverse"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
        </li>
    </ul>
		
	<ul class="nav navbar-nav navbar-right hidden-xs">
        
       
         <li class="dropdown">
            <a href="" class="dropdown-toggle user" data-toggle="dropdown"> 
			<img src="../assets/images/<?php
									if(!empty($_SESSION['image']))
									{
										echo 'profile_pics/' . $_SESSION['image'];
									}else{
										echo "default.png";
									}
									?>" width="40" height="40" alt="" class="img-circle"/>
			<span class="hidden-xs hidden-sm"> &nbsp; <?=$_SESSION['name']." ".$_SESSION['surname']; ?></span> <span class="caret"></span>
			</a>
            <ul class="dropdown-menu list pull-right ">
				<li><a nohref>Kullanici ID: <?=$_SESSION['id'];?></a></li>
                <li><a href="my_profile.php">Profilim <i class="fa fa-user pull-right"></i></a></li>
               
                <li><a href="uzemFiles/staff_help.pdf">Yardım <i class="fa fa-question-circle pull-right"></i></a></li>
            </ul>
        </li>
        <li><a href="logout.php" class="menu-icon"><i class="fa fa-sign-out"></i></a></li>
        
		
    </ul>
		
		
	</div>

	<div id="menu" class="hidden-print hidden-xs">
	<div class="sidebar sidebar-inverse">
		
		<div class="sidebarMenuWrapper">
			<ul class="list-unstyled">
				<li><a href="index.php"><i class="fa fa-home"></i><span>Anasayfa</span></a></li>
				<?php if($_SESSION['userAuthType'] == 1): ?>
				<li class="hasSubmenu">
					<a href="#" data-target="#menu-style" data-toggle="collapse"><i class="icon-settings-wheel-fill"></i><span>Fakulteler</span></a>
					<ul class="collapse" id="menu-style">
						<li><a href="faculties.php"><span class="pull-right badge badge-primary"></span>Fakulte listesi</a></li>
						<li><a href="add_faculty.php">Yeni Fakulte Ekle</a></li>
					</ul>
				</li>	
				<?php endif; ?>

				<?php if($_SESSION['userAuthType'] == 1 || $_SESSION['userAuthType'] == 4): ?>
				<li class="hasSubmenu">
					<a href="#" data-target="#departments" data-toggle="collapse"><i class="icon-settings-wheel-fill"></i><span>Bolumler</span></a>
					<ul class="collapse" id="departments">
						<li><a href="departments.php"><span class="pull-right badge badge-primary"></span>Bolum listesi</a></li>
						<li><a href="add_department.php">Yeni Bolum Ekle</a></li>
					</ul>
				</li>	
				<?php endif; ?>

				<li class="hasSubmenu">
					<a href="#" data-target="#support" data-toggle="collapse"><i class="fa fa-book"></i><span>Kütüphane</span></a>
					<ul class="collapse " id="support">
						<li><a href="study_room.php?roomNum=<?= $_SESSION['userAuthType']; ?>"><i class="icon-ticket"></i><span>Çalışma Odası Randevu</span></a></li>
						<li><a href="library.php"><i class="icon-bulleted-list"></i><span>Kitap Kirala</span></a></li>
						<?php if($_SESSION['userAuthType'] == 1 || $_SESSION['userAuthType'] == 4): ?>
						<li><a href="add_book.php">Yeni kitap ekle</a></li>
						<?php endif; ?>
					</ul>
				</li>

				<li class="hasSubmenu">
					<a href="#" data-target="#lectures" data-toggle="collapse"><i class="icon-compose"></i><span>Dersler</span></a>
					<ul class="collapse" id="lectures">
						<li><a href="my_lectures.php"><span class="pull-right badge badge-primary"></span>Derslerim</a></li>
						<?php if($_SESSION['userAuthType'] == 5): ?>
						<li><a href="add_lecture.php">Ders Ekle</a></li>
						<?php endif; ?>
						<li><a href="time_schedule.php">Ders Programı</a></li>
					</ul>
				</li>

				<?php if(in_array($_SESSION['userAuthType'], $management)): ?>
				<li class="hasSubmenu">
					<a href="#" data-target="#anns" data-toggle="collapse"><i class="fa fa-bullhorn"></i><span>Duyurular</span></a>
					<ul class="collapse " id="anns">
						<li><a href="admin_announcement.php"></i><span>Duyurular Listesi</span></a></li>
						<li><a href="add_ann.php"><span>Yeni Duyuru Ekle</span></a></li>
					</ul>
				</li>
				<?php endif; ?>

				<?php if($_SESSION['userAuthType'] == 1): ?>
				<li class="hasSubmenu">
					<a href="#" data-target="#people" data-toggle="collapse"><i class="icon-group"></i><span>Kullanicilar</span></a>
					<ul class="collapse " id="people">
						<li><a href="admin_staffs.php"><span>Calisanlar</span></a></li>
						<li><a href="admin_students.php"><span>Ogrenciler</span></a></li>
						<li><a href="add_user.php"><span>Yeni kullanici ekle</span></a></li>
					</ul>
				</li>
				<?php endif; ?>

				<?php if($_SESSION['userAuthType'] == 1): ?>
				<li><a href="logs.php"><i class="fa fa-list"></i><span>Girdiler</span></a></li>
				<?php endif; ?>

				<li class="hasSubmenu">
					<a href="#" data-target="#polls" data-toggle="collapse"><i class=" icon-comment-typing"></i><span>Anketler</span></a>
					<ul class="collapse " id="polls">
						<li><a href="polls.php"><span>Anket Listesi</span></a></li>
						<?php if ($_SESSION['userAuthType'] != 2): ?>
						<li><a href="add_poll.php"><span>Yeni Anket Ekle</span></a></li>
						<?php endif; ?>
					</ul>
				</li>

				<li><a href="contact.php"><i class="fa fa-phone"></i><span>İletişim</span></a></li>
					</ul>
				</li>
			
			</ul>
		</div>
	</div>
