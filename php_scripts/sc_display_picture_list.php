<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   sc_display_picture_list.php                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/21 18:25:12 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/27 15:37:11 by tbouder          ###   ########.fr       */
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

	$sort = $_GET['sort'];
	$current_page = $_GET['page'];
	$page = isset($_GET['page']) ? $_GET['page'] : 0;
	$offset = isset($_GET['page']) ? $elem_per_page * $page : 0;

	$left_rec = $nb_picture - ($page * $elem_per_page);

	if ($sort == "date")
		$picture_db = $DB->prepare("SELECT * FROM db_tbouder.pictures ORDER BY date DESC, nb_like DESC LIMIT ".$elem_per_page." OFFSET ".$offset.";");
	else if ($sort == "like")
		$picture_db = $DB->prepare("SELECT * FROM db_tbouder.pictures ORDER BY nb_like DESC, date DESC LIMIT ".$elem_per_page." OFFSET ".$offset.";");
	else if ($sort == "dislike")
		$picture_db = $DB->prepare("SELECT * FROM db_tbouder.pictures ORDER BY nb_like ASC, date DESC LIMIT ".$elem_per_page." OFFSET ".$offset.";");
	else if ($sort == "author")
		$picture_db = $DB->prepare("SELECT * FROM db_tbouder.pictures ORDER BY owner DESC, date DESC LIMIT ".$elem_per_page." OFFSET ".$offset.";");

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
				if ($_SESSION["user_activ"] != 0)
				{
					echo "<span class='picture_list_text_content'>";

						echo "<span class='like' onclick='ft_dislike(\"".$name."\", \"".$current_page."\", \"".$sort."\")'>";
							echo "<img alt='dislike' class='picture_list_overlay_icon' src='data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUwIDUwIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MCA1MDsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTJweCIgaGVpZ2h0PSI1MTJweCI+CjxjaXJjbGUgc3R5bGU9ImZpbGw6I0Q3NUE0QTsiIGN4PSIyNSIgY3k9IjI1IiByPSIyNSIvPgo8cG9seWxpbmUgc3R5bGU9ImZpbGw6bm9uZTtzdHJva2U6I0ZGRkZGRjtzdHJva2Utd2lkdGg6MjtzdHJva2UtbGluZWNhcDpyb3VuZDtzdHJva2UtbWl0ZXJsaW1pdDoxMDsiIHBvaW50cz0iMTYsMzQgMjUsMjUgMzQsMTYgICAiLz4KPHBvbHlsaW5lIHN0eWxlPSJmaWxsOm5vbmU7c3Ryb2tlOiNGRkZGRkY7c3Ryb2tlLXdpZHRoOjI7c3Ryb2tlLWxpbmVjYXA6cm91bmQ7c3Ryb2tlLW1pdGVybGltaXQ6MTA7IiBwb2ludHM9IjE2LDE2IDI1LDI1IDM0LDM0ICAgIi8+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo='/>";
						echo "</span>";

						echo "<a href='".PROJECT."picture_details.php?name=".$name."' class='see_link'>";
							echo "<div class='see'>";
								if ($nb_like <= -1)	echo $nb_like;
								if ($nb_like >= 0)	echo $nb_like;
							echo "</div>";
						echo "</a>";

						echo "<span class='dislike' onclick='ft_like(\"".$name."\", \"".$current_page."\", \"".$sort."\")'>";
							echo "<img alt='like' class='picture_list_overlay_icon' src='data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUwIDUwIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MCA1MDsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTJweCIgaGVpZ2h0PSI1MTJweCI+CjxjaXJjbGUgc3R5bGU9ImZpbGw6IzI1QUU4ODsiIGN4PSIyNSIgY3k9IjI1IiByPSIyNSIvPgo8cG9seWxpbmUgc3R5bGU9ImZpbGw6bm9uZTtzdHJva2U6I0ZGRkZGRjtzdHJva2Utd2lkdGg6MjtzdHJva2UtbGluZWNhcDpyb3VuZDtzdHJva2UtbGluZWpvaW46cm91bmQ7c3Ryb2tlLW1pdGVybGltaXQ6MTA7IiBwb2ludHM9IiAgMzgsMTUgMjIsMzMgMTIsMjUgIi8+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo='/>";
						echo "</span>";

					echo "</span>";
				}
			echo "</div>";
		echo "</div>";
	}
	echo '</div><div class="picture_list_float_clr"></div>';

	if ($page == 0 && $left_rec > $elem_per_page)
		echo '<a href='.$_PHP_SELF.'?page='.($page + 1).'&sort='.($sort).' class="gallery_next">Next</a>';
	else if ($page != 0 && $left_rec <= $elem_per_page)
		echo '<a href='.$_PHP_SELF.'?page='.($page - 1).'&sort='.($sort).' class="gallery_previous">Prev</a>';
	else if ($page > 0)
	{
		echo '<a href='.$_PHP_SELF.'?page='.($page - 1).'&sort='.($sort).' class="gallery_previous">Prev</a>';
		echo '<a href='.$_PHP_SELF.'?page='.($page + 1).'&sort='.($sort).' class="gallery_next">Next</a>';
	}
	$DB = NULL;
?>
