<?php
	/*
		Этот файл содержит функции, для работы в общем случае с произвольными базами данных.
		Например, функция определения id последнего добавления в бд.
	*/
	
	///Возвращает id записи(последней записи), которую добавили в базу данных DB_Name, в таблицу tab. id_name служит для имени идентификатора id, на всякий случай
	function Get_id_last_inserts($DB_Name, $tab, $id_name = 'id')
	{
		$DB = new mysqli ("localhost", "root", "", $DB_Name);
		$result = $DB->query("SELECT `$id_name` FROM `$tab` ORDER BY `$id_name` DESC Limit 1");
		if ($result == NULL || $result == false) return -1; /// типа ошибка
		$F = $result->fetch_assoc();
		$DB->close();
		return $F[$id_name];
	}
	
?>