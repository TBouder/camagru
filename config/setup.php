<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   setup.php                                          :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/14 11:54:51 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/28 00:19:35 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	include_once("../includes.php");
	include_all();

	$root_passwd = ft_encrypt_passwd("root", "root");
	$user_passwd = ft_encrypt_passwd("user", "user");
	$guest_passwd = ft_encrypt_passwd("guest", "guest");

	$sql = "CREATE DATABASE db_tbouder;
		CREATE table IF NOT exists db_tbouder.users
		(
			id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
			login VARCHAR(32) NOT NULL,
			passwd VARCHAR(200) NOT NULL,
			email VARCHAR(200) NOT NULL,
			user_level INTEGER default 0,
			unique_id VARCHAR(20) default 0,
			activ INTEGER default 0
		);
		CREATE table IF NOT exists db_tbouder.pictures
		(
			id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
			link VARCHAR(15000) NOT NULL,
			name VARCHAR(200) NOT NULL,
			owner VARCHAR(32) NOT NULL,
			date DATETIME NOT NULL,
			nb_like INTEGER default 0
		);
		CREATE table IF NOT exists db_tbouder.comments
		(
			id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
			date DATETIME NOT NULL,
			owner VARCHAR(32) NOT NULL,
			poster VARCHAR(32) NOT NULL,
			image_name VARCHAR(200) NOT NULL,
			comment VARCHAR(140)
		);
		INSERT INTO db_tbouder.users (login, passwd, email, user_level, activ) value ('root', '$root_passwd', 'root@root.root', 2, 1);
		INSERT INTO db_tbouder.users (login, passwd, email, user_level, activ) value ('user', '$user_passwd', 'user@user.user', 1, 1);
		INSERT INTO db_tbouder.users (login, passwd, email, user_level, activ) value ('guest', '$guest_passwd', 'guest@guest.guest', 1, 0);";
	ft_exec_sql(FALSE, $sql);
	header("Location: ".PROJECT);
?>
