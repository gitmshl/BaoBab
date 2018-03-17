<!--Это обработчик событий для "Чужой страницы".-->
<!--То, что ниже - это вызов обработчиков блоков на "Чужой странице"-->
<?php
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