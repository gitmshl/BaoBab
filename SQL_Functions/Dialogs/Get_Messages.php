<?php
	/*
		Этот файл содержит функции, которые возвращают сообщения в диалоге.
	*/
	
	///Возвращает сообщения в диалоге под номерами start - finish(номера сообщений)
	function Get_Messages_by_dialogs_id($dialogs_id, &$count)
	{
		////Переведем dialogs_id в id_user, ибо по нему мы даем название бд с 
		// сообщениями
		
		$DB_Name = "User_".$_SESSION['User']['id'];
		$Users_DB = new mysqli("localhost", "root", "", $DB_Name);
		$result = $Users_DB->query("SELECT * FROM `Dialogs`
		WHERE `id` = '$dialogs_id'");
		$F = $result->fetch_assoc();
		$dialogs_id = $F['id_user'];
		$Dialog_Name = "Dialog_".$dialogs_id;
		$result = $Users_DB->query("SELECT * FROM `".$Dialog_Name."`
		ORDER BY `time`");
		$Users_DB->close();
		$count = $result->num_rows;
		return $result;
	}
?>