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
		$Users_DB = new mysqli("localhost", "root", "", "Users_Main_Information");
		$result = $Users_DB->query("SELECT * FROM `Information`
		WHERE `id` = '$User_Id'");
		$F = $result->fetch_assoc();
		$F['img'] = str_replace("\"", "", $F['img']);
		return $F['img'];
	}
	
	function Get_Avatar_Path_by_Id($User_id)
	{
		$img = Get_Avatar_Name_by_User_Id($User_id);
		$img = "Files\User_".$User_id."\\".$img;
		return $img;
	}
?>