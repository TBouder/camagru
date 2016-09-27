<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   sc_mail_confirm_account.php                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/21 00:28:19 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/28 00:12:53 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	include_once("../includes.php");
	include_all();

	if ($_GET['id'])
	{
		$id = $_GET['id'];
		$sql = "SELECT login FROM db_tbouder.users WHERE unique_id IN ('".$id."');";
		$users = ft_exec_sql("fetchAll", $sql)[0];
		$count = ft_exec_sql("rowCount", $sql);
		if ($count === 1)
		{
			$user = $users['login'];
			$sql = "UPDATE db_tbouder.users SET activ=1 WHERE unique_id='".$id."';";
			ft_exec_sql(FALSE, $sql);
			$sql = "UPDATE db_tbouder.users SET user_level=1 WHERE unique_id='".$id."';";
			ft_exec_sql(FALSE, $sql);

			$_SESSION["loggued_on_user"] = $user;
			$_SESSION["user_level"] = 1;
			$_SESSION["user_activ"] = 1;
			header("Location: ".PROJECT);
		}
		else
		{
			$_SESSION['error'] = "Bad request";
			$_SESSION["error_redirect"] = PROJECT;
			header("Location: ".PROJECT."error.php");
			exit();
		}
	}
?>
