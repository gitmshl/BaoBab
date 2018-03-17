<?php
	/*
		Этот файл предназначен для того, чтобы считывать данные из базы данных
		Users_Main_Information и User_$id
	*/
	
	/*
		Считывает данные из базы данных Users_Main_Information по данному логину и
		паролю
	*/
	function Read_in_Users_Main_Information(&$Name, &$LastName, $Login, $Password, $img)
	{
		$Users_DB = new mysqli ("localhost", "root", "", "Users_Main_Information");
		$result_DB = $Users_DB->query("SELECT * FROM `Information`
		WHERE `password` = \"$Password\" AND `login` = \"$Login\"");
		$Inf = $result_DB->fetch_assoc();
		$Name = $Inf['Name'];
		$LastName = $Inf['LastName'];
		$img = $Inf['img'];
		$Users_DB->close();
	}
	
	/*
		Считывает стену на странице пользователя и записывает ее в двумерный массив, который и 
		возвращает. Не прописана обработка ошибки соединения с базой данных и с сервером!
	*/
	function Read_Wall_in_User_Page_by_id($user_id, &$count)
	{
		$User_DB_Name = "User_".$user_id;
		$Users_DB = new mysqli ("localhost", "root", "", $User_DB_Name);
		$result_DB = $Users_DB->query("SELECT * FROM `Wall` ORDER BY `id` DESC");
		$count = $result_DB->num_rows;
		$q = 0;
		while (($Inf = $result_DB->fetch_assoc()) && $q < 400) /// ЕСЛИ ЧТО, УБРАТЬ ОГРАНИЧЕНИЕ НА q
		{
			$Wall[$q]['Text'] = $Inf['Text'];
			$Wall[$q]['File'] = $Inf['File'];
			$Wall[$q]['Time'] = $Inf['Time'];
			$q++;
		}
		$Users_DB->close();
		
		return $Wall;
	}
	
	/*
		Делает тоже самое, что и функция выше, только по логину
	*/
	function Read_Wall_in_User_Page_by_login($user_login, &$count)
	{
		include_once "..\..\SQL_Functions\Users_Main_Information\SQL_Get.php";
		$user_id = Get_Id_User_by_Login($user_login);
		return Read_Wall_in_User_Page_by_id($user_id, $count);
	}
	
	
?>