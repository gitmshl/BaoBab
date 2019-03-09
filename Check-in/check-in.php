<?php
	
	/// Врубаем сессию пользователя
	session_start();
if (isset($_REQUEST['Authorization_button']))
{
	///Создаем переменные ошибок
	$err_login_busy = false; /// занятие логином другим пользователем
	$err_login_correct = false; /// не корректный логин
	$err_name_correct = false; /// не корректный name
	$err_lastname_correct = false; /// не корректный lastname
	$err_password_correct = false; /// не корректный password
	$err_passwords_congruence = false; /// не совпадают пароль и подтверждение пароля

	///Фильтрация ввода
	include_once "..\Filter_Functions\Filter_Functions.php";
	/*
		КОД ДЛЯ ФИЛЬТРАЦИИ ВВЕДЕННЫХ ДАННЫХ ПРИ РЕГИСТРАЦИИ !!!
	*/
	Remove_Spaces($_REQUEST['login']); 
	
	///Проверка корректности ввода
	include_once "..\Correct_Input\Correct_Input_In_Check-in.php";
	Correct_In_Check_in($_REQUEST['Name'], $_REQUEST['LastName'], $_REQUEST['Login']
	, $_REQUEST['Password'], $_REQUEST['Repeat_Password'], $err_name_correct, 
$err_lastname_correct, $err_login_correct, $err_password_correct, $err_passwords_congruence);
	
///Производим шифрование пароля
	//$_REQUEST['Password'] = MD5($_REQUEST['Password']);
	
	///Проверка на существование в базе данных пользователя с данным логином
	include_once "..\SQL_Functions\Users_Main_Information\SQL_Check.php";
	
	if (Exist_in_Users_Main_Information_DB_only_login($_REQUEST['Login']))
	{
		/// Значит, что уже существует пользователь с таким логином, значит, выведем
		/// предупреждение, что такой логин уже занят
		$err_login_busy = true; /// ошибка занятия логина
	}

if (!$err_login_busy && !$err_login_correct && !$err_lastname_correct
&& !$err_name_correct && !$err_password_correct && !$err_passwords_congruence)
	{
		
		/// Успешно зарегистрировались. Переходим на другую страницу, при этом
		/// сохраняем данные в базу данных, создаем новые базы данных и таблицы
		// для данного пользователя и заносим некоторые данные в сессию
		
		// Заносим нового пользователя в базу данных Users_Main_Information
		include_once "..\SQL_Functions\Users_Main_Information\SQL_Insert.php";
		
		Insert_To_Users_Main_Information($_REQUEST['Name'], $_REQUEST['LastName'],
		$_REQUEST['Login'], $_REQUEST['Password'], "standart.jpg");
		
		//Создаем основную базу данных данного пользователя User_$id
		// ОЧЕНЬ ВАЖНО, ЧТОБЫ ЭТО ДЕЛАЛОСЬ ПОСЛЕ ВНЕСЕНИЯ ПОЛЬЗОВАТЕЛЯ В БД
		/// Users_Main_Information, В ПРОТИВНОМ СЛУЧАЕ НЕ КОРРЕКТНО БУДЕТ РАБОТАТЬ
		// СИСТЕМА !!!
		include_once "..\SQL_Functions\User_login\Create_DB_Page_Informations.php";
		Create_DB_Page_Informations($_REQUEST['Login']);
	
		
		
		$_SESSION['authorization'] = true; /// типа мы в онлайне ;)

///Заносим в сессию данные о пользователе, который авторизовался
		$_SESSION['User']['Name'] = $_REQUEST['Name'];
		$_SESSION['User']['LastName'] = $_REQUEST['LastName'];
		$_SESSION['User']['Login'] = $_REQUEST['Login'];
		$_SESSION['User']['Password'] = $_REQUEST['Password'];
		///Получаем id пользователя по логину
		include_once "..\SQL_Functions\Users_Main_Information\SQL_Get.php";
		$_SESSION['User']['id'] = Get_Id_User_by_Login($_SESSION['User']['Login']);
		
		/// Создаем папку пользователя, где будут лежать его файлы
		$way = "..\Files\User_".$_SESSION['User']['id'];
		mkdir($way);
		/// Переносим в файл Images пользователя стандратное изображение из Common_Images
		copy("..\Common_Images\Standart.jpg", $way."\standart.jpg");
		$_SESSION['User']['img'] = "..\\".$way."\standart.jpg"; /// устанавливаем путь к аватарке
		$_SESSION['User']['base_img_name'] = "standart.jpg";
		
		///Создаем папку в папке Dialogs_Files, где будут лежать файлы с диалогов
		///пользователя
		$way = "..\Dialogs_Files\User_".$_SESSION['User']['id'];
		mkdir($way);
	
	///Переходим на другую страницу
		header("Location: ..\Page\MyPage\MyPage.php");
		exit;
	}
}
?>
<!--То, что наверху, это обработка нажатия кнопок и авторизации-->

<!--То, что ниже, это HTML-вставка-->
<?php
	include_once "check_in.html";
?>