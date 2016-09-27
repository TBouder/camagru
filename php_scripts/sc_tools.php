<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   sc_tools.php                                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/17 16:20:13 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/27 23:57:38 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();

	function ft_exec_sql($f, $sql)
	{
		include (CONFIG_DIR."database.php");

		try
		{
			$DB = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$request = $DB->prepare($sql);
			$request->execute();
			$requested = $f == FALSE ? FALSE : $request->$f();
			$request->closeCursor();
			$request = NULL;
			return ($requested);
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
			die();
		}
	}

	function ft_check_login($login)
	{
		$i = 0;
		while ($login[$i])
		{
			$ascii_value = ord($login[$i]);
			if ($ascii_value <= 32 || $ascii_value > 126)
				return (FALSE);
			else if ($login[$i] == '\\')
				return (FALSE);
			$i++;
		}
		if ($i >= 3)
			return (TRUE);
		return (FALSE);
	}

	function ft_check_passwd($passwd)
	{
		$i = 0;
		while ($passwd[$i])
		{
			$ascii_value = ord($passwd[$i]);
			if ($ascii_value <= 32 || $ascii_value > 126)
				return (FALSE);
			if (ord($passwd[$i]) >= 97 && ord($passwd[$i]) <= 122)
				$min = 1;
			else if (ord($passwd[$i]) >= 65 && ord($passwd[$i]) <= 90)
				$maj = 1;
			else if (ord($passwd[$i]) >= 48 && ord($passwd[$i]) <= 57)
				$number = 1;
			else if ($passwd[$i] == '\\')
				return (FALSE);
			$i++;
		}
		if ($min == 1 && $maj == 1 && $number == 1 && $i >= 5)
			return (TRUE);
		return (FALSE);
	}

	function ft_check_email($email)
	{
		$i = 0;
		while ($email[$i])
		{
			$ascii_value = ord($email[$i]);
			if ($ascii_value <= 32 || $ascii_value > 126)
				return (FALSE);
			else if ($email[$i] == '\\' || $email[$i] == '\'' || $email[$i] == '"')
				return (FALSE);
			$i++;
		}
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
		if (!filter_var($email, FILTER_VALIDATE_EMAIL) === TRUE)
			return (FALSE);
		return (TRUE);
	}

	function ft_encrypt_passwd($login, $passwd)
	{
		$log_infos = "_4@2koa!".$login.$passwd."+la";
		$iterations = 1000;
		$password = hash_pbkdf2("gost", $log_infos, 10, $iterations);
		$password .= hash("whirlpool", $password);
		return ($password);
	}
?>
