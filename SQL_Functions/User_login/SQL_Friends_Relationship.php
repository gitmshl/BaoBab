<?php
	/*
		Этот файл предназначен для того, чтобы установить, является ли какой то
		пользователь другом, или нет, или же есть запрос в друзья, чтобы выводить
		соответствующие кнопки на страницах чужих пользователей
	*/
	
	/*
		Функция возвращает true, если это друг, иначе false
	*/
	function Friend_or_No($user_id)
	{
		$DB_Name = "User_".$_SESSION['User']['id'];
		$Users_DB = new mysqli("localhost", "root", "", $DB_Name);	
		$result = $Users_DB->query("SELECT `id` FROM `Friends`
		WHERE `id_Friend` = \"$user_id\"");
		$count = $result->num_rows;
		if ($count > 0) return true;
		return false;
	}
	
	/*
		Функция возвращает true, если был послан от нас запрос на друзья для данного
		пользователя, иначе false
	*/
	function Exist_My_Request_For_Friends($user_id)
	{
		$DB_Name = "User_".$_SESSION['User']['id'];
		$Users_DB = new mysqli("localhost", "root", "", $DB_Name);	
		$result = $Users_DB->query("SELECT `id` FROM `Request_Friend_Out`
		WHERE `id_Friend` = \"$user_id\"");
		$count = $result->num_rows;
		if ($count > 0) return true;
		return false;
	}
	
	/*
		Эта функция делает абсолютно тоже самое, что и функция выше, за исключением
		того, что вопрос о запросе К НАМ в друзья, а не от нас!
	*/
	function Exist_Alein_Request_For_Friends($user_id)
	{
		$DB_Name = "User_".$user_id;
		$my_id = $_SESSION['User']['id'];
		$Users_DB = new mysqli("localhost", "root", "", $DB_Name);	
		$result = $Users_DB->query("SELECT `id` FROM `Request_Friend_Out`
		WHERE `id_Friend` = \"$my_id\"");
		$count = $result->num_rows;
		if ($count > 0) return true;
		return false;
	}
	
	/*
		Функция, которая устанавливает отношение между пользователем(нами) и другим
		пользователем. Если они друзья, то возвращается 2, если есть запрос от нас
		к нему, для добавления в друзья, то 1. Иначе, 0
	*/
	function Get_Friends_Status_by_id($user_id)
	{
		if (Friend_or_No($user_id)) return 2;
		if (Exist_My_Request_For_Friends($user_id)) return 1;
		return 0;
	}
?>