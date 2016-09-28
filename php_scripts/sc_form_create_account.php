<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   sc_form_create_account.php                         :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/14 16:47:25 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/28 13:03:50 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	include_once("../includes.php");
	include_all();

	if ($_POST['submit'] == "Submit" && $_POST['user'] && $_POST['email'] && $_POST['passwd'])
	{
		$user = strtolower($_POST['user']);
		$user = htmlspecialchars($user);
		$passwd = $_POST['passwd'];
		$email = strtolower($_POST['email']);
		$email = htmlspecialchars($email);

		/***********************************************************************
		** USER CHECKS
		***********************************************************************/
		$user = str_replace("'", "\'", $user);
		$user = str_replace('"', '\"', $user);
		if (ft_check_login($user) == FALSE)
		{
			$_SESSION['error'] = "Login must be at least 5 characters long.";
			$_SESSION["error_redirect"] = $_SERVER['HTTP_REFERER'];
			header("Location: ".PROJECT."error.php");
			exit();
		}
		/***********************************************************************
		** PASSWD CHECKS
		***********************************************************************/
		$passwd = str_replace("'", "\'", $passwd);
		$passwd = str_replace('"', '\"', $passwd);
		if (ft_check_passwd($passwd) == FALSE)
		{
			$_SESSION['error'] = "Poorly formatted password. Please use at least one UPPERCASE, one lowercase, 1 number and five characters.";
			$_SESSION["error_redirect"] = $_SERVER['HTTP_REFERER'];
			header("Location: ".PROJECT."error.php");
			exit();
		}
		/***********************************************************************
		** EMAIL CHECKS
		***********************************************************************/
		$email = str_replace("'", "\'", $email);
		$email = str_replace('"', '\"', $email);
		if (ft_check_email($email) == FALSE)
		{
			$_SESSION['error'] = "Poorly formatted email";
			$_SESSION["error_redirect"] = $_SERVER['HTTP_REFERER'];
			header("Location: ".PROJECT."error.php");
			exit();
		}

		$sql = "SELECT login FROM db_tbouder.users WHERE login IN ('$user') OR email IN ('$email');";
		$count = ft_exec_sql("rowCount", $sql);
		if ($count === 0)
		{
			$hash_passwd = ft_encrypt_passwd($user, $passwd);
			$user_uniqueid = uniqid();
			$sql = "INSERT INTO db_tbouder.users (login, passwd, email, unique_id) value ('$user', '$hash_passwd', '$email', '$user_uniqueid');";
			ft_exec_sql(FALSE, $sql);
			$_SESSION["loggued_on_user"] = $user;
			$_SESSION["user_level"] = 0;
			$_SESSION["user_activ"] = 0;

			$sujet = "Welcome to Camagru";
			$message = "Welcome to the awesome world of Camagru !\r\n\r\n";
			$message .= "Please click here to confirm your account : \r\n";
			$message .= "http://localhost:8080/camagru/php_scripts/sc_mail_confirm_account.php?id=$user_uniqueid";
			$header = "From: \"Camagru\"<tbouder.camagru@student.42.fr>".$endl;
			mail($email, $sujet, $message, $header);
			header("Location: ".PROJECT);
		}
		else
		{
			$_SESSION['error'] = "Email or Username not available";
			$_SESSION["error_redirect"] = $_SERVER['HTTP_REFERER'];
			header("Location: ".PROJECT."error.php");
			exit();
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
