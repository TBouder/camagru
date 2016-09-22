<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   sc_display_picture_list.php                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/21 18:25:12 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/22 12:18:12 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	include_once("../includes.php");
	include_all();

	include (CONFIG_DIR."/database.php");

	$elem_per_page = 8;

	$DB = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$count = $DB->prepare("SELECT id FROM db_tbouder.pictures;");
	$count->execute();
	$nb_picture = $count->rowCount();
	$count->closeCursor();
	$count = NULL;

	$current_page = $_GET['page'];
	$page = isset($_GET['page']) ? $_GET['page'] : 0;
	$offset = isset($_GET['page']) ? $elem_per_page * $page : 0;

	$left_rec = $nb_picture - ($page * $elem_per_page);

	$picture_db = $DB->prepare("SELECT * FROM db_tbouder.pictures ORDER BY nb_like DESC, date DESC LIMIT ".$elem_per_page." OFFSET ".$offset.";");
	$picture_db->execute();
	$all_pictures = $picture_db->fetchAll();
	$picture_db->closeCursor();
	$picture_db = NULL;

	echo '<div class="picture_list_container">';
	foreach ($all_pictures as $elem)
	{
		$name = $elem['name'];
		$nb_like = $elem['nb_like'];
		echo "<div class='picture_list_content'>";
			echo "<div class='picture_list_content_2'>";
				echo "<img src=".$elem['link']." alt=".$name."/>";
				echo "<span class='picture_list_text_content'>";

					echo "<span class='like' onclick='ft_like(\"".$name."\", \"".$current_page."\")'>";
						echo "<img src='icons/like.svg' alt='like' class='picture_list_overlay_icon'/>";
					echo "</span>";

					echo "<span class='see'>";
						echo "<a href='".PROJECT."picture_details.php?name=".$name."'>";
							if ($nb_like == 0)	echo "There is no like for this picture";
							if ($nb_like == 1)	echo "This picture has $nb_like like";
							if ($nb_like == -1)	echo "This picture has ".-$nb_like." dislike";
							if ($nb_like < -1)	echo "This picture has ".-$nb_like." dislikes";
							if ($nb_like > 1)	echo "This picture has $nb_like likes";
						echo "</a>";
					echo "</span>";

					echo "<span class='dislike' onclick='ft_dislike(\"".$name."\", \"".$current_page."\")'>";
						echo "<img src='icons/dislike.svg' alt='dislike' class='picture_list_overlay_icon'/>";
					echo "</span>";

				echo "</span>";
			echo "</div>";
		echo "</div>";
	}
	echo '</div><div class="picture_list_float_clr"></div>';

	if ($page == 0 && $left_rec > $elem_per_page)
		echo '<a href='.$_PHP_SELF.'?page='.($page + 1).' class="gallery_next">Next</a>';
	else if ($page != 0 && $left_rec <= $elem_per_page)
		echo '<a href='.$_PHP_SELF.'?page='.($page - 1).' class="gallery_previous">Prev</a>';
	else if ($page > 0)
	{
		echo '<a href='.$_PHP_SELF.'?page='.($page - 1).' class="gallery_previous">Prev</a>';
		echo '<a href='.$_PHP_SELF.'?page='.($page + 1).' class="gallery_next">Next</a>';
	}
	$DB = NULL;
?>
