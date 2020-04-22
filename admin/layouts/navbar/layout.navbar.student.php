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
        <li class="dropdown notification">
		<?php
		$messages = Message::getGrouppedMessageList();
		?>
            <a href="#" class="dropdown-toggle menu-icon" data-toggle="dropdown"><i class="fa fa-fw fa-envelope-o"></i><span class="badge badge-primary"><?= Message::getUnreadMessageCount(); ?></span></a>
            <ul class="dropdown-menu inbox" style="width:350px">
				<?php
					foreach($messages as $message) {
						$messageFrom = Student::getStudentByID($message->getMessageFrom());
						$image = ($messageFrom->getImage() != null) ? 'profile_pics/' . $messageFrom->getImage() : 'default.png';
						echo '
						<li>
						<div class="media" onclick="location.href=\'show_message.php?from='.$messageFrom->getID().'\';">
							<a class="pull-left" href="index.php?page=message&user='.$messageFrom->getID().'"><img src="../assets/images/' . $image . '" alt="" class="img-circle media-object" width=50 height=50></a>
							
							<div class="media-body"">
								<a href="show_message.php?from='.$messageFrom->getID().'" class="strong text-primary">'.$messageFrom->getName()." ".$messageFrom->getSurname().'</a><span class="pull-right time-email">'.$message->getTimestamp().'</span>
								<div class="clearfix"></div>
								'.$message->getContent().'
							</div>
						</div>
						</li>
						';
					}
				?>
				<li><center><a href="messages.php">Tüm Mesajlar</a></center></li>
            </ul>
        </li>
       
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
               
                <li><a href="uzemFiles/stu_help.pdf">Yardım <i class="fa fa-question-circle pull-right"></i></a></li>
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
				<li class="hasSubmenu">
					<a href="#" data-target="#menu-style" data-toggle="collapse"><i class="icon-compose"></i><span>Dersler</span></a>
					<ul class="collapse" id="menu-style">
						<li><a href="my_lectures.php"><span class="pull-right badge badge-primary"></span>Derslerim</a></li>
						<li><a href="take_lecture.php">Ders Ekle</a></li>
						<li><a href="time_schedule.php">Ders Programı</a></li>
					</ul>
				</li>	
		
				<li class="hasSubmenu">
					<a href="#" data-target="#support" data-toggle="collapse"><i class="fa fa-book"></i><span>Kütüphane</span></a>
					<ul class="collapse " id="support">
						<li><a href="study_room.php?roomNum=<?= $_SESSION['userAuthType']; ?>"><i class="icon-ticket"></i><span>Çalışma Odası Randevu</span></a></li>
						<li><a href="library.php"><i class="icon-bulleted-list"></i><span>Kitap Kirala</span></a></li>
					</ul>
				</li>
				<li><a href="announcement.php"><i class="fa fa-bullhorn"></i><span>Duyurular</span></a></li>
				<li><a href="polls.php"><i class=" icon-comment-typing"></i></i><span>Anketler</span></a></li>
				<li><a href="my_grades.php"><i class="fa fa-file-text-o"></i><span>Notlar</span></a></li>
				<li><a href="contact.php"><i class="fa fa-phone"></i><span>İletişim</span></a></li>
					</ul>
				</li>
			
			</ul>
		</div>
	</div>
