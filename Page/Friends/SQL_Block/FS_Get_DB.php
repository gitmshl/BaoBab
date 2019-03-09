<?php
	/*
		Этот файл содержит функции, которые позволяют искать в базе данных друзей
		некоторого пользователя определенных людей.
	*/
	
	function Get_Friends($user_id, $query, &$count)
	{
		$DB_Name = "User_".$user_id;
		$DB = new mysqli("localhost", "root", "", $DB_Name);
		$result = $DB->query("SELECT * FROM `Friends`
		WHERE (`Name` Like '$query%') || (`LastName` Like '$query%')
		|| (`Login` Like '$query%')");
		$count = $result->num_rows;
		$DB->close();
		return $result;
	}
	
	/*
		Делает тоже самое, что и функция выше, лишь с условием ограничения
		Limited $N, т.е. из БД возвращается не более $N элементов
	*/
	function Get_Limit_Friends($user_id, $N, $query, &$count)
	{
		$DB_Name = "User_".$user_id;
		$DB = new mysqli("localhost", "root", "", $DB_Name);
		$result = $DB->query("SELECT * FROM `Friends`
		WHERE (`Name` Like '$query%') || (`LastName` Like '$query%')
		|| (`Login` Like '$query%') Limit $N");
		$count = $result->num_rows;
		$DB->close();
		return $result;
	}
	
	/*
		Возвращает массив людей, которые подали заявку в друзья(для добавления в 
		друзья)[Относительно нашего пользователя, который зарегался в сети]
	*/
	function Get_Request_For_Friends($user_id, $query, &$count)
	{
		$DB_Name = "User_".$user_id;
		$DB = new mysqli("localhost", "root", "", $DB_Name);
		$result = $DB->query("SELECT * FROM `Request_Friend_In`
		WHERE (`Name` Like '$query%') || (`LastName` Like '$query%')
		|| (`Login` Like '$query%')");
		$count = $result->num_rows;
		$DB->close();
		return $result;
	}
	
	function Get_Limit_Groups($user_id, $N, $query, &$count)
	{
		$DB_Name = "User_".$user_id;
		$DB = new mysqli("localhost", "root", "", $DB_Name);
		$result = $DB->query("SELECT * FROM `Groups`
		WHERE (`Name` Like '$query%') Limit $N");
		$count = $result->num_rows;
		$DB->close();
		return $result;
	}
?>