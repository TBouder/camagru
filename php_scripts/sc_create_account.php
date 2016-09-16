<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   sc_create_account.php                              :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/14 16:47:25 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/16 10:25:32 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	include_once("../includes.php");
	include_all();

	include (CONFIG_DIR."database.php");
	include (SCRIPTS_DIR."sc_encrypt.php");

	if ($_POST['submit'] == "Submit" && $_POST['user'] && $_POST['email'] && $_POST['passwd'])
	{
		$user = $_POST['user'];
		$passwd = $_POST['passwd'];
		$email = $_POST['email'];

		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
		if (!filter_var($email, FILTER_VALIDATE_EMAIL) === TRUE)
		{
			$_SESSION['error'] = "Please enter an email";
			$_SESSION["error_redirect"] = $_SERVER['HTTP_REFERER'];
			header("Location: ".PROJECT."error.php");
			exit();
		}
		try
		{
			$DB = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$request = $DB->prepare("SELECT login FROM db_tbouder.users WHERE login IN ('$user') OR email IN ('$email');");
			$request->execute();
			$count = $request->rowCount();
			$request->closeCursor();
			$request = NULL;
			if ($count === 0)
			{
				$hash_passwd = ft_encrypt_passwd($user, $passwd);
				$DB->exec("INSERT INTO db_tbouder.users (login, passwd, email) value ('$user', '$hash_passwd', '$email');");
				$_SESSION["loggued_on_user"] = $user;
				$_SESSION["user_level"] = 0;
				$_SESSION["user_activ"] = 0;
				header("Location: ".PROJECT);
			}
			else
			{
				$_SESSION['error'] = "Email or Username not available";
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
