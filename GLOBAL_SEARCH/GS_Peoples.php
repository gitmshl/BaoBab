<?php
	/*
		Этот файл отвечает за глобальный поиск по людям
	*/
	session_start();
	include_once "GS_Functions\GS_Get_DB.php";
	include_once "..\SQL_Functions\User_login\SQL_Friends_Relationship.php";
	include_once "..\Help_Functions\Get_File_Names.php"; // для путей к аватаркам
	include_once "..\Update_Functions\Update_Page_Informations.php";
	Update();
	
	$N = 15;
	$_SESSION['GS_People']['Border'] = isset($_SESSION['GS_People']['Border']) ? $_SESSION['GS_People']['Border'] : $N;
	if (isset($_REQUEST['Continue_Show']))
	{
		$_SESSION['GS_People']['Border'] += $N;
		unset($_REQUEST['Continue_Show']);
	}
	if (isset($_REQUEST['Hide']))
	{
		$_SESSION['GS_People']['Border'] = $N;
		unset($_REQUEST['Hide']);
	}
	$Peoples = Get_Peoples($_SESSION['GS_People']['Border'], $_REQUEST['Local_Search_Line'], $count_peoples);
	//$count_peoples -= $_SESSION['GS_People']['Border']; /// показывает, сколько людей еще не выведено, но находятся в зоне поиска в БД
	if ($count_peoples > $_SESSION['GS_People']['Border'])
		$count_peoples = $_SESSION['GS_People']['Border'];
?>
<!doctype html>
 <html lang="ru-RU">
 <head>
 	<meta charset="UTF-8">
 	<title>Search</title>
	<link rel="stylesheet" href="css/people&group_search.css">
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
					<div class="my_groups">
						<a href="">
							My groups
						</a>
					</div>
				</li>
			</ul>
		</div>
		
		<div class="people_group_search_middle_content">
		
			<div class="search_smth_link">
				<p id="people">People</p>
			</div>
		
				<form action="">
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
							<input type="image" id="search_button_large" name = "Local_Search_Button" src="images/search_button.png" alt="Search">
					</div>
				</form>
	
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
								$img_main_path = Get_Path_User_Avatar_by_id($person['id'], $person['img']);
								$img = "..\\".$img_main_path;
								$relationship_with_me = Get_Friends_Status_by_id($person['id']);
							?>
							<div class="profile_block">
								<img src=<?=$img?>  class="profile_photo" alt="">
								<div class="profile_name">
									<div class="sub1">
									<a href="..\Page\Another_Page\Another_Page.php?id=<?=$person['id']?>&login=<?=$person['login']?>&name=<?=$person['Name']?>
									&lastname=<?=$person['LastName']?>&img=<?=$img_main_path?>" class="profile_name_link"><?=$person['Name']?> <?=$person['LastName']?></a>
									
									<?php
									if ($person['id'] != $_SESSION['User']['id'])
									{
										if ($relationship_with_me == 0)
										{
									?>
									<div class="add_friend"><a href="..\Page\Friends\Requests_Handler.php?id=<?=$person['id']?>&login=<?=$person['Login']?>&name=<?=$person['Name']?>
									&lastname=<?=$person['LastName']?>&img=<?=$img_main_path?>&request=send&way=..\..\GLOBAL_SEARCH\GS_Peoples.php?Local_Search_Line=<?=$_REQUEST['Local_Search_Line']?>">Add friend</a></div>
									<?php
										}
										else if ($relationship_with_me == 1)
										{
									?>
									<div class="add_friend"><a href="..\Page\Friends\Requests_Handler.php?id=<?=$person['id']?>&login=<?=$person['Login']?>&name=<?=$person['Name']?>
									&lastname=<?=$person['LastName']?>&img=<?=$img_main_path?>&request=cancel&way=..\..\GLOBAL_SEARCH\GS_Peoples.php?Local_Search_Line=<?=$_REQUEST['Local_Search_Line']?>">Delete request</a></div>
									<?php
										}
										else if ($relationship_with_me == 2)
										{
									?>
									<div class="add_friend"><a href="..\Page\Friends\Requests_Handler.php?id=<?=$person['id']?>&login=<?=$person['Login']?>&name=<?=$person['Name']?>
									&lastname=<?=$person['LastName']?>&img=<?=$img_main_path?>&request=delete&way=..\..\GLOBAL_SEARCH\GS_Peoples.php?Local_Search_Line=<?=$_REQUEST['Local_Search_Line']?>">Delete friend</a></div>
									<?php
										}
									}
									?>
									</div>
								</div>
							</div>
							<?php
							}
						}
							?>
			<?php
				if ($count_peoples != 0)
				{
			?>
			<div class="show_more"><a href = "GS_Peoples.php?Continue_Show=1&Local_Search_Line=<?=$_REQUEST['Local_Search_Line']?>" id="show_more">Show more</a></div>
			<?php
				}
				else
				{
			?>
			<a href = "GS_Peoples.php?Hide=1&Local_Search_Line=<?=$_REQUEST['Local_Search_Line']?>">Hide</a>
			<?php
				}
			?>
		</div>
		
		<div class="rightSidebar">
			<ul class="right_sidebar_ul">
				<li>
						<div class="search_all">
							<a href="GS_ALL.php?local=1&Local_Search_Line=<?=$_REQUEST['Local_Search_Line']?>">
								Search All
							</a>
						</div>
				</li>	
				<li>
						<div class="search_friends">
							<a href="">
								People
							</a>
						</div>
				</li>
				<li>
					<div class="search_groups">
						<a href="GS_Groups.php?Local_Search_Line=<?=$_REQUEST['Local_Search_Line']?>">
							Groups
						</a>
					</div>
				</li>
			</ul>
		</div>
	</div>	
	
 </body>
 </html>