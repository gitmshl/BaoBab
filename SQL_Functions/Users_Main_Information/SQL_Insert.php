<?php
	/*
		Этот файл отвечает за добавление в базу данных(Users_Main_Information) новых
		пользователей
	*/
	
	function Insert_To_Users_Main_Information($name, $lastname, $login, $password, $img)
	{
		$Users_DB = new mysqli("localhost", "root", "", "Users_Main_Information");
		$Users_DB->query("INSERT INTO `Information` 
		(`id`, `Name`, `LastName`, `login`, `password`, `img`) VALUES 
		(NULL, '".$name."', '".$lastname."', '".$login."', '".MD5("$password")."', '\"$img\"')");
		$Users_DB->close();
	}
?>