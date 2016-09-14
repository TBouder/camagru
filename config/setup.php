<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   setup.php                                          :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/14 11:54:51 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/15 00:40:48 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

session_start();

	include ("database.php");

	try
	{
		$DB = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$request = $DB->prepare("
			CREATE DATABASE db_tbouder;
			CREATE table IF NOT exists db_tbouder.users
			(
				id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
				login VARCHAR(32) NOT NULL,
				passwd VARCHAR(200) NOT NULL,
				email VARCHAR(200) NOT NULL
			);
			CREATE table IF NOT exists db_tbouder.pictures
			(
				id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
				link VARCHAR(2000) NOT NULL,
				name VARCHAR(200) NOT NULL,
				owner VARCHAR(32) NOT NULL,
				date DATE NOT NULL,
				nb_like INTEGER default 0
			);
			CREATE table IF NOT exists db_tbouder.comments
			(
				id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
				image_name VARCHAR(200) NOT NULL,
				comment VARCHAR(140)
			);"
		);
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
	header("Location: ../index.php");
?>
