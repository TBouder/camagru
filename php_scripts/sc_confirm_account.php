<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   sc_confirm_account.php                             :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/21 00:28:19 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/22 10:25:49 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	include_once("../includes.php");
	include_all();

	include (CONFIG_DIR."database.php");

	if ($_GET['id'])
	{
		try
		{
			$id = $_GET['id'];
			$DB = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "SELECT login FROM db_tbouder.users WHERE unique_id IN ('".$id."');";
			$request = $DB->prepare($sql);
			$request->execute();
			$count = $request->rowCount();
			$users = $request->fetchAll();
			$request->closeCursor();
			$request = NULL;
			if ($count === 1)
			{
				$user = $users[0]['login'];
				$DB->exec("UPDATE db_tbouder.users SET activ=1 WHERE unique_id='".$id."';");
				$DB->exec("UPDATE db_tbouder.users SET user_level=1 WHERE unique_id='".$id."';");
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
			$DB = NULL;
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
			die();
		}
	}
?>
