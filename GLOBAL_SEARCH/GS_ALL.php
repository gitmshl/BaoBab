<?php
	/*
		Ýòîò ôàéë îòâå÷àåò çà ãëîáàëüíûé ïîèñê ïî âñåì êàòåãîðèÿì
	*/
	session_start();
	include_once "GS_Functions\GS_Get_DB.php";
	include_once "..\Help_Functions\Get_File_Names.php"; // äëÿ ïóòåé ê àâàòàðêàì
	include_once "..\Update_Functions\Update_Page_Informations.php";
	Update();
	
	if (!isset($_REQUEST['local']))
		$_REQUEST['Local_Search_Line'] = $_REQUEST['Global_Search_Line'];

	$Peoples = Get_Peoples(3, $_REQUEST['Local_Search_Line'], $count_peoples);
	$Groups = Get_Groups(3, $_REQUEST['Local_Search_Line'], $count_groups);
	
?>
 <!doctype html>
 <html lang="ru-RU">
 <head>
 	<meta charset="UTF-8">
 	<title>My page</title>
	<link rel="stylesheet" href="css/global_search_page_style.css">
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
						<form action="GS_ALL.php" method = "POST">
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
						<a href="..\My_dialogs\DS.php">
							My messages
						</a>
						<a href="..\My_dialogs\DS.php" id="plus"> + </a>
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
					<div class="my_news">
						<a href="">
							My news
						</a>
					</div>
				</li>
				<li>
					<div class="my_groups">
						<a href="">
							My groups
						</a>
					</div>
				</li>
			</ul>
		</div>
		
		<div class="global_search_middle_content">
		<form action="GS_ALL.php" method = "POST">
					<div class="search_field_large">
							<?php
							if (isset($_REQUEST['Local_Search_Line']) && $_REQUEST['Local_Search_Line'] != "")
							{
							?>
							<input type="text" id="search_input_large" name="Local_Search_Line" class="placeholder_style" placeholder="Search..." value = <?=$_REQUEST['Local_Search_Line']?>>
							<?php
							}
							else
							{
							?>
							<input type="text" id="search_input_large" name="Local_Search_Line" class="placeholder_style" placeholder="Search...">
							<?php
							}
							?>
							<input type = "hidden" name = "local" value = 1>
							<input type="image" id="search_button_large" name = "Local_Search_Button" src="images/search_button.png" alt="Search">
					</div>
				</form>
		
		
			<div class="search_friends_v1">								<!--	ÝÒÎ ÅÑËÈ 4 È ÁÎËÅÅ ÄÐÓÇÅÉ  -->
				<div class="search_friends_link">
					<a id="search_friends_link" href="">People</a>
				</div>
				<div class="search_friends_block_v1">
					<table class="table">
						<tr>
						<?php
						if ($count_peoples == 0)
						{
							?>
								<b>Kiss my ass</b>
							<?php
						}
						else
						{
							for ($i = 0; $i < $count_peoples; $i++)
							{ 
								$person = $Peoples->fetch_assoc();
								$img_main_path = Get_Path_User_Avatar_by_id($person['id'],$person['img']);
								$img = "..\\".$img_main_path;
							?>
								<td>
									<div>
										<img src=<?=$img?> class="ava" alt="">
									</div>
									<a href="..\Page\Another_Page\Another_Page.php?id=<?=$person['id']?>&login=<?=$person['login']?>&name=<?=$person['Name']?>
									&lastname=<?=$person['LastName']?>&img=<?=$img_main_path?>" id="name" class="name"><?=$person['Name']?> <?=$person['LastName']?></a>
								</td>
							<?php 
							} 
						}
							?>
						</tr>
					</table>
				</div>
			</div>
			
			<div class="search_groups_v1">								
				<div class="search_groups_link">
					<a id="search_groups_link" href="">Groups</a>
				</div>
				<div class="search_groups_block_v1">
					<table class="table">
						<tr>
						<?php
						if ($count_groups == 0)
						{
							?>
								<b>Kiss my ass</b>
							<?php
						}
						else
						{
							for ($i = 0; $i < $count_groups; $i++)
							{ 
							$group = $Groups->fetch_assoc();
							$img = "..\\".Get_Path_Groups_Avatar_by_id($group['id'],$group['img']);
							?>
								<td>
									<div>
										<img src=<?=$img?> class="ava" alt="">
									</div>
									<a href="" class="name"><?=$group['Name']?> <?=$group['Count']?></a>
								</td>
							<?php
							}
						}
							?>
						</tr>
					</table>
				</div>
			</div>
			
		<!--	<div class="search_smth_block">
				<div class="profile_block">
					<img src="images/bg.jpg"  class="profile_photo" alt="">
					<div class="profile_name">
						<a href="#" class="profile_name_link">First name Last name</a>
					</div>
				</div>
			</div> -->
			
		</div>
		
		<div class="rightSidebar">			 <!-- ÏÐÀÂÈËÜÍÛÉ ÏÐÀÂÛÉ ÑÀÉÄÁÀÐ!!! -->	
			<ul class="right_sidebar_ul">
				<li>
						
							<a href="">
								<div class="search_all">Search All</div>
							</a>
						
				</li>	
				<li>
						
							<a href="GS_Peoples.php?Local_Search_Line=<?=$_REQUEST['Local_Search_Line']?>">
								<div class="search_friends">People</div>
							</a>
						
				</li>
				<li>
					
						<a href="GS_Groups.php?Local_Search_Line=<?=$_REQUEST['Local_Search_Line']?>">
							<div class="search_groups">Groups</div>
						</a>
					
				</li>
			</ul>
		</div>
	</div>	
	
 </body>
 </html>