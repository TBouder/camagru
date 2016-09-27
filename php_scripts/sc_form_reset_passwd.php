<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   sc_form_reset_passwd.php                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/14 16:47:25 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/27 19:57:25 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	include_once("../includes.php");
	include_all();

	include (CONFIG_DIR."database.php");
	include (SCRIPTS_DIR."sc_tools.php");

	if ($_POST['submit'] == "Submit" && $_POST['user'] && $_POST['email'])
	{
		$user = $_POST['user'];
		$email = $_POST['email'];

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
		try
		{
			$DB = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "SELECT unique_id FROM db_tbouder.users WHERE login IN ('$user') AND email IN ('$email');";
			$request = $DB->prepare($sql);
			$request->execute();
			$users = $request->fetchAll()[0];
			$count = $request->rowCount();
			$request->closeCursor();
			$request = NULL;
			if ($count === 1)
			{
				$user_uniqueid = $users['unique_id'];
				$sujet = "Camagru - Reset password";
				$message .= "Please click here to reset your password : \r\n";
				$message .= "http://localhost:8080/camagru/new_passwd.php?id=$user_uniqueid";
				$header = "From: \"Camagru\"<tbouder.camagru@student.42.fr>".$endl;
				mail($email, $sujet, $message, $header);
				header("Location: ".PROJECT);
			}
			else
			{
				$_SESSION['error'] = "Wrong Email or Username";
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
