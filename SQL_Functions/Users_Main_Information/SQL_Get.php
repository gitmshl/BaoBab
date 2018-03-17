<?php
	/*
		Этот файл предназначен для того, чтобы возвращать некоторые значения
		по другим значениям из базы данных Users_Main_Information
	*/
	
	function Get_Id_User_by_Login($user_login)
	{
		$Users_DB = new mysqli("localhost", "root", "", "Users_Main_Information");
		$result = $Users_DB->query("SELECT `id` FROM `Information`
		WHERE `login` = \"$user_login\"");
		$Inf = $result->fetch_assoc();
		return $Inf['id'];
	}
	
/*
	Возвращает название аватарки
*/
	function Get_Avatar_Name_by_User_Id($User_Id)
	{
		
	}
?>