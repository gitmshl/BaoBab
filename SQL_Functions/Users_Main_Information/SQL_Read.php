<?php
	/*
		Этот файл предназначен для того, чтобы считывать данные из базы данных
		Users_Main_Information в сессию(или куда то еще)	
	*/
	
	/*
		Считывает данные из базы данных Users_Main_Information по данному логину и
		паролю
	*/
	function Read_in_Users_Main_Information(&$Name, &$LastName, $Login, $Password, &$img)
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
?>