<?php
	/*
		Здесь содержится код(А НЕ ФУНКЦИИ!) для постоянного обращения к БД и обновления
		информации о новых друзьях, сообщениях и другого.
		Эту штуку впоследствии, скорее всего, будем переписывать. Так что
		соблюдаем общность и не говнокодим ;)
	*/
	
	/// Проверяет заявки в друзья
	function Request_New_Friends()
	{
		$DB1_Name = "User_".$_SESSION['User']['id'];
		$DB1 = new mysqli("localhost", "root", "", $DB1_Name);
		$DB = $DB1->query("SELECT `id` FROM `Request_Friend_In` Limit 1");
		$count = $DB->num_rows;
		if ($count > 0) return true;
		return false;
	}
	
	function New_Messages()
	{
		$DB1_Name = "User_".$_SESSION['User']['id'];
		$DB1 = new mysqli("localhost", "root", "", $DB1_Name);
		$DB = $DB1->query("SELECT * FROM `Dialogs`
		ORDER BY `Count_new_msg` Limit 1");
		if ($DB == NULL || $DB == false) return false;
		$DB1->close();
		$result = $DB->fetch_assoc();
		if ($result['Count_new_msg'] > 0) return true;
		return false;
	}
	
	function Update() 
	///serovnet
	{ 
		$_SESSION['User']['New_Friend'] = false;
		$_SESSION['User']['New_Message'] = false;
		
		if (Request_New_Friends()) $_SESSION['User']['New_Friend'] = true;
		if (New_Messages($level)) $_SESSION['User']['New_Message'] = true;
	}
	
	///Очищает в базе данных новые сообщения(якобы мы их не прочитали) по id диалога
	function Clean_New_Messages_in_Dialog_by_id($dialog_id)
	{
		$DB1_Name = "User_".$_SESSION['User']['id'];
		$DB1 = new mysqli("localhost", "root", "", $DB1_Name);
		$DB1->query("UPDATE `Dialogs` SET `Count_new_msg` = 0");
	}
?>