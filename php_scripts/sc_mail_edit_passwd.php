<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   sc_mail_edit_passwd.php                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/14 16:47:25 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/27 19:57:37 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	include_once("../includes.php");
	include_all();

	include (CONFIG_DIR."database.php");
	include (SCRIPTS_DIR."sc_tools.php");

	if ($_POST['submit'] == "Submit" && $_POST['user'] && $_POST['email'] && $_POST['passwd'])
	{
		$user = $_POST['user'];
		$passwd = $_POST['passwd'];
		$email = $_POST['email'];

		/***********************************************************************
		** USER CHECKS
		***********************************************************************/
		$user = str_replace("'", "\'", $user);
		$user = str_replace('"', '\"', $user);
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
		try
		{
			$DB = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "SELECT login FROM db_tbouder.users WHERE login IN ('$user') AND email IN ('$email');";
			$request = $DB->prepare($sql);
			$request->execute();
			$count = $request->rowCount();
			$request->closeCursor();
			$request = NULL;
			if ($count === 1)
			{
				$hash_passwd = ft_encrypt_passwd($user, $passwd);
				$user_uniqueid = uniqid();
				$sql = "UPDATE db_tbouder.users SET passwd='".$hash_passwd."', unique_id='".$user_uniqueid."' WHERE login='".$user."';";
				$request = $DB->prepare($sql);
				$request->execute();
				$request->closeCursor();
				$request = NULL;

				$sujet = "Camagru - New password";
				$message .= "Your new password is : $passwd\r\n";
				$header = "From: \"Camagru\"<tbouder.camagru@student.42.fr>".$endl;
				mail($email, $sujet, $message, $header);
				header("Location: ".PROJECT);
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
