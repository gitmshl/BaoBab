<?php
/// Врубаем сессию
	session_start();
/// Проверка на нажатие кнопки входа
if (isset($_REQUEST['Log-in_button'])) //Если кнопка входа нажата, то проверяем данные
{
	///Фильтрация ввода
	include_once "..\Filter_Functions\Filter_Functions.php";
	/*
		КОД ДЛЯ ФИЛЬТРАЦИИ ВВЕДЕННЫХ ДАННЫХ ПРИ ВХОДЕ В СИСТЕМУ !!!
	*/
	
	$_REQUEST['Password'] = MD5($_REQUEST['Password']);
	
	/// Проверка на существование данного аккаунта в базе данных
	include_once "..\SQL_Functions\Users_Main_Information\SQL_Check.php";
	
	if (!Exist_in_Users_Main_Information_DB($_REQUEST['Login'], $_REQUEST['Password']))
	{
		/// Если такого аккаунта нет, то ошибка
		$err_exist_account = true; /// включаем флаг ошибки
	}
	else
	{
	/// Если все в порядке, то заносим данные в сессию и переводим на "мою страницу"
		/// Считываем данные о пользователе из базы данных
		include_once "..\SQL_Functions\Users_Main_Information\SQL_Read.php";
		Read_in_Users_Main_Information($_REQUEST['Name'], $_REQUEST['LastName'],
		$_REQUEST['Login'], $_REQUEST['Password'], $_REQUEST['img']);
		
		$_REQUEST['img'] = str_replace("\"", "", $_REQUEST['img']);
		
		$_SESSION['User']['Name'] = $_REQUEST['Name'];
		$_SESSION['User']['LastName'] = $_REQUEST['LastName'];
		$_SESSION['User']['Login'] = $_REQUEST['Login'];
		$_SESSION['User']['Password'] = $_REQUEST['Password'];
		
		
		///Получаем id пользователя по логину
		include_once "..\SQL_Functions\Users_Main_Information\SQL_Get.php";
		$_SESSION['User']['id'] = Get_Id_User_by_Login($_SESSION['User']['Login']);
		
		$way = "..\Files\User_".$_SESSION['User']['id'];
		
		$_SESSION['User']['img'] = "..\\".$way."\\".$_REQUEST['img']; /// устанавливаем путь к аватарке
		$_SESSION['User']['base_img_name'] = $_REQUEST['img']; /// оставляет базовое имя аватарки(много где пригодится в будущем ;)
		
		header("Location: ..\Page\MyPage\MyPage.php");
		exit;
	}
	
}
?>
<!--То, что выше - это проверка нажатия виртуальных кнопок-->

<!--Ниже, вставка HTML - страницы-->

<?php
	include_once "log_in.html";
?>