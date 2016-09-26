<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   sc_delete_picture.php                              :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/26 12:17:13 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/26 12:30:26 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	include_once("../includes.php");
	include_all();

	include (CONFIG_DIR."database.php");

	if ($_POST['picture_name'])
	{
		try
		{
			$name = $_POST['picture_name'];
			$user = $_SESSION['loggued_on_user'];
			$DB = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "DELETE FROM db_tbouder.pictures WHERE name='".$name."' AND owner='".$user."'";
			$request = $DB->prepare($sql);
			$request->execute();
			$request->closeCursor();
			$request = NULL;
			$DB = NULL;
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
			die();
		}
	}
?>
