<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   sc_login.php                                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/14 16:47:25 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/14 19:49:04 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	include ("../config/database.php");
	include("sc_encrypt.php");

	if ($_POST['submit'] == "Submit" && $_POST['user'] && $_POST['passwd'])
	{
		$user = $_POST['user'];
		$passwd = $_POST['passwd'];
		try
		{
			$DB = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$hash_passwd = ft_encrypt_passwd($user, $passwd);
			$request = $DB->prepare("SELECT login FROM db_tbouder.users WHERE passwd IN ('$hash_passwd');");
			$request->execute();
			$count = $request->rowCount();
			$request->closeCursor();
			$request = NULL;
			if ($count === 0)
			{
				$_SESSION["loggued_on_user"] = $user;
				header("Location: ../index.php");
			}
			else
			{
				$_SESSION['error'] = "Wrong Password/Username";
				$_SESSION["error_redirect"] = $_SERVER['HTTP_REFERER'];
				header("Location: ../error.php");
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
		header("Location: ../error.php");
		exit();
	}
?>
