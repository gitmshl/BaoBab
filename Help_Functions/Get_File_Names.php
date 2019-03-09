<?php
	/*
		Этот файл содержит функции, которые позволяют по данному логину возвращать
		какие то имена файлов или чего то еще
	*/
	
	/*
	Возвращает имя базы данных пользователя, где лежит его основная информация с его таблицами,
	по логину пользователя
	*/
	function Get_User_DB_Name_by_login($user_login)
	{
		include_once "..\SQL_Functions\Users_Main_Information\SQL_Get.php";
		$user_id = Get_Id_User_by_Login($user_login);
		$DB_Name = "User_".$user_id;
		return $DB_Name;
	}
	
	/*
		Функция, которая возвращает путь до изображения, начиная с корневого ката-
		лога SerovNet
		ОСТОРОЖНО!!! ПРИ ИСПОЛЬЗОВАНИИ ЭТОЙ ФУНКЦИИ НЕ ЗАБЫВАЙТЕ, ЧТО В КАЖДОМ 
		ОТДЕЛЬНОМ СЛУЧАЕ НУЖНО БУДЕТ ПРОПИСАТЬ ПУТЬ ДО ВЫХОДА В КОРНЕВОЙ КАТАЛОГ 
		ИЗ ФАЙЛА, ОТКУДА ПРОИСХОДИТ ВЫЗОВ ЭТОЙ ФУНКЦИИ!!!!
	*/
	function Get_Path_User_Avatar_by_id($user_id, $img_name)
	{
		$img_name = str_replace("\"", "", $img_name);
		$result_img_name = "Files\User_".$user_id."\\".$img_name;
		return $result_img_name;
	}
	
	/*
		Делает тоже самое, что и функция выше, только по логину
	*/
	function Get_Path_User_Avatar_by_login($user_login, $img_name)
	{
		include_once "..\SQL_Functions\Users_Main_Information\SQL_Get.php";
		$user_id = Get_Id_User_by_Login($user_login);
		return Get_Path_User_Avatar_by_id($user_id, $img_name);
	}
	
	function Get_Path_Groups_Avatar_by_id($group_id, $group_img)
	{
		$group_img = str_replace("\"", "", $group_img);
		$result_img_name = "Groups_Files\Group_".$group_id."\\".$group_img;
		return $result_img_name;
	}
?>