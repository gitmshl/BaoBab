<?php
/*
	<!--Этот файл отвечает за HTML прорисовку "Моей страницы"-->
<!--То, что ниже - это вставка обработчика событий для "Моей страницы"-->
*/
	session_start(); 
	include_once "MyPage_Handler.php";
?>

<!--Ниже должен идти HTML код "Моей страницы" с элементами php для загрузки
данных из базы данных-->


 <!doctype html>
 <html lang="ru-RU">
 <head>
 	<meta charset="UTF-8">
 	<title>My page</title>
	<link rel="stylesheet" href="css/my_page_style.css">
	<link rel="stylesheet" href="fonts/fonts.css">
	<link rel="stylesheet" href="fonts/rubik/rubik.css">
 </head>
 <body>
 	<header>
			<div class="header">
				<div class="subheader">
					<div class="logo"></div>
					<div class="search_block">
						<form action="">
							<div class="search_field">
									<input type="text" id="search_input" name="search_input" class="placeholder_style" placeholder="Search...">
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
						<a href="MyPage.php">
							My page
						</a>
					</div>
				</li>
				<li>
					<div class="my_friends">
						<a href="">
							My friends
						</a>
					</div>
				</li>
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
			<div>
				<img src=<?=$_SESSION['User_Page']['img']?> id="avatar"  class="avatar" alt="Имя пользователяяяяяяяяяяяяяя">
			</div>
<!--В зависимости от кол-ва друзей, производим определенный вывод-->
			<?php
				include_once "..\..\SQL_Load\For_Page\Rand_For_Show_SQL_Load_Functions.php";
				$Friends = Get_Rand_Friends_For_Show_by_id($_SESSION['User_Page']['id'], $count);
				if ($count >= 4) include_once "HTML_CODE_IF_FRIENDS_MORE_4.php";
				else if ($count > 0 && $count < 4) include_once "HTML_CODE_IF_FRIENDS_LESS_4.php";
				else if ($count == 0) include_once "HTML_CODE_IF_FRIENDS_EQUAL_0.html";
			?>

<!--В зависимости от кол-ва групп, производим определенный вывод-->		

			<?php
				$Groups = Get_Rand_Groups_For_Show_by_id($_SESSION['User_Page']['id'], $count);
				if ($count >= 4) include_once "HTML_CODE_IF_GROUPS_MORE_4.php";
				else if ($count > 0 && $count < 4) include_once "HTML_CODE_IF_GROUPS_LESS_4.php";
				else if ($count == 0) include_once "HTML_CODE_IF_GROUPS_EQUAL_0.html";
			?>		
		</div>
		<div class="person_name"><?=$_SESSION['User_Page']['Name']?> <?=$_SESSION['User_Page']['LastName']?></div>
	<!--Ни в коем случае не менять название "uploadfile"-->	
		<form enctype = "multipart/form-data" action="MyPage.php" MAX_FILE_SIZE = "30000" method = "post" >
			<div class="add_post">
				<div id="post_file">
				<input type="file" name = "uploadfile"></div>
				<textarea name = "msg" id="post_textarea" cols="40" rows="8" placeholder="Your comment"></textarea>
				<input type = "submit" name = "Add_Post" value = "Ok">
			</div>
		</form>
		
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
