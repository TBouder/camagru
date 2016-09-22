<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   sc_display_picture_index.php                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/19 11:12:16 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/22 11:50:05 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	include_once("../includes.php");
	include_all();

	include (CONFIG_DIR."/database.php");

	$DB = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$picture_db = $DB->prepare("SELECT * FROM db_tbouder.pictures ORDER BY nb_like DESC, date DESC;");
	$picture_db->execute();

	$all_pictures = $picture_db->fetchAll();
	echo '<div class="picture_container">';
	foreach ($all_pictures as $elem)
	{
		$name = $elem['name'];
		$nb_like = $elem['nb_like'];
		echo "<div class='picture_content'><div class='picture_content_2'>";
		echo "<img src=".$elem['link']." alt=".$name."/>";
		echo "<span class='text-content'>
				<span class='like' onclick='ft_like_index(\"".$name."\")'><img src='icons/like.svg' alt='like' class='overlay_icon'/></span>";

		echo "<span class='see'><a href='".PROJECT."picture_details.php?name=".$name."'>";
			if ($nb_like == 0)	echo "There is no like for this picture";
			if ($nb_like == 1)	echo "This picture has $nb_like like";
			if ($nb_like == -1)	echo "This picture has ".-$nb_like." dislike";
			if ($nb_like < -1)	echo "This picture has ".-$nb_like." dislikes";
			if ($nb_like > 1)	echo "This picture has $nb_like likes";
		echo "</a></span>";

			echo "<span class='dislike' onclick='ft_dislike_index(\"".$name."\")'><img src='icons/dislike.svg' alt='dislike' class='overlay_icon'/></span>
			</span>";
		echo "</div></div>";
	}
	echo '</div><div class="float_clr"></div>';
	$picture_db->closeCursor();
	$picture_db = NULL;
	$DB = NULL;

?>
