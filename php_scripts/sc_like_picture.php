<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   sc_like_picture.php                                :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/19 11:12:16 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/26 12:49:20 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	include_once("../includes.php");
	include_all();

	include (CONFIG_DIR."/database.php");
	if ($_SESSION["user_activ"] == 0)	return;

	$DB = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$name = $_POST['image_name'];
	$sql = "UPDATE db_tbouder.pictures SET nb_like=nb_like+1 WHERE name='$name';";
	$request = $DB->prepare($sql);
	$request->execute();
	$request->closeCursor();
	$request = NULL;
	$DB = NULL;
?>
