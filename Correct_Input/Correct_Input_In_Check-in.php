<?php
	/*
		Этот файл содержит функцию\и, которая\ые проверяют корректность ввода
		при регистрации. Мы это выделяем в отдельный файл(проверка корректности),
		чтобы впоследствии было без проблем изменить правила корректности, если
		мы захотим сделать это
	*/
	
	function Correct_Name($Name, &$err_name_correct)
	{
		if ($Name == "") $err_name_correct = true;
	}
	
	function Correct_LastName($LastName, &$err_lastname_correct)
	{
		if ($LastName == "") $err_lastname_correct = true;
	}
	
	function Correct_Login($Login, &$err_login_correct)
	{
		if ($Login == "") $err_login_correct = true;
	}
	
	function Correct_Password($Password, &$err_password_correct)
	{
		if ($Password == "") $err_password_correct = true;
	}
	
	function Correct_Repeat_Password($Password, $Repeat_Password, &$err_passwords_congruence)
	{
		if ($Password !== $Repeat_Password) $err_passwords_congruence = true;
	}
	
function Correct_In_Check_in($Name, $LastName, $Login, $Password, $Repeat_Password,
&$err_name_correct, &$err_lastname_correct, &$err_login_correct, &$err_password_correct,
&$err_passwords_congruence)
{
	Correct_Name($Name, $err_name_correct);
	Correct_LastName($LastName, $err_lastname_correct);
	Correct_Login($Login, $err_login_correct);
	Correct_Password($Password, $err_password_correct);
	Correct_Repeat_Password($Password, $Repeat_Password, $err_passwords_congruence);
}

?>