<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   sc_login.php                                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/14 16:47:25 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/27 19:37:16 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	include_once("../includes.php");
	include_all();

	include (CONFIG_DIR."database.php");
	include (SCRIPTS_DIR."sc_tools.php");

	if ($_POST['submit'] == "Submit" && $_POST['user'] && $_POST['passwd'])
	{
		$user = strtolower($_POST['user']);
		$passwd = $_POST['passwd'];
		try
		{
			$DB = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$hash_passwd = ft_encrypt_passwd($user, $passwd);
			$request = $DB->prepare("SELECT * FROM db_tbouder.users WHERE passwd IN ('$hash_passwd');");
			$request->execute();
			$users = $request->fetchAll()[0];
			$count = $request->rowCount();
			$request->closeCursor();
			$request = NULL;
			if ($count === 1)
			{
				$_SESSION["loggued_on_user"] = $users['login'];
				$_SESSION["user_level"] = $users['user_level'];
				$_SESSION["user_activ"] = $users['activ'];
				header("Location: ".PROJECT);
			}
			else
			{
				$_SESSION['error'] = "Wrong Password/Username";
				$_SESSION["error_redirect"] = $_SERVER['HTTP_REFERER'];
				header("Location: ".PROJECT."error.php");
				exit();
			}
			$DB = NULL;
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
			die();
		}
	}
	else
	{
		$_SESSION['error'] = "Missing datas";
		$_SESSION["error_redirect"] = $_SERVER['HTTP_REFERER'];
		header("Location: ".PROJECT."error.php");
		exit();
	}
?>
