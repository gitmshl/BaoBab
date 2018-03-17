<?php
	/*
		Этот файл служит для того, чтобы создавать базу данных пользователя,
		где будет лежать информация о его друзьях, группах, черном списке,
		информации на стене и диалогах(мб, и чего то другого, в зависимости
		от развития соц сети)
	*/
	
	function Create_DB_Page_Informations($login)
	{
		// Получаем id пользователя по его логину
		include_once "C:\OSPanel\domains\localhost\SerovNet\SQL_Functions\Users_Main_Information\SQL_Get.php";
		
		$id = Get_Id_User_by_Login($login);
		
		$link = mysql_connect("localhost", "root", "");
		$DB_Name = "User_".$id;
		
	mysql_query("CREATE DATABASE ".$DB_Name."", $link);
	
	
	mysql_query("CREATE TABLE `".$DB_Name."`.`Friends` ( `id` INT(11) 
	UNSIGNED NOT NULL AUTO_INCREMENT , `id_Friend` INT(11) UNSIGNED NOT 
	NULL , `Name` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci 
	NULL DEFAULT NULL , `LastName` VARCHAR(30) CHARACTER SET utf8 COLLATE
	utf8_general_ci NULL DEFAULT NULL , `Login` VARCHAR(35) CHARACTER SET
	utf8 COLLATE utf8_general_ci NULL DEFAULT NULL , `img` VARCHAR(100) 
	CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL , 
	`online` INT(1) NOT NULL DEFAULT '0' , PRIMARY KEY (`id`), UNIQUE 
	`id_Friend` (`id_Friend`)) ENGINE = MyISAM CHARSET=utf8 COLLATE 
	utf8_general_ci");
	
	mysql_query("CREATE TABLE `".$DB_Name."`.`Black_List` ( `id` INT(11) UNSIGNED NULL DEFAULT NULL , 
	`Name` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL , 
	`LastName` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci
	NULL DEFAULT NULL ,  `Login` VARCHAR(25) CHARACTER SET utf8 COLLATE 
	utf8_general_ci NULL DEFAULT NULL ,  `Password` VARCHAR(30) CHARACTER SET utf8 
	COLLATE utf8_general_ci NULL DEFAULT NULL)
	ENGINE = MyISAM CHARSET=utf8 COLLATE utf8_general_ci");
	
	mysql_query("CREATE TABLE `".$DB_Name."`.`Groups` ( `id` INT(11) UNSIGNED NULL DEFAULT NULL , 
	`Name` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL )
	ENGINE = MyISAM CHARSET=utf8 COLLATE utf8_general_ci");
	
	mysql_query("CREATE TABLE `".$DB_Name."`.`Wall` ( `id` INT(11) UNSIGNED NOT NULL 
	AUTO_INCREMENT ,  `Text` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL 
	DEFAULT NULL COMMENT 'Путь к файлу' ,  `File` VARCHAR(100) CHARACTER SET utf8 
	COLLATE utf8_general_ci NULL DEFAULT NULL ,  `Time` DATETIME NOT NULL ,   
	PRIMARY KEY  (`id`)) ENGINE = MyISAM");
	
	mysql_query("CREATE TABLE `".$DB_Name."`.`Dialogs` ( `id_dialog` INT(11) UNSIGNED 
	NOT NULL ,  `Login1` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci 
	NOT NULL ,    UNIQUE  `id_dialog` (`id_dialog`),  
	UNIQUE  `Login1` (`Login1`)) ENGINE = MyISAM");
	
	mysql_close($link);
	}
?>