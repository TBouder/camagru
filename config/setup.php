<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   setup.php                                          :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/14 11:54:51 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/16 10:23:41 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	include_once("../includes.php");
	include_all();

	include (CONFIG_DIR."database.php");
	include (SCRIPTS_DIR."sc_encrypt.php");
	try
	{
		$DB = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$root_passwd = ft_encrypt_passwd("root", "root");
		$user_passwd = ft_encrypt_passwd("user", "user");
		$guest_passwd = ft_encrypt_passwd("guest", "guest");
		$request = $DB->prepare("
			CREATE DATABASE db_tbouder;
			CREATE table IF NOT exists db_tbouder.users
			(
				id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
				login VARCHAR(32) NOT NULL,
				passwd VARCHAR(200) NOT NULL,
				email VARCHAR(200) NOT NULL,
				user_level INTEGER default 0,
				activ INTEGER default 0
			);
			CREATE table IF NOT exists db_tbouder.pictures
			(
				id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
				link VARCHAR(15000) NOT NULL,
				name VARCHAR(200) NOT NULL,
				owner VARCHAR(32) NOT NULL,
				date DATE NOT NULL,
				nb_like INTEGER default 0
			);
			CREATE table IF NOT exists db_tbouder.comments
			(
				id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
				owner VARCHAR(32) NOT NULL,
				poster VARCHAR(32) NOT NULL,
				image_name VARCHAR(200) NOT NULL,
				comment VARCHAR(140)
			);
			INSERT INTO db_tbouder.users (login, passwd, email, user_level, activ) value ('root', '$root_passwd', 'root@root.root', 2, 1);
			INSERT INTO db_tbouder.users (login, passwd, email, user_level, activ) value ('user', '$user_passwd', 'user@user.user', 1, 1);
			INSERT INTO db_tbouder.users (login, passwd, email, user_level, activ) value ('guest', '$guest_passwd', 'guest@guest.guest', 1, 0);"
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
	header("Location: ".PROJECT);
?>
