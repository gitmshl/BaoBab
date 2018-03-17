<!--Этот файл предназначен для обработки страницы вывода друзей
		(2-й уровень абстракции) -->
<?php
	/// Добавляем обработчики "вездесущих" блоков("Домашний блок", поиск и выход)
	///Common_Blocks_Handler
	include_once "..\..\Common_Buttons\Home_Block\Home_Block.php";
	include_once "..\..\Common_Buttons\Options_And_Exit\Options_And_Exit.php";
	include_once "..\..\Common_Buttons\Search_Line\Search_Line.php";
	
	///Обработчик строки поиска(для друзей)
	include_once "SEARCHE_Line_Treatment.php";
	
	///Обработчик списка друзей(перейти к другу или что-то еще, что будет в списке)
	include_once "Friends_List_Treatment.php";
	
	///Включаем файл поиска в БД друзей
	include_once "SEARCH_Friends.php";
	
?>