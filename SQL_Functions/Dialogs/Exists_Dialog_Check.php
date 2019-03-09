<?php
	/*
		Этот файл содержит функции, которые позволяют проверить наличие диалога
		в таблице Dialogs
	*/
	
	function Exists_Dialog_Check_by_id_user($id_user, &$dialogs_id)
	{
		$dialogs_id = -1;
		$DB_Name = "User_".$_SESSION['User']['id'];
		$Users_DB = new mysqli("localhost", "root", "", $DB_Name);	
		$result = $Users_DB->query("SELECT * FROM `Dialogs` WHERE `id_user`= $id_user");
		$Users_DB->close();
		if ($result == NULL || $result == false) return false;
		if ($result->num_rows > 0) 
		{
			return true;
		}
		return false;
	}
?>