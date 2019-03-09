<?php
	/*
		Этот файл отвечает за страницу вывода списка диалогов.
	*/
	
	session_start();
	
	////Redirect
	include_once "..\Update_Functions\Update_Page_Informations.php";
	include_once "SQL_DS\SQL_DS.php";
	Update();
	
	if (!isset($_REQUEST['DS_Line'])) $_REQUEST['DS_Line'] = "";
	$Dialogs = Get_Dialogs(-1, $_REQUEST['DS_Line'], $count);
?>

 <!doctype html>
 <html lang="ru-RU">
 <head>
 	<meta charset="UTF-8">
 	<title>My Dialogs</title>
	<link rel="stylesheet" href="css/my_dialogs.css">
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
							<form action="">
								<div class="signOut_a">
									<a class="right_top" href="SIGN_OUT">Sign out</a>
								</div>
							</form>
						</div>
						<div class="options_block">
							<form action="..\Common_Buttons\Options_And_Exit\Options_And_Exit.php">
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
						<a href="DS.php">
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
			<form action="">
				<div class="search_field_large">
						<input type="text" id="search_input_large" name="DS_Line" class="placeholder_style" placeholder="Search..." value = <?=$_REQUEST['DS_Line']?>>
						<input type="image" id="search_button_large" src="images/search_button.png" alt="Search">
				</div>
			</form>
			
		<?php
			if ($count == 0)
			{
		?>
			<b>Ты неудачник!</b>
		<?php
			}
			else
			{
				for ($i = 0; $i < $count; $i++)
				{
					$dialog = $Dialogs->fetch_assoc();
				?>
					<div class="dialog_block">
						<div class="avatar_block">
							<img src="images/222.jpg"   alt="">
						</div>
					
						<a href="#" class="profile_name_link">
							<div class="profile_name">
								<div class="sub1">
									<?=$dialog['Name']?>
								</div>
							</div>
						</a>	
					</div>
				<?php
				}
			}
		?>
			
			<!-- 	<div class="profile_block">
					<img src="images/field.png"  class="profile_photo" alt="">
					<div class="profile_name">
						<div class="sub1">
							<a href="#" class="profile_name_link">First name Last name</a>
						</div>
					</div>
				</div> -->
				
			
		</div>	
	</div>	
 </body>
 </html>