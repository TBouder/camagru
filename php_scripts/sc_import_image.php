<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   sc_import_image.php                                :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/15 00:02:22 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/15 00:42:16 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

session_start();
	include ("../config/database.php");
	include("sc_encrypt.php");

	if ($_POST['submit'] == "Go !" && !empty($_FILES))
	{
		$image = $_FILES['image']['tmp_name'];
		$type = pathinfo($image, PATHINFO_EXTENSION);
		$data = file_get_contents($image);

		$img_64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
		$img_name = hash('gost', $_FILES['image']['tmp_name'].$_FILES['image']['name']);
		$img_author = $_SESSION['loggued_on_user'];
		$img_date = date("Y-m-d H:i:s");
		// print_r($img_64);
		// echo "<img src='".$img_64."'/>";

		try
		{
			$DB = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			// $request = $DB->prepare("SELECT login FROM db_tbouder.users WHERE login IN ('$user') OR email IN ('$email');");
			// $request->execute();
			// $count = $request->rowCount();
			// $request->closeCursor();
			// $request = NULL;
			// if ($count === 0)
			// {
				$DB->exec("INSERT INTO db_tbouder.pictures (link, name, owner, date) value ('$img_64', '$img_name', '$img_author', '$img_date');");
				header("Location: ../index.php");
			// }
			$DB = NULL;
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
