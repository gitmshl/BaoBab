<?php
	/*
		Это промежуточный файл хэндлер, который позволяет производить обработку
		запросов, таких как добавление и удаление из друзей, или отмена заявки
		в друзья(от другого). Здесь производятся необходимые действия, после чего
		производится перенос на другую страницу, откуда был запрос
	*/
	session_start();
	include_once "..\..\SQL_Functions\User_login\SQL_Friends_Request.php";
	
	if ($_REQUEST['request'] == "send")
	{
		Send_Request_to_Friends($_REQUEST['id'], $_REQUEST['login'], $_REQUEST['name'], $_REQUEST['lastname'],
		$_REQUEST['img']);
		header("Location: $_REQUEST[way]");
	}
	else if ($_REQUEST['request'] == "add")
	{
		Add_in_Friend($_REQUEST['id'], $_REQUEST['login'], $_REQUEST['name'], $_REQUEST['lastname'],
		$_REQUEST['img']);
		header("Location: $_REQUEST[way]");
	}
	else if ($_REQUEST['request'] == "cancel")
	{
		Delete_Request_in_Friends($_SESSION['User']['id'], $_REQUEST['id']);
		header("Location: $_REQUEST[way]");
	}
	else if ($_REQUEST['request'] == "delete")
	{
		Delete_From_Friends($_REQUEST['id']);
		header("Location: $_REQUEST[way]");
	}
?>