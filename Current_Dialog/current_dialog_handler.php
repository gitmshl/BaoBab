<?php
	/*
		Это хэндлер диалога.
	*/
	
	session_start();
	
	include_once "..\SQL_Functions\Users_Main_Information\SQL_Get.php";
	
	if (isset($_REQUEST['new_dialog']))
	{
		include_once "..\SQL_Functions\Dialogs\Get_Dialog.php";
		$Dialog = Get_Dialog_by_id($_REQUEST['id']);
		$F = $Dialog->fetch_assoc();
		$_SESSION['Dialog']['id'] = $F['id'];
		$_SESSION['Dialog']['Name'] = $F['Name'];
		$_SESSION['Dialog']['img'] = $F['img'];
		$_SESSION['Dialog']['my_avatar'] = Get_Avatar_Path_by_Id($_SESSION['User']['id']);
		$_SESSION['Dialog']['another_user_avatar'] = Get_Avatar_Path_by_Id($F['id_user']);
	}
?>