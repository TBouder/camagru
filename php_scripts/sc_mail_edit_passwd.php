<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   sc_mail_edit_passwd.php                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/14 16:47:25 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/28 00:15:09 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	include_once("../includes.php");
	include_all();

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
		$sql = "SELECT login FROM db_tbouder.users WHERE login IN ('$user') AND email IN ('$email');";
		$count = ft_exec_sql("rowCount", $sql);

		if ($count === 1)
		{
			$hash_passwd = ft_encrypt_passwd($user, $passwd);
			$user_uniqueid = uniqid();
			$sql = "UPDATE db_tbouder.users SET passwd='".$hash_passwd."', unique_id='".$user_uniqueid."' WHERE login='".$user."';";
			ft_exec_sql(FALSE, $sql);

			$sujet = "Camagru - New password";
			$message .= "Your new password is : $passwd\r\n";
			$header = "From: \"Camagru\"<tbouder.camagru@student.42.fr>".$endl;
			mail($email, $sujet, $message, $header);
			header("Location: ".PROJECT);
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
