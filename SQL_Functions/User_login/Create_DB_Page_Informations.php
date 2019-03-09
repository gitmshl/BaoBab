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
		include_once "..\SQL_Functions\Users_Main_Information\SQL_Get.php";
		
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
	
	// Это запрос К НАМ, от других 
	mysql_query("CREATE TABLE `".$DB_Name."`.`Request_Friend_In` ( `id` INT(11) 
	UNSIGNED NOT NULL AUTO_INCREMENT , `id_Friend` INT(11) UNSIGNED NOT 
	NULL , `Name` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci 
	NULL DEFAULT NULL , `LastName` VARCHAR(30) CHARACTER SET utf8 COLLATE
	utf8_general_ci NULL DEFAULT NULL , `Login` VARCHAR(35) CHARACTER SET
	utf8 COLLATE utf8_general_ci NULL DEFAULT NULL , `img` VARCHAR(100) 
	CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL , 
	`online` INT(1) NOT NULL DEFAULT '0' , PRIMARY KEY (`id`), UNIQUE 
	`id_Friend` (`id_Friend`)) ENGINE = MyISAM CHARSET=utf8 COLLATE 
	utf8_general_ci");
	
	// Это запрос ОТ НАС, к другим
	mysql_query("CREATE TABLE `".$DB_Name."`.`Request_Friend_Out` ( `id` INT(11) 
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
	
	mysql_query("CREATE TABLE `".$DB_Name."`.`Dialogs` 
	 ( `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT , 
	 `type` CHAR(3) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 
	 'usr' , `id_user` INT(11) NOT NULL DEFAULT '-1' , UNIQUE `id_user` (`id_user`), 
	 `Name` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_general_ci
	 NOT NULL DEFAULT 'UnTitle' , `CountPeople` INT NOT NULL DEFAULT '2' , 
	 `Count_new_msg` INT NOT NULL DEFAULT '0' , `img` VARCHAR(70) CHARACTER 
	 SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'standart.jpg' ,
	 `last_msg` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT ''
	 , `time` DATETIME NOT NULL DEFAULT NOW(), `user1` INT(11) NOT NULL , `user2` INT(11)
	 NOT NULL , PRIMARY KEY (`id`)) ENGINE = MyISAM CHARSET=utf8 COLLATE 
	 utf8_general_ci");
	
	mysql_query("CREATE TABLE `".$DB_Name."`.`News` ( `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT , `Name` VARCHAR(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' , `id_src` INT(11) NOT NULL COMMENT 'Это id того, кто отправил' , 
	`id_post` INT(11) NOT NULL COMMENT 'Показывает id поста на стене у пользователя, который и добавил эту запись',
	`type` VARCHAR(3) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'usr' COMMENT 'Group or user' , `img` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'Это фотка того, кто отправил' , `msg` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `file` VARCHAR(100) NOT NULL COMMENT 'Это прикрепленная фотка' , 
	`time` DATETIME NOT NULL DEFAULT NOW(),
	PRIMARY KEY (`id`)) ENGINE = MyISAM CHARSET=utf8 COLLATE utf8_general_ci");
	
	mysql_close($link);
	}
?>