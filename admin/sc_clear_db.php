<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   sc_clear_db.php                                    :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/15 18:41:39 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/15 19:55:29 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	include_once("../includes.php");
	include_all();

	include (CONFIG_DIR."database.php");
	try
	{
		$DB = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$request = $DB->prepare("DROP DATABASE db_tbouder");
		$request->execute();
		$directory = scandir(IMG_DIR);
		foreach ($directory as $image)
		{
			if ($image === "." || $image === "..")
				continue;
			unlink(IMG_DIR.$image);
		}
		$request->closeCursor();
		$request = NULL;
		$DB = NULL;
	}
	catch (Exception $e)
	{
		echo $e->getMessage();
		die();
	}
	header("Location: ".PROJECT_CONFIG."setup.php");

?>
