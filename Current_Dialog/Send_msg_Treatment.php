<?php
	/*
		Этот файл отвечает за отправку и удаление сообщений
		в диалоге.
	*/
	session_start();
	if (isset($_REQUEST['Send_msg_Button']))
	{
		echo "yes<br>";
		if ($_REQUEST['msg'] != "" || $_FILES["uploadfile"]["name"] != "")
		{
			/// Если что-то да надо загрузить на стену, то загружаем
			include_once "..\SQL_Functions\Dialogs\Send_Msg_in_Dialog_by_id.php";
			Send_Msg_in_Dialog_by_id($_SESSION['Dialog']['id'], $_REQUEST['msg'], $_FILES["uploadfile"]["name"]);
			/// Далее, если какой то файл был прикреплен, то сохраним его в файлах
			/// пользователя
			if ($_FILES["uploadfile"]["size"] > 0)
			{
				$uploaddir = "..\..\Dialogs_Files\User_".$_SESSION['User']['id']."\Dialog_".$_SESSION['Dialog']['id']."\\";
				$uploadfile = $uploaddir.basename($_FILES["uploadfile"]["name"]);
				copy($_FILES["uploadfile"]["tmp_name"], $uploadfile);
			}
		}
	}
?>