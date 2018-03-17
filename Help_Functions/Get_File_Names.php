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
?>