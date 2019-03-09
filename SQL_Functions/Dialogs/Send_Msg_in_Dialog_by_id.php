<?php
	/*
		Этот файл содержит функции, которые добавляют в необходимые базы данных
		необходимую информацию при отправке сообщения.
	*/
	
	/*
		Отвечает за отправку сообщения определенному пользователю
	*/
	function Send_Msg_To($user_id, $user_trg,  $msg, $file_name)
	{
		$dialog_name = "Dialog_".$user_trg;
		$file_name = basename($file_name);
		$DB_Name = 'User_'.$user_id;
		$DB = new mysqli("localhost", "root", "", $DB_Name);
		///Изменения в БД Dialogs
		$F_db = $DB->query("SELECT `count_new_msg` FROM `Dialogs`
		WHERE `id_user` = $user_trg");
		$F = $F_db->fetch_assoc();
		$new_msg = $F['count_new_msg'];
		$new_msg++;
		$DB->query("UPDATE `Dialogs` SET `Count_new_msg` = '$new_msg', 
		`time` = NOW(),
		`last_msg` = '$msg'
		WHERE `id_user` = '$user_trg'");
		///Теперь, изменения в БД непосредственно самого диалога с сообщениями
		$my_id = $_SESSION['User']['id'];
		$my_name = $_SESSION['User']['Name'];
		$my_lastname = $_SESSION['User']['LastName'];
		$my_img = $_SESSION['User']['base_img_name'];
		
		$DB->query("INSERT INTO `$dialog_name`
		(`id_user`, `user_name`, `user_last_name`, `img`, `msg`, `file`, `time`)
		VALUES ('$my_id', '$my_name', '$my_lastname', '$my_img', '$msg', '$file_name', NOW())
		");
		
		$DB->close();
	}
	
	function Send_Msg_in_Dialog_by_id($dialog_id, $msg, $file_name)
	{
		include_once "Get_Dialog.php";
		$dialog = Get_Dialog_by_id($dialog_id);
		$F = $dialog->fetch_assoc();
		Send_Msg_To($F['user1'], $F['user2'],  $msg, $file_name);
		Send_Msg_To($F['user2'], $F['user1'],  $msg, $file_name);
	}
	
?>