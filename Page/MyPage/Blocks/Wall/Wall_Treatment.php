<?php
	/*
		Этот файл отвечает за обработку блока стены на "Моей странице".
		Сюда входят обработка нажатия кнопок удаления, добавления, загрузки файлов
		и других штучек, которые должны быть на стене.
	*/
	
	///Обработка удаления записей на стене
	if (isset($_REQUEST['id_post']) && $_REQUEST['delete_post'] == 1)
	{
		include_once "..\..\SQL_Functions\User_login\SQL_Delete_in_Wall.php";
		Delete_Post_in_Wall($_SESSION['User']['id'], $_REQUEST['id_post']);
		///Удалим из новостной ленты(это делаем только если в настройках у пользователя это прописано)!!!
		include_once "..\..\SQL_Functions\User_login\SQL_User_News.php";
		Delete_in_News_My_Friends("..\..\\", $_REQUEST['id_post']);
	}
	
	/// Обработка добавления записей на стену
if (isset($_REQUEST['add']) && $_REQUEST['add'] == 1)
{
	if ($_REQUEST['Add_Post'] && isset($_FILES["uploadfile"]["name"]))
	{
		if ($_REQUEST['msg'] != "" || $_FILES["uploadfile"]["name"] != "")
		{
			/// Если что-то да надо загрузить на стену, то загружаем
			include_once "..\..\SQL_Functions\User_login\SQL_Insert_in_Wall.php";
			Insert_in_Wall_by_id($_SESSION['User_Page']['id'], $_REQUEST['msg'], $_FILES["uploadfile"]["name"]);
			///Определим id поста, который мы только что добавили. Это нужно для добавления в бд новостей друзей, чтобы при удалении этой записи можно было удалить это из бд новостей наших друзей. Эти действия будут производиться, если в настройках пользователь включит режим, который удаляет из ленты новостей друзей те новости, которые решил удалить на своей странице пользователь. Как видно, это затруднительный процесс, поэтому мы будем его делать только если на то "пожелание пользователя"
			include_once "..\..\SQL_Functions\Common_Functions_For_SQL\Get_id_last_insert_in_DB.php";
			$DB_User_Name = 'User_'.$_SESSION['User']['id'];
			$id_last_insert_in_Wall = Get_id_last_inserts($DB_User_Name, 'Wall');
			/// Далее, если какой то файл был прикреплен, то сохраним его в файлах
			/// пользователя
			if ($_FILES["uploadfile"]["size"] > 0)
			{
				$uploaddir = "..\..\Files\User_".$_SESSION['User_Page']['id']."\\";
				$uploadfile = $uploaddir.basename($_FILES["uploadfile"]["name"]);
				copy($_FILES["uploadfile"]["tmp_name"], $uploadfile);
			}
			///Передаем в новости друзьям
			include_once "..\..\SQL_Functions\User_login\SQL_User_News.php";
			$file_name = basename($_FILES["uploadfile"]["name"]);
			Add_in_News_My_Friends("..\..\\", $id_last_insert_in_Wall, $_REQUEST['msg'], $file_name);
		}
	}
}
	///Обработка изменения аватарки
	if ($_REQUEST['Add_Avatar'] && isset($_FILES["uploadfile_avatar"]["name"]))
	{
		if ($_FILES["uploadfile_avatar"]["name"] != "")
		{
			include_once "..\..\SQL_Functions\Users_Main_Information\SQL_Change_Information.php";
			Change_Avatar($_FILES["uploadfile_avatar"]["name"]);
			$My_id = $_SESSION['User']['id'];
			$new_img = $_FILES["uploadfile_avatar"]["name"];
			$_SESSION['User']['img'] = $_FILES["uploadfile_avatar"]["name"];
			$_SESSION['User']['img'] = "..\..\Files\User_".$_SESSION['User']['id']."\\".$_SESSION['User']['img'];
			$_SESSION['User_Page']['img'] = $_SESSION['User']['img'];
			/// Далее, если какой то файл был прикреплен, то сохраним его в файлах
			/// пользователя
			if ($_FILES["uploadfile_avatar"]["size"] > 0)
			{
				$uploaddir = "..\..\Files\User_".$_SESSION['User_Page']['id']."\\";
				$uploadfile = $uploaddir.basename($_FILES["uploadfile_avatar"]["name"]);
				copy($_FILES["uploadfile_avatar"]["tmp_name"], $uploadfile);
				///Изменим у всех моих друзей название авы в бд Friends
				include_once "..\Friends\SQL_Block\FS_Get_DB.php";
				$Friends = Get_Friends($_SESSION['User']['id'], "", $count);	
				for ($i = 0; $i < $count; $i++)
				{
					$f = $Friends->fetch_assoc();
					$DB_Name = "User_".$f['id_Friend'];
					$DB = new mysqli("localhost", "root", "", $DB_Name);
					$DB->query("UPDATE `Friends`
					SET `img` = '$new_img'
					WHERE `id_Friend` = '$My_id'");
					$DB->close();
				}
			}
		}
	}
?>