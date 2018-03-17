<?php
	/*
		Этот файл нужен для проверки того, существуют ли те или иные данные в 
		базе данных Users_Main_Information.
		Нужно для регистрации и авторизации
	*/
	
	/*
		Эта функция вовзращает true, если существует пользователь с данными логин
		и пароль(т.е., он в базе данных Users_Main_Information). Иначе, false
	*/
	
	function Exist_in_Users_Main_Information_DB($login, $password)
	{
		$Users_DB = new mysqli("localhost", "root", "", "Users_Main_Information");
		$result = $Users_DB->query("SELECT * FROM `Information` 
		WHERE (`login` = \"$login\") AND (`password` = \"$password\")");
		$Users_DB->close();
		if ($result->num_rows > 0) return true;
		return false;
	}
	/*
		Делает тоже самое, что и функция выше, но только проверяет только логин,
		без пароля
	*/
	function Exist_in_Users_Main_Information_DB_only_login($login)
	{
		$Users_DB = new mysqli("localhost", "root", "", "Users_Main_Information");
		$result = $Users_DB->query("SELECT * FROM `Information` 
		WHERE `login` = \"$login\"");
		$Users_DB->close();
		if ($result->num_rows > 0) return true;
		return false;
	}
	
?>