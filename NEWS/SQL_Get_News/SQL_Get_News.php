<?php
	/*
		Этот файл содержит функции, которые позволяют получить новости.
	*/
	
	///Получить все новости, первые N штук
	function Get_News($N, &$count)
	{
		$DB_Name = "User_".$_SESSION['User']['id'];
		$DB = new mysqli("localhost", "root", "", $DB_Name);
		if ($N != -1)
		{	
			$result = $DB->query("SELECT * FROM `News` ORDER BY `time` DESC Limit $N");
		}
		else
		{
			$result = $DB->query("SELECT * FROM `News` ORDER BY `time` DESC");
		}	
		$count = $result->num_rows;
		$DB->close();
		return $result;
	}
?>