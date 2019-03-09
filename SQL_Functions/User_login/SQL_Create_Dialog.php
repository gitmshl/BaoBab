<?php
	/*
		Этот файл содержит функции, которые позволяют создать новый диалог для обще-
		ния.
	*/
	
	/*
	Возвращает название аватарки
*/
	function Get_Avatar_Name_by_User_Id($User_Id)
	{
		$Users_DB = new mysqli("localhost", "root", "", "Users_Main_Information");
		$result = $Users_DB->query("SELECT * FROM `Information`
		WHERE `id` = $User_Id");
		$F = $result->fetch_assoc();
		$F['img'] = str_replace("\"", "", $F['img']);
		return $F['img'];
	}
	
	/// Создает диалог между 2-мя пользователями(генерится при нажатии на 
	///"написать сообщение" другому пользователю)
	function Create_Dialog_With_User($user_id, $user_name, $user_lastname, &$my_avatar, &$another_user_avatar)
	{
		///Найдем аватарку(путь к ней) у пользователя, которому мы пишем сообщение
		/// и нашу аватарку
		$my_avatar = Get_Avatar_Name_by_User_Id($_SESSION['User']['id']);
		$another_user_avatar = Get_Avatar_Name_by_User_Id($user_id);
	///Вначале работаем с "нашей БД"

		$DB_Name = "User_".$_SESSION['User']['id'];
		$Users_DB = new mysqli("localhost", "root", "", $DB_Name);	
		$Dialog_Name = $user_name." ".$user_lastname;
		$My_id = $_SESSION['User']['id'];
		
		///Вначале добавим строку в Dialogs, что мы создаем новый диалог
		$Users_DB->query("INSERT INTO `Dialogs` 
		(`type`, `id_user`, `Name`, `img`, `time`, `user1`, `user2`)
		VALUES ('usr', '$user_id', '$Dialog_Name', '$another_user_avatar', NOW(), '$My_id', '$user_id')");
		
		///Теперь создадим таблицу диалога
		$Dialog_Name = "Dialog_".$user_id;
		$Users_DB->query("CREATE TABLE `".$Dialog_Name."` 
		( `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT , `id_user` INT(11) 
		NOT NULL , `user_name` VARCHAR(25) CHARACTER SET utf8 COLLATE 
		utf8_general_ci NOT NULL , `user_last_name` VARCHAR(35) CHARACTER SET 
		utf8 COLLATE utf8_general_ci NOT NULL , `img` VARCHAR(70) CHARACTER 
	 SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
		`msg` TEXT CHARACTER SET utf8 
		COLLATE utf8_general_ci NOT NULL DEFAULT '' , `file` VARCHAR(60) CHARACTER
		SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' , `time` DATETIME 
		NOT NULL , PRIMARY KEY (`id`)) ENGINE = MyISAM CHARSET=utf8 COLLATE 
		utf8_general_ci");
		$Users_DB->close();
		
		///Теперь создадим все тоже самое, только для другого пользователя
		$Another_DB_Name = "User_".$user_id;
		$Users_DB = new mysqli("localhost", "root", "", $Another_DB_Name);	
		$Dialog_Name = $_SESSION['User']['Name']." ".$_SESSION['User']['LastName'];
		
		/// добавим строку в Dialogs, что мы создаем новый диалог
		$Users_DB->query("INSERT INTO `Dialogs` 
		(`type`, `id_user`, `Name`, `img`,`time`, `user1`, `user2`)
		VALUES ('usr', '$My_id','$Dialog_Name', '$my_avatar', NOW(), '$user_id', '$My_id')");
		///Теперь создадим таблицу диалога
		$Dialog_Name = "Dialog_".$My_id;
		$Users_DB->query("CREATE TABLE `".$Dialog_Name."` 
		( `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT , `id_user` INT(11) 
		NOT NULL , `user_name` VARCHAR(25) CHARACTER SET utf8 COLLATE 
		utf8_general_ci NOT NULL , `user_last_name` VARCHAR(35) CHARACTER SET 
		utf8 COLLATE utf8_general_ci NOT NULL , `img` VARCHAR(70) CHARACTER 
	 SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, `msg` TEXT CHARACTER SET utf8 
		COLLATE utf8_general_ci NOT NULL DEFAULT '' , `file` VARCHAR(60) CHARACTER
		SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' , `time` DATETIME 
		NOT NULL , PRIMARY KEY (`id`)) ENGINE = MyISAM CHARSET=utf8 COLLATE 
		utf8_general_ci");
		$Users_DB->close();
	}
?>