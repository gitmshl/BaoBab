<?php
	/*
		Это обработчик событий для "Моей страницы".
	*/
	
/// Добавляем в сессию информацию о том, на чье странице мы находимся(т.е. на своей)
	//include_once "C:\OSPanel\domains\localhost\SerovNet\SQL_Functions\Users_Main_Information\SQL_Get.php";
	$_SESSION['User_Page']['id'] = $_SESSION['User']['id'];
	$_SESSION['User_Page']['Login'] = $_SESSION['User']['Login'];
	$_SESSION['User_Page']['Name'] = $_SESSION['User']['Name'];
	$_SESSION['User_Page']['LastName'] = $_SESSION['User']['LastName'];
	$_SESSION['User_Page']['img'] = $_SESSION['User']['img']; /// добавляем путь к аватарке
?>
<!--То, что ниже - это вызов обработчиков блоков на "Моей странице"-->
<?php
	/*
	/// Добавляем обработчики "вездесущих" блоков("Домашний блок", поиск и выход)
	include_once "..\..\Common_Buttons\Home_Block\Home_Block.php";
	include_once "..\..\Common_Buttons\Options_And_Exit\Options_And_Exit.php";
	include_once "..\..\Common_Buttons\Search_Line\Search_Line.php";
	*/
	/// Добавляем обработчики элементов "Моей страницы"(почти исключительно "Моей страницы")
	include_once "\Blocks\Avatar\Avatar_Treatment.php";
	include_once "\Blocks\Interaction\Interaction_Treatment.php";
	include_once "\Blocks\Wall\Wall_Treatment.php";
	// Пока что этого пункта не будет, там в первой версии не такая сложная структура
	//include_once "\Blocks\Basic_Information\Basic_Information_Treatment.php";
?>