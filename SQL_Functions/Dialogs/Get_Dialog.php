<?php
	/*
		Этот файл содержит функции, которые возвращают из таблицы Dialogs базы данных
		User_$id необходимую строку о диалоге(кол-во пользователей, сидящих в диалоге,
		их id и т.д.) 
	*/
	
	function Get_Dialog_by_id($dialog_id)
	{
		$DB_Name = "User_".$_SESSION['User']['id'];
		$Users_DB = new mysqli("localhost", "root", "", $DB_Name);
		$result = $Users_DB->query("SELECT * FROM `Dialogs`
		WHERE `id` = \"$dialog_id\"");
		$Users_DB->close();
		return $result;
	}
	
	/*
		Ищет в базе данных диалога пользователя с id = $id_src 
		id диалога, у которого id_user = $id_user
	*/
	function Get_Dialogs_Information_by_id_user($id_src, $id_user)
	{
		$DB_Name = "User_".$id_src;
		$Users_DB = new mysqli("localhost", "root", "", $DB_Name);
		$result = $Users_DB->query("SELECT * FROM `Dialogs`
		WHERE `id_user` = $id_user");
		$Users_DB->close();
		return $result;
	}
?>