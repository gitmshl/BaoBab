<?php
	/*
		Этот файл предназначен для фильтрации входных данных, чтобы предотвратить
		хакерские взломы и баги сети
	*/
	
	// Удаляет пробелы в строке
	function Remove_Spaces(&$str)
	{
		$str = trim($str);
		$str = str_replace(" ", "", $str);
	}
	
	//Удаляет символ перехода на новую строку в строке str
	function Remove_New_Line_Char(&$str)
	{
		$str = str_replace('\n', '', $str);
	}
?>