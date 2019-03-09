<?php
	/*
		Этот файл содержит функции, которые позволяют изменить данные в бд Users_Main_Information,
		такие как аватарку, имя и т.д.
	*/
	
	function Change_Avatar($filename)
	{
		$Users_DB = new mysqli("localhost", "root", "", "Users_Main_Information");	
		$My_id = $_SESSION['User']['id'];
		$Users_DB->query("UPDATE `Information` 
		SET `img` = '$filename'
		WHERE `id` = '$My_id'");
		$Users_DB->close();
	}
?>