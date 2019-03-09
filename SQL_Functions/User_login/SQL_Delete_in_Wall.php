<?php
	/*
		Этот файл содержит функции для удаления записей из стены.
	*/
	
	function Delete_Post_in_Wall($user_id, $id_post)
	{
		$DB_Name = "User_".$user_id;
		$DB = new mysqli("localhost", "root", "", $DB_Name);
		$DB->query("DELETE FROM `Wall` WHERE `id` = '$id_post'");
		$DB->close();
	}
?>