<?php
	/*
		Этот файл нужен для генерации случайных людей из списка друзей и групп, и
		, мб, чего то другого(по id пользователя)
	*/
	function Get_Rand_Friends_For_Show_by_id($user_id, &$count)
	{
		$User_DB_Name = "User_".$user_id;
		$Users_DB = new mysqli ("localhost", "root", "", $User_DB_Name);
		$result_DB = $Users_DB->query("SELECT * FROM `Friends`");
		$count = $result_DB->num_rows;
		$ind = 1;
		if ($count >= 6)
		{
			$ind1 = 6;
		}
		else
		{
			$ind1 = $count;
		}
	if ($count)
	{
		$result_DB = $Users_DB->query("SELECT * FROM `Friends` WHERE 
		`id` >= \"$ind\"	AND `id` <= \"$ind1\"");
		$count = $result_DB->num_rows;
		for ($i = 0; $i < $ind1; $i++)
		{
			$Inf = $result_DB->fetch_assoc();
			$Friends[$i]['Name'] = $Inf['Name'];
			$Friends[$i]['img'] = str_replace("\"", "", $Inf['img']);
			$Friends[$i]['img'] = "..\..\Files\User_".$Inf['id_Friend']."\\".$Friends['img'];
		}
	}
		$Users_DB->close();
		return $Friends;
	}
	
	function Get_Rand_Groups_For_Show_by_id($user_id, &$count)
	{
		$User_DB_Name = "User_".$user_id;
		$Users_DB = new mysqli ("localhost", "root", "", $User_DB_Name);
		$result_DB = $Users_DB->query("SELECT * FROM `Groups`");
		$count = $result_DB->num_rows;
		$ind = 1;
		if ($count >= 6)
		{
			$ind1 = 6;
		}
		else
		{
			$ind1 = $count;
		}
	if ($count)
	{
		$result_DB = $result_DB->query("SELECT * FROM `Groups` WHERE 
		`id` >= \"$ind\"	AND `id` <= \"$ind1\"");
		$count = $result_DB->num_rows;
		for ($i = 0; $i < $ind1; $i++)
		{
			$Inf = $result_DB->fetch_assoc();
			$Groups[$i]['Name'] = $Inf['Name'];
			$Groups[$i]['img'] = $Inf['img'];
		}
	}
		$Users_DB->close();
		return $Groups;
	}
?>