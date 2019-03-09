<?php

	if ($_REQUEST['id'] == $_SESSION['User']['id']) // если это наша страница
	{
		header("Location: ..\MyPage\MyPage.php");
	}
	
/// данные о пользователе нам передались по ссылке, добавим их в сессию
///Если будем добавлять черный список, то просто используем if else, и вставка
/// HTML кода. Это несложно, поэтому без угрызения совести, пишем код...;)
	$_SESSION['User_Page']['id'] = $_REQUEST['id'];
	$_SESSION['User_Page']['Login'] = $_REQUEST['login'];
	$_SESSION['User_Page']['Name'] = $_REQUEST['name'];
	$_SESSION['User_Page']['LastName'] = $_REQUEST['lastname'];
	///Передача аватарки(пути к ней) идет так: передается только главный путь в 
	/// главной директории, т.е. корневом каталоге с SerovNet, где находятся главные
	/// файлы. Поэтому здесь прописываем добавление пути.
	$_SESSION['User_Page']['img'] = "..\..\\".$_REQUEST['img'];
	
	///Узнаем, в друзьях ли он находится, или есть запрос в друзья
	include_once "..\..\SQL_Functions\User_login\SQL_Friends_Relationship.php";
	$_SESSION['User_Page']['Friend_Relationship'] = Get_Friends_Status_by_id($_SESSION['User_Page']['id']);
	
/*
/// Добавляем обработчики "вездесущих" блоков("Домашний блок", поиск и выход)
	include_once "..\..\Common_Buttons\Home_Block\Home_Block.php";
	include_once "..\..\Common_Buttons\Options_And_Exit\Options_And_Exit.php";
	include_once "..\..\Common_Buttons\Search_Line\Search_Line.php";
*/

/// Добавляем обработчики элементов "Чужой страницы"(почти исключительно "Чужой страницы")
	include_once "\Blocks\Avatar\Avatar_Treatment.php";
	include_once "\Blocks\Interaction\Interaction_Treatment.php";
	include_once "\Blocks\Wall\Wall_Treatment.php";
	// Пока что этого пункта не будет, там в первой версии не такая сложная структура
	//include_once "\Blocks\Basic_Information\Basic_Information_Treatment.php";
?>

<?php
	include_once "..\..\Update_Functions\Update_Page_Informations.php";
	Update();
?>

<?php
	
	if (isset($_REQUEST['Friends_Request'])) // обрабатываем запрос "В друзья"
	{
		include_once "..\..\SQL_Functions\User_login\SQL_Friends_Request.php";
		if ($_REQUEST['Friends_Request'] == "Remove_From_Friends")
		{
			// Удалить из друзей
			Delete_From_Friends($_SESSION['User_Page']['id']);
		}
		else if ($_REQUEST['Friends_Request'] == "Send_Request_For_Friend")
		{
			///Отправить запрос в друзья
			Send_Request_to_Friends($_SESSION['User_Page']['id'], $_SESSION['User_Page']['Login'], $_SESSION['User_Page']['Name'], $_SESSION['User_Page']['LastName'], $_SESSION['User_Page']['img']);
		}
		else if ($_REQUEST['Friends_Request'] == "Delete_Friend_Request")
		{
			/// Удалить запрос "Добавить в друзья"
			Delete_Request_in_Friends($_SESSION['User']['id'], $_SESSION['User_Page']['id']);
		}
		$_SESSION['User_Page']['Friend_Relationship'] = Get_Friends_Status_by_id($_SESSION['User_Page']['id']);
	}
?>