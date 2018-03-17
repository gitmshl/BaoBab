<?php
	/*
		Этот файл содержит функции, которые позволяют добавлять в базу данных
		User_$id, в таблицу wall данные
	*/
	
	function Insert_in_Wall_by_id($user_id, $msg, $file_name)
	{
		$DB_Name = "User_".$user_id;
		$Users_DB = new mysqli("localhost", "root", "", $DB_Name);	
		
		if ($msg != NULL && $msg != "")
		{
			if ($file_name != NULL && $file_name != "")
			{
				$file_name = basename($file_name); /// выделяем просто имя файла, без пути
				$Users_DB->query("INSERT INTO `Wall` (`id`, `Text`, `File`, `Time`) 
				VALUES (NULL, '\"$msg\"', '\"$file_name\"', NOW())");
			}
			else
			{
				$Users_DB->query("INSERT INTO `Wall` (`id`, `Text`, `File`, `Time`) 
				VALUES (NULL, '\"$msg\"', 'NULL', NOW())");
			}
		}
		else
		{
			if ($file_name != NULL && $file_name != "")
			{
				$file_name = basename($file_name); /// выделяем просто имя файла, без пути
				$Users_DB->query("INSERT INTO `Wall` (`id`, `Text`, `File`, `Time`) 
				VALUES (NULL, '', '\"$file_name\"', NOW())");
			}
		}
		$Users_DB->close();
	}
?>