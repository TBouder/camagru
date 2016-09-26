<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   sc_add_comment.php                                 :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/26 15:53:39 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/26 17:20:06 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	include_once("../includes.php");
	include_all();

	include (CONFIG_DIR."database.php");

	if ($_POST['submit'] == "Submit" && $_POST['comment'])
	{
		$user = $_SESSION['loggued_on_user'];
		$image_name = $_POST['image_name'];
		$owner = $_POST['owner'];
		$comment = $_POST['comment'];
		$comment = str_replace("'", "\'", $comment);
		$comment = str_replace('"', '\"', $comment);
		try
		{
			$DB = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO db_tbouder.comments (owner, poster, image_name, comment) value ('$owner', '$user', '$image_name', '$comment');";
			$request = $DB->prepare($sql);
			$request->execute();
			$request->closeCursor();
			$request = NULL;

			$sql = "SELECT email FROM db_tbouder.users WHERE login='".$owner."';";
			$request = $DB->prepare($sql);
			$request->execute();
			$email = $request->fetchAll()[0]['email'];
			$request->closeCursor();
			$request = NULL;

				$sujet = "Camagru - New comment";
				$message .= "One of your awesome picture has a new comment !\r\n";
				$message .= "Follow the link to see it : http://localhost:8080/camagru/picture_details.php?name=".$image_name." \r\n";
				$header = "From: \"Camagru\"<tbouder.camagru@student.42.fr>".$endl;
				mail($email, $sujet, $message, $header);
				header("Location: http://localhost:8080/camagru/picture_details.php?name=".$image_name);
			$DB = NULL;
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
			die();
		}
	}

?>
