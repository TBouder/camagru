<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   sc_display_picture.php                             :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/19 11:12:16 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/19 11:13:32 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	include_once("../includes.php");
	include_all();

	// function ft_display_picture()
	// {
		include (CONFIG_DIR."/database.php");

		$DB = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$picture_db = $DB->prepare("SELECT * FROM db_tbouder.pictures;");
		$picture_db->execute();

		$all_pictures = $picture_db->fetchAll();
		echo '<div class="picture_container">';
		foreach ($all_pictures as $elem)
		{
			echo "<div class='picture_content'><div class='picture_content_2'>";
				echo "<img src=".$elem['link']." alt=".$elem['name']." />";
			echo "</div></div>";
		}
		echo '</div><div class="float_clr"></div>';
		$picture_db->closeCursor();
		$picture_db = NULL;
		$DB = NULL;
	// }

?>
