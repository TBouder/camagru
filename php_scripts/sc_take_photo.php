<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   sc_take_photo.php                                  :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/15 14:36:49 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/20 20:37:54 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	include_once("../includes.php");
	include_all();
	if ($_SESSION["activ"] === 0)
		header("Location: ".PROJECT);

		header( "Content-type: image/png" );
	include (CONFIG_DIR."database.php");

	if ($_POST['data1'] && $_POST['data2'])
	{
		$camera_content = str_replace(' ', '+', $_POST['data1']);
		$png_content = str_replace(' ', '+', $_POST['data2']);

		$img_name = uniqid();
		$img_author = $_SESSION['loggued_on_user'];
		$img_date = date("Y-m-d H:i:s");
		$img_link = "img/".$img_name.".png";

		$image1 = imagecreatefromstring(base64_decode($camera_content));
		$image2 = imagecreatefromstring(base64_decode($png_content));

		imagecopy($image1, $image2, 0, 0, 0, 0, getimagesizefromstring(base64_decode($png_content))[0], getimagesizefromstring(base64_decode($png_content))[1]);
		imagepng($image1, "../".$img_link);
		imagedestroy($image1);
		imagedestroy($image2);
		try
		{
			$DB = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$DB->exec("INSERT INTO db_tbouder.pictures (link, name, owner, date) value ('$img_link', '$img_name', '$img_author', '$img_date');");
			$DB = NULL;
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
			die();
		}
	}
?>
