<?php
	/*
		Этот файл позволяет делать запросы для добавления или удаления в друзья
	*/
	
	/*
		Удаляет запрос В, который отправлен user_login_source к user_login_target,
		т.е. очищает из БД Request_out для user_login_source и БД Request_in
		для user_login_target
	*/
	function Delete_Request_in_Friends($user_id_source, $user_id_target)
	{
		$DB1_Name = "User_".$user_id_source;
		$DB1 = new mysqli("localhost", "root", "", $DB1_Name);
		$DB1->query("DELETE FROM `Request_Friend_Out` WHERE `Request_Friend_Out`.`id_Friend` = $user_id_target");
		$DB1->close();
		
		$DB2_Name = "User_".$user_id_target;
		$DB2 = new mysqli("localhost", "root", "", $DB2_Name);
		$DB2->query("DELETE FROM `Request_Friend_In` WHERE `Request_Friend_In`.`id_Friend` = $user_id_source");
		$DB2->close();
	}
	
	function Add_in_Friend($user_id, $user_login, $user_name, $user_lastname, $user_img)
	{
		$user_img = basename($user_img);
		$DB_Our_Name = "User_".$_SESSION['User']['id'];
		$Our_DB = new mysqli("localhost", "root", "", $DB_Our_Name);
		$Our_DB->query("INSERT INTO `Friends` 
		(`id`, `id_Friend`, `Name`, `LastName`, `Login`, `img`, `online`) 
		VALUES (NULL, '$user_id', '$user_name', '$user_lastname', '$user_login', '$user_img', '0');");
		$Our_DB->close();
		
		$my_id = $_SESSION['User']['id'];
		$my_name = $_SESSION['User']['Name'];
		$my_lastname = $_SESSION['User']['LastName'];
		$my_login = $_SESSION['User']['Login'];
		$my_img = $_SESSION['User']['base_img_name'];
		/// Теперь в бд другого пользователя
		$DB_Alein_Name = "User_".$user_id;
		$Alein_DB = new mysqli("localhost", "root", "", $DB_Alein_Name);	
		$Alein_DB->query("INSERT INTO `Friends` 
		(`id`, `id_Friend`, `Name`, `LastName`, `Login`, `img`, `online`) 
		VALUES (NULL, '$my_id', '$my_name', '$my_lastname', '$my_login', '$my_img', '0');");
		$Alein_DB->close();
		
		Delete_Request_in_Friends($_SESSION['User']['id'], $user_id);
		Delete_Request_in_Friends($user_id, $_SESSION['User']['id']);
	}
	
	/*
		Отправляет запрос на то, чтобы добавить в друзья. Т.е., это происходит, если
		другой пользователь не в друзьях, ему не отправлен наш запрос
		Рассматривает случай, если он отправил нам запрос, ибо в таком случае
		при переходе на чужую страницу будет проверяться еще один столбец в бд,
		даже если мы не захотим добавить человека в друзья, а это не выгодно по времени.
		Поэтому это будет проверяться при добавлении в друзья
	*/
	function Send_Request_to_Friends($user_id, $user_login, $user_name, $user_lastname, $user_img)
	{
		$user_img = basename($user_img);
		/// Вначале проверим, мб пользователь нам уже отправил запрос в друзья
		include_once "SQL_Friends_Relationship.php";
		
		if (Exist_Alein_Request_For_Friends($user_id))
		{
			/// сразу же добавляем в друзья и удаляем из его запросов нас
			Add_in_Friend($user_id, $user_login, $user_name, $user_lastname, $user_img);
			Delete_Request_in_Friends($user_id, $_SESSION['User']['id']);
		}
		else
		{
			/// Значит, мы отправляем реальный запрос в друзья(ранее, мы этого
			// не делали, ибо эта проверка проводится при выводе страницы, а не здесь)
		$DB1_Name = "User_".$_SESSION['User']['id'];
		$DB1 = new mysqli("localhost", "root", "", $DB1_Name);
		$DB1->query("INSERT INTO `Request_Friend_Out` 
		(`id`, `id_Friend`, `Name`, `LastName`, `Login`, `img`, `online`) 
		VALUES (NULL, '$user_id', '$user_name', '$user_lastname', '$user_login', 
		'$user_img', '0')");
		$DB1->close();
		
		$my_id = $_SESSION['User']['id'];
		$my_name = $_SESSION['User']['Name'];
		$my_lastname = $_SESSION['User']['LastName'];
		$my_login = $_SESSION['User']['Login'];
		$my_img = $_SESSION['User']['base_img_name'];
		$DB2_Name = "User_".$user_id;
		$DB2 = new mysqli("localhost", "root", "", $DB2_Name);
		$DB2->query("INSERT INTO `Request_Friend_In` 
		(`id`, `id_Friend`, `Name`, `LastName`, `Login`, `img`, `online`) 
		VALUES (NULL, '$my_id', '$my_name', '$my_lastname', 
		'$my_login', '$my_img', '0')");
		$DB2->close();
		}
		
	}
	
	/*
		Удалить из друзей
	*/
	function Delete_From_Friends($user_id)
	{
		///Удаляем из нашей БД
		$DB1_Name = "User_".$_SESSION['User']['id'];
		$DB1 = new mysqli("localhost", "root", "", $DB1_Name);
		$DB1->query("DELETE FROM `Friends` WHERE `Friends`.`id_Friend` = $user_id");
		$DB1->close();
		
		//Удаляем из чужой БД
		$DB2_Name = "User_".$user_id;
		$User_id = $_SESSION['User']['id'];
		$DB2 = new mysqli("localhost", "root", "", $DB2_Name);
		$DB2->query("DELETE FROM `Friends` WHERE `Friends`.`id_Friend` = $User_id");
		$DB2->close();
	}
?>