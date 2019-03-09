<?php
	session_start();
	///Redirect
	if (isset($_REQUEST['name']))
	{
		$_SESSION['Redirect']['login'] = $_REQUEST['login'];
		$_SESSION['Redirect']['name'] = $_REQUEST['name'];
		$_SESSION['Redirect']['lastname'] = $_REQUEST['lastname'];
		$_SESSION['Redirect']['img'] = $_REQUEST['img'];
		$id = $_REQUEST['id'];
		header("Location: Another_Page.php?id=$id");
	}
	else
	{
		$_REQUEST['login'] = $_SESSION['Redirect']['login'];
		$_REQUEST['name'] = $_SESSION['Redirect']['name'];
		$_REQUEST['lastname'] = $_SESSION['Redirect']['lastname'];
		$_REQUEST['img'] = $_SESSION['Redirect']['img'];
	}
	///////
	include_once "Another_Page_Handler.php";
	include_once "..\..\Help_Functions\Get_File_Names.php";
	include_once "..\..\Help_Functions\Get_File_Names.php"; /// для путей к аватаркам
?>

<!--Ниже должен идти HTML код "Чужой страницы" с элементами php для загрузки
данных из базы данных-->

<!doctype html>
 <html lang="ru-RU">
 <head>
 	<meta charset="UTF-8">
 	<title><?=$_SESSION['User_Page']['Name']?> <?=$_SESSION['User_Page']['LastName']?></title>
	<link rel="stylesheet" href="css/another_page_style.css">
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
						<form action="..\..\GLOBAL_SEARCH\GS_ALL.php">
							<div class="search_field">
									<input type="text" id="search_input" name="Global_Search_Line" class="placeholder_style" placeholder="Search...">
									<input type="image" id="search_button" src="images/search_button.png" alt="Search">
							</div>
						</form>
					</div>
					<div class="right_column">
						<div class="signOut_block">
							<form action="">
								<div class="signOut_a">
									<a class="right_top" href="..\..\Common_Buttons\Options_And_Exit\Options_And_Exit.php">Sign out</a>
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
						<a href="..\MyPage\MyPage.php">
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
						<a href="..\Friends\MFS.php">
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
							<a href="..\Friends\MFS.php">
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
						<a href="..\..\My_dialogs\DS.php">
							My messages
						</a>
						<a href="..\..\My_dialogs\DS.php" id="plus"> + </a>
					</div>
				</li>
					<?php
						}
						else
						{
						?>
				<li>
					<div class="my_messages">
						<a href="..\..\My_dialogs\DS.php">
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
		<div class="middle_content">
			<div id="marg_bot_10px">
				<img src=<?=$_SESSION['User_Page']['img']?> id="avatar"  class="avatar" alt="Имя пользователя">
			</div>
		
		
			<a href = "..\..\Current_Dialog\Dialogs_Controller.php" >
				<div class="person_menu">Send Message</div>
			</a>
		
		
		<?php
			// Проверяем, является ли другом или нет и выводим соответсвующее...
			if ($_SESSION['User_Page']['Friend_Relationship'] == 2) /// друг
			{
				include_once "Remove_From_Friends.html";
			}
			else if ($_SESSION['User_Page']['Friend_Relationship'] == 1) /// есть запрос в друзья
			{
				include_once "Delete_Friend_Request.html";
			}
			else if ($_SESSION['User_Page']['Friend_Relationship'] == 0) // не друг
			{
				include_once "Sent_Request_For_Friend.html";
			}
		?>
			
<!--В зависимости от кол-ва друзей, производим определенный вывод-->
		<?php
			include_once "..\Friends\SQL_Block\FS_Get_DB.php";
				$Friends = Get_Limit_Friends($_SESSION['User_Page']['id'], 6, "", $count);
				if ($count >= 4) include_once "HTML_CODE_IF_FRIENDS_MORE_4.php";
				else if ($count > 0 && $count < 4) include_once "HTML_CODE_IF_FRIENDS_LESS_4.php";
				else if ($count == 0) include_once "HTML_CODE_IF_FRIENDS_EQUAL_0.html";
		?>
<!--В зависимости от кол-ва групп, производим определенный вывод-->		

			<?php
				$Groups = Get_Limit_Groups($_SESSION['User_Page']['id'], 6, "", $count);
				if ($count >= 4) include_once "HTML_CODE_IF_GROUPS_MORE_4.php";
				else if ($count > 0 && $count < 4) include_once "HTML_CODE_IF_GROUPS_LESS_4.php";
				else if ($count == 0) include_once "HTML_CODE_IF_GROUPS_EQUAL_0.html";
			?>	
		</div>
	<div class="person_name"><?=$_SESSION['User_Page']['Name']?> <?=$_SESSION['User_Page']['LastName']?></div>
	<div class="wall">
			<?php
				include_once "..\..\\SQL_Load\For_Page\Page_SQL_Load_Functions.php";
				$Wall = Read_Wall_in_User_Page_by_id($_SESSION['User_Page']['id'], $count);
				for ($i = 0; $i < $count; $i++)
				{
					$Text = $Wall[$i]['Text'];
					$File = $Wall[$i]['File'];
					$File = str_replace("\"", "", $File);
					$File = "..\..\Files\User_".$_SESSION['User_Page']['id']."\\".$File;
					$Time = $Wall[$i]['Time'];
					?>
					<div class="post">
					<p><?=$Text?></p>
					<?php
					if ($File != NULL)
					{ ?>
						<img src=<?=$File?> class="post_photo" alt="">
					<?php
					}  ?>
				<div class="time"><?=$Time?></div>
				</div>
					<?php
				}
			?>
		</div>
	</div>
</body>
 </html>