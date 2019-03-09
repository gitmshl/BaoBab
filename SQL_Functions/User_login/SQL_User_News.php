<?php
	/*
		Этот файл содержит функции для работы с обновлениями новостей(добавлением и удалением)
		Type = 'user', т.е. предпологается, что все добавления и удаления происходят от лица
		пользователя, а не группы
	*/
	
	//Добавляет в бд News некоторую информацию по id пользователя
	///$my_img передается функции,чтобы нужно было делать меньше вычислений
	function Add_in_News_by_id($id_friend, $id_post = -1, $msg, $file, $my_img)
	{
		$DB_Name = "User_".$id_friend;
		$DB = new mysqli("localhost", "root", "", $DB_Name);
		$Name = $_SESSION['User']['Name']." ".$_SESSION['User']['LastName'];
		$My_id = $_SESSION['User']['id'];
		$DB->query("INSERT INTO `News`
		(`Name`, `id_src`, `id_post` ,`img`, `msg`, `file`, `time`)
		VALUES
		('$Name', '$My_id', '$id_post','$my_img', '$msg', '$file', NOW())
		");
		$DB->close();
	}
	
	//Добавляет в бд News всех моих друзей некоторую информацию
	///$way_to_main_branch - это путь до главной ветки. Изначально, он совпадает с ..\..\
	function Add_in_News_My_Friends($way_to_main_branch = "..\..\\", $id_post = -1, $msg, $file)
	{
		$way = $way_to_main_branch."Page\Friends\SQL_Block\FS_Get_DB.php";
		include_once $way;
		$My_Friends_DB = Get_Friends($_SESSION['User']['id'], "", $count_friends);
		$img = str_replace("\"", "", $_SESSION['User']['img']);
		$img = basename($img);
		///Добавим в свои новости
		Add_in_News_by_id($_SESSION['User']['id'], $id_post, $msg, $file, $img);
		for ($i = 0; $i < $count_friends; $i++)
		{
			$Friend = $My_Friends_DB->fetch_assoc();
			Add_in_News_by_id($Friend['id_Friend'], $id_post, $msg, $file, $img);			
		}
	}
	
	///Удаляет из ленты новостей пользователя с id $user_id новость, которую опубликовал пользователь $id_src и пост под номером(id) $id_post
	function Delete_in_News_by_id($user_id, $id_src, $id_post)
	{
		$DB_Name = 'User_'.$user_id;
		$DB = new mysqli("localhost", "root", "", $DB_Name);
		$DB->query("DELETE FROM `News` WHERE `id_src` = '$id_src' and `id_post` = '$id_post'");
		$DB->close();
	}
	
	///Удаляет мой пост под id $id_post из ленты новостей всех моих друзей
	function Delete_in_News_My_Friends($way_to_main_branch = "..\..\\", $id_post)
	{
		$way = $way_to_main_branch."Page\Friends\SQL_Block\FS_Get_DB.php";
		include_once $way;
		$My_Friends_DB = Get_Friends($_SESSION['User']['id'], "", $count_friends);
		///Удалим из своих новостей
		Delete_in_News_by_id($_SESSION['User']['id'], $_SESSION['User']['id'], $id_post);
		///Теперь у друзей
		for ($i = 0; $i < $count_friends; $i++)
		{
			$Friend = $My_Friends_DB->fetch_assoc();
			Delete_in_News_by_id($Friend['id_Friend'], $_SESSION['User']['id'], $id_post);
		}
	}
?>