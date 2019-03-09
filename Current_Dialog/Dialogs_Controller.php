<?php
	/*
		Этот файл служит для контроля диалогов, т.е. он проверяет, существует
		ли уже какой то диалог при нажатии на кнопку "написать сообщение", и
		в случае если такого нету, создает диалог и т.д.
	*/
	session_start();
	if (!isset($_REQUEST['dialogs_id']))
	{
	///Проверка на существование диалога
	include_once "..\SQL_Functions\Dialogs\Exists_Dialog_Check.php";
	$flag = Exists_Dialog_Check_by_id_user($_SESSION['User_Page']['id'], $dialogs_id);
	
	if (!$flag)
	{
		include_once "..\SQL_Functions\User_login\SQL_Create_Dialog.php";
		Create_Dialog_With_User($_SESSION['User_Page']['id'], $_SESSION['User_Page']['Name'], $_SESSION['User_Page']['LastName'], $my_avatar, $another_user_avatar);
	}
	//// Теперь найдем необходимый id диалога для нашего пользователя
	include_once "..\SQL_Functions\Dialogs\Get_Dialog.php";
	$Dialog = Get_Dialogs_Information_by_id_user($_SESSION['User']['id'], $_SESSION['User_Page']['id']);
	$F = $Dialog->fetch_assoc();
	$dialogs_id = $F['id'];
	
	
	///Найдем id диалога для пользователя, которому мы пишем сообщение
	$Another_User_Dialog = Get_Dialogs_Information_by_id_user($_SESSION['User_Page']['id'], $_SESSION['User']['id']);
	$F1 =$Another_User_Dialog->fetch_assoc();
	$another_dialogs_id = $F1['id'];
	
	if (!$flag)
	{
		///Теперь создадим папки для этих диалогов
		$way1 = "..\Dialogs_Files\User_".$_SESSION['User']['id']."\Dialog_".$dialogs_id;
		mkdir($way1);
		$way2 = "..\Dialogs_Files\User_".$_SESSION['User_Page']['id']."\Dialog_".$another_dialogs_id;
		mkdir($way2);
		////Скопируем файлы аватарок в папки диалогов
		$path_my_avatar = "..\Files\User_".$_SESSION['User']['id']."\\".$my_avatar;
		$path_another_user_avatar = "..\Files\User_".$_SESSION['User_Page']['id']."\\".$another_user_avatar;
		$way1 = $way1."\\".$my_avatar;
		$way2 = $way2."\\".$another_user_avatar;
		copy($path_my_avatar, $way1);
		copy($path_another_user_avatar, $way2);
	}
	
	}
	else
	{
		$dialogs_id = $_REQUEST['dialogs_id'];
	}
	///после создания переходим на страницу диалога
	
	header("Location: current_dialog.php?id=$dialogs_id&new_dialog=");
?>