<?php
	session_start();
	
	include_once "current_dialog_handler.php";
	
	///Redirect
	if (!isset($_REQUEST['new_dialog']))
	{
		$_SESSION['Redirect']['action'] = true; /// поднимаем флаг редиректа
		$_SESSION['Redirect']['msg'] = $_REQUEST['msg'];
		$_SESSION['Redirect']['Send_msg_Button'] = $_REQUEST['Send_msg_Button'];
		$id_dialog = $_SESSION['Dialog']['id'];
		header("Location: current_dialog.php?id=$id_dialog&new_dialog=");
	}
	
	if (isset($_SESSION['Redirect']['action']) && $_SESSION['Redirect']['action'] == true)
	{
		$_REQUEST['msg'] = $_SESSION['Redirect']['msg'];
		$_REQUEST['Send_msg_Button'] = $_SESSION['Redirect']['Send_msg_Button'];
		$_SESSION['Redirect']['action'] = false;
	}
	///
	
	include_once "..\SQL_Functions\Dialogs\Get_Messages.php";
	include_once "..\Update_Functions\Update_Page_Informations.php";
	
	
	if (isset($_REQUEST['msg'])  && $_REQUEST['msg'] != "" && isset($_REQUEST['Send_msg_Button']))
	{	
		include_once "Send_msg_Treatment.php";
		
	}
	Update();
	
	Clean_New_Messages_in_Dialog_by_id($_SESSION['Dialog']['id']); /// очищаем новые сообщения в диалоге
	
	$Messages = Get_Messages_by_dialogs_id($_SESSION['Dialog']['id'], $count);
	
	$dialog_img = "..\\".$_SESSION['Dialog']['another_user_avatar'];
?>


 <!doctype html>
 <html lang="ru-RU">
 <head>
 	<meta charset="UTF-8">
 	<title>Dialog Name</title>
	<link rel="stylesheet" href="css/current_dialog.css">
	<link rel="stylesheet" href="fonts/fonts.css">
	<link rel="stylesheet" href="fonts/rubik/rubik.css">
	<link rel="stylesheet" href="fonts/roboto_vk_font/roboto_vk_font.css">
 </head>
 <body>
 	<header>
			<div class="header">
				<div class="subheader">
					<div class="logo"></div>
					<div class="search_block">
						<form action="..\GLOBAL_SEARCH\GS_ALL.php">
							<div class="search_field">
									<input type="text" id="search_input" name="Global_Search_Line" class="placeholder_style" placeholder="Search...">
									<input type="image" id="search_button" name = "Global_Search_Button" src="images/search_button.png" alt="Search">
							</div>
						</form>
					</div>
					<div class="right_column">
						<div class="signOut_block">
							<form action="..\Common_Buttons\Options_And_Exit\Options_And_Exit.php">
								<div class="signOut_a">
									<a class="right_top" href="..\Common_Buttons\Options_And_Exit\Options_And_Exit.php">Sign out</a>
								</div>
							</form>
						</div>
						<div class="options_block">
							<form action="">
								<div class="options_a">
									<a class="right_top" href="OPTIONS">Options</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
	</header>
	<div class="clear"></div>
	<div class="wrapper">
		<div class="leftSidebar">
			<ul class="left_sidebar_ul">
				<li>
					<div class="my_page">
						<a href="..\Page\MyPage\MyPage.php">
							My page
						</a>
					</div>
				</li>
				<?php
					if ($_SESSION['User']['New_Friend'])
					{
				?>
				<li>
					<div class="my_friends">
						<a href="..\Page\Friends\MFS.php">
							My friends
						</a>
						<a href="..\Friends\RFF.php" id="plus"> + </a>
					</div>
				</li>
				<?php
					}
					else
					{
					?>
					<li>
						<div class="my_friends">
							<a href="..\Page\Friends\MFS.php">
								My friends
							</a>
						</div>
					</li>
					<?php
					}
					?>
					<?php
						if ($_SESSION['User']['New_Message'])
						{
					?>
				<li>
					<div class="my_messages">
						<a href="DS.php">
							My messages
						</a>
						<a href="..\Friends\RFF.php" id="plus"> + </a>
					</div>
				</li>
					<?php
						}
						else
						{
						?>
				<li>
					<div class="my_messages">
						<a href="..\My_dialogs\DS.php">
							My messages
						</a>
					</div>
				</li>
						<?php
						}
						?>
				<li>
					<div class="my_groups">
						<a href="">
							My groups
						</a>
					</div>
				</li>
			</ul>
		</div>
		<div class="middle_content">
		
			<div class="profile_block">
				<img src=<?=$dialog_img?>  class="profile_photo" alt="">
				<div class="profile_name">
					<div class="sub1">
						<a href="#" class="profile_name_link"><?=$_SESSION['Dialog']['Name']?></a>
					</div>
				</div>
			</div>
			
			
			
			<?php
				if ($count == 0)
				{
			?>
				<b>Сообщений еще нету!</b>
			<?php
				}
				else
				{
				?>
				<div class="dialog_history">
				<?php
					for ($i = 0; $i < $count; $i++)
					{
						$msg = $Messages->fetch_assoc();
						if ($msg['id_user'] == $_SESSION['User']['id'])
							$img = "..\\".$_SESSION['Dialog']['my_avatar'];
						else $img = "..\\".$_SESSION['Dialog']['another_user_avatar'];
			?>
					<div class="message">
						<div id="photo_space">
							<img src="<?=$img?>" alt="" id="avat">
						</div>
						<p class="message_text"><?=$msg['msg']?></p>
					</div>
			<?php
					}
				?>
				</div>
				<?php
				}
			?>
			
			
			
			<form action="current_dialog.php">
				<div class="typing_block">
					<textarea name="msg" id="textar"></textarea>
					<button type = "submit" name = "Send_msg_Button" id="send"></button>
				</div>
			</form>
			
		</div>	
	</div>	
 </body>
 </html>