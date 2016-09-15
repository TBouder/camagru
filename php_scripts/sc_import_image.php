<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   sc_import_image.php                                :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/15 00:02:22 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/15 13:14:32 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

session_start();
	include ("../config/database.php");
	include("sc_encrypt.php");

	if ($_POST['submit'] == "Go !" && file_exists($_FILES['image']['tmp_name']) && is_uploaded_file($_FILES['image']['tmp_name']))
	{
		$image = $_FILES['image']['tmp_name'];
		$type = pathinfo($image, PATHINFO_EXTENSION);
		$data = file_get_contents($image);
		$img_name = hash('gost', $_FILES['image']['tmp_name'].$_FILES['image']['name']);
		$img_author = $_SESSION['loggued_on_user'];
		$img_date = date("Y-m-d H:i:s");
		$img_64 = base64_encode($data);
		$img_link = "img/". uniqid().".png";
		file_put_contents("../".$img_link, base64_decode($img_64));

		try
		{
			$DB = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$DB->exec("INSERT INTO db_tbouder.pictures (link, name, owner, date) value ('$img_link', '$img_name', '$img_author', '$img_date');");
			$DB = NULL;
			header("Location: ../index.php");
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
			die();
		}
	}
	else
	{
		$_SESSION['error'] = "Missing image";
		$_SESSION["error_redirect"] = $_SERVER['HTTP_REFERER'];
		header("Location: ../error.php");
		exit();
	}
?>
