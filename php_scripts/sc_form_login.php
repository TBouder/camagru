<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   sc_form_login.php                                  :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/14 16:47:25 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/28 00:07:57 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	include_once("../includes.php");
	include_all();

	if ($_POST['submit'] == "Submit" && $_POST['user'] && $_POST['passwd'])
	{
		$user = strtolower($_POST['user']);
		$passwd = $_POST['passwd'];

		$hash_passwd = ft_encrypt_passwd($user, $passwd);
		$sql = "SELECT * FROM db_tbouder.users WHERE passwd IN ('$hash_passwd');";
		$users = ft_exec_sql("fetchAll", $sql)[0];
		$count = ft_exec_sql("rowCount", $sql);

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
	}
	else
	{
		$_SESSION['error'] = "Missing datas";
		$_SESSION["error_redirect"] = $_SERVER['HTTP_REFERER'];
		header("Location: ".PROJECT."error.php");
		exit();
	}
?>
