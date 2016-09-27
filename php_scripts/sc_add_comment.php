<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   sc_add_comment.php                                 :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/26 15:53:39 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/28 00:06:00 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	include_once("../includes.php");
	include_all();

	if ($_POST['submit'] == "Submit" && $_POST['comment'])
	{
		$user = $_SESSION['loggued_on_user'];
		$image_name = $_POST['image_name'];
		$owner = $_POST['owner'];
		$date = date("Y-m-d H:i:s");
		$comment = $_POST['comment'];
		$comment = str_replace("'", "\'", $comment);
		$comment = str_replace('"', '\"', $comment);

		$sql = "INSERT INTO db_tbouder.comments (date, owner, poster, image_name, comment) value ('$date', '$owner', '$user', '$image_name', '$comment');";
		ft_exec_sql(FALSE, $sql);
		$sql = "SELECT email FROM db_tbouder.users WHERE login='".$owner."';";
		$email = ft_exec_sql("fetchAll", $sql)[0]['email'];

		$sujet = "Camagru - New comment";
		$message .= "One of your awesome picture has a new comment !\r\n";
		$message .= "Follow the link to see it : http://localhost:8080/camagru/picture_details.php?name=".$image_name." \r\n";
		$header = "From: \"Camagru\"<tbouder.camagru@student.42.fr>".$endl;
		mail($email, $sujet, $message, $header);
		header("Location: ".PROJECT."picture_details.php?name=".$image_name);
	}

?>
