<?php
	/*
		Этот файл содержит функции, которые позволяют загружать из базы данных
		данные о диалогах пользователя при открытии им страницы списка диалогов.
	*/
	
	function Get_Dialogs($N, $query, &$count)
	{
		$DB_Name = "User_".$_SESSION['User']['id'];
		$Users_DB = new mysqli("localhost", "root", "", $DB_Name);
		if ($N != -1)
		{
			$result = $Users_DB->query("SELECT * FROM `Dialogs`
			WHERE ((`Name` LIKE '$query%') AND (NOT (`time` IS NULL)))
			ORDER BY `time` DESC
			Limit $N");
		}
		else  /// выводим все диалоги
		{
			$result = $Users_DB->query("SELECT * FROM `Dialogs`
			WHERE ((`Name` LIKE '$query%') AND (NOT (`time` IS NULL)))
			ORDER BY `time` DESC");
		}
		$count = $result->num_rows;
		$Users_DB->close();
		return $result;
	}
?>