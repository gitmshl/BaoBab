<?php
	/*
		Этот файл отвечает за обработку блока стены на "Моей странице".
		Сюда входят обработка нажатия кнопок удаления, добавления, загрузки файлов
		и других штучек, которые должны быть на стене.
	*/
	/// Обработка добавления записей на стену
	if ($_REQUEST['Add_Post'] && isset($_FILES["uploadfile"]["name"]))
	{
		if ($_REQUEST['msg'] != "" || $_FILES["uploadfile"]["name"] != "")
		{
			/// Если что-то да надо загрузить на стену, то загружаем
			include_once "..\..\SQL_Functions\User_login\SQL_Insert_in_Wall.php";
			Insert_in_Wall_by_id($_SESSION['User_Page']['id'], $_REQUEST['msg'], $_FILES["uploadfile"]["name"]);
			/// Далее, если какой то файл был прикреплен, то сохраним его в файлах
			/// пользователя
			if ($_FILES["uploadfile"]["size"] > 0)
			{
				$uploaddir = "..\..\Files\User_".$_SESSION['User_Page']['id']."\\";
				$uploadfile = $uploaddir.basename($_FILES["uploadfile"]["name"]);
				copy($_FILES["uploadfile"]["tmp_name"], $uploadfile);
			}
		}
	}
?>