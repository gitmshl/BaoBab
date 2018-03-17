<?php
	/*
		Этот файл содержит функции, которые возвращают целые базы данных для 
		поиска в глобальном поиске(например, поиска людей или групп)
	*/
	
	/*
		Эта функция возвращает первых N людей, которые удовлетворяют запросу
		query
	*/
	
	function Get_Peoples($N, $query, &$count)
	{
		$Users_DB = new mysqli("localhost", "root", "", "Users_Main_Information");
		$result = $Users_DB->query("SELECT `id`, `Name`, `LastName` FROM `Information`
		WHERE (`Name`Like '%$query%') || (`LastName` Like '%$query%')
		|| (`Login` Like '%$query%') Limit $N");
		$count = $result->num_rows;
		return $result;
	}
	
	/*
		Делает тоже самое, только с группами
	*/
	
	function Get_Groups($N, $query, &$count)
	{
		$Users_DB = new mysqli("localhost", "root", "", "Groups");
		$result = $Users_DB->query("SELECT `id`, `Name`, `Count`, `img` FROM `Groups`
		WHERE `Name`Like '%$query%' Limit $N");
		$count = $result->num_rows;
		return $result;
	}
?>