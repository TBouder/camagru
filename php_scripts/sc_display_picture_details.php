<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   sc_display_picture_details.php                     :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/21 18:25:12 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/26 17:28:59 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	include_once("../includes.php");
	include_all();

	include (CONFIG_DIR."/database.php");
	if ($_GET['name'])
	{
		try
		{
			$img_name = $_GET['name'];
			$DB = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "SELECT * FROM db_tbouder.pictures WHERE name IN ('".$img_name."');";
			$request = $DB->prepare($sql);
			$request->execute();
			$picture = $request->fetchAll()[0];
			$request = NULL;
			$DB = NULL;
			echo "<div class='picture_details_container'>";
				echo "<div class='picture_details_title'>";
					echo "<div>Picture by <span class='picture_details_username'>".$picture['owner']."</span></div>";
					echo "<div class='picture_details_date'>".$picture['date']."</div>";
				echo "</div>";
				echo "<div class='picture_details_info'>";
				if ($_SESSION["user_activ"] != 0)
				{
					echo "<img onclick='ft_dislike(\"".$img_name."\")' class='picture_details_like_button' src='data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUwIDUwIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MCA1MDsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTJweCIgaGVpZ2h0PSI1MTJweCI+CjxjaXJjbGUgc3R5bGU9ImZpbGw6I0Q3NUE0QTsiIGN4PSIyNSIgY3k9IjI1IiByPSIyNSIvPgo8cG9seWxpbmUgc3R5bGU9ImZpbGw6bm9uZTtzdHJva2U6I0ZGRkZGRjtzdHJva2Utd2lkdGg6MjtzdHJva2UtbGluZWNhcDpyb3VuZDtzdHJva2UtbWl0ZXJsaW1pdDoxMDsiIHBvaW50cz0iMTYsMzQgMjUsMjUgMzQsMTYgICAiLz4KPHBvbHlsaW5lIHN0eWxlPSJmaWxsOm5vbmU7c3Ryb2tlOiNGRkZGRkY7c3Ryb2tlLXdpZHRoOjI7c3Ryb2tlLWxpbmVjYXA6cm91bmQ7c3Ryb2tlLW1pdGVybGltaXQ6MTA7IiBwb2ludHM9IjE2LDE2IDI1LDI1IDM0LDM0ICAgIi8+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo='/>";
				}
					echo "<img src=".$picture['link']." class='picture_details_img'>";
				if ($_SESSION["user_activ"] != 0)
				{
					echo "<img onclick='ft_like(\"".$img_name."\")' class='picture_details_like_button' src='data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUwIDUwIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MCA1MDsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTJweCIgaGVpZ2h0PSI1MTJweCI+CjxjaXJjbGUgc3R5bGU9ImZpbGw6IzI1QUU4ODsiIGN4PSIyNSIgY3k9IjI1IiByPSIyNSIvPgo8cG9seWxpbmUgc3R5bGU9ImZpbGw6bm9uZTtzdHJva2U6I0ZGRkZGRjtzdHJva2Utd2lkdGg6MjtzdHJva2UtbGluZWNhcDpyb3VuZDtzdHJva2UtbGluZWpvaW46cm91bmQ7c3Ryb2tlLW1pdGVybGltaXQ6MTA7IiBwb2ludHM9IiAgMzgsMTUgMjIsMzMgMTIsMjUgIi8+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo='/>";
				}
				echo "</div>";

				echo "<div class='picture_details_title'>";
					if ($picture['nb_like'] == 0) echo "There is no like for it !";
					if ($picture['nb_like'] == 1) echo "There is ".$picture['nb_like']." <span class='picture_details_hightlight'>awesome</span> likes for it !";
					if ($picture['nb_like'] == -1) echo "There is ".-$picture['nb_like']." (<span class='picture_details_hightlight'>awesome</span> ?) dislikes for it !";
					if ($picture['nb_like'] > 1) echo "There is ".$picture['nb_like']." <span class='picture_details_hightlight'>awesome</span> likes for it !";
					if ($picture['nb_like'] < -1) echo "There is ".-$picture['nb_like']." (<span class='picture_details_hightlight'>awesome</span> ?) dislikes for it !";
				echo "</div>";
				if ($picture['owner'] == $_SESSION['loggued_on_user'])
					echo "<div class='picture_details_button' onclick='ft_ajax_delete_picture(\"".$img_name."\")'>Delete this picture</div>";
					echo "<form method='POST' action='".PROJECT_SCRIPTS."sc_add_comment.php'>";
						echo "<input type='hidden' name='image_name' value='".$img_name."'>";
						echo "<input type='hidden' name='owner' value='".$picture['owner']."'>";
						echo "<textarea rows='4' cols='40' maxlength='130' wrap='hard' name='comment'></textarea>";
						echo "<input type='submit' name='submit' value='Submit' class='login_button' />";
					echo "</form>";
			echo "</div>";

		}
		catch (Exception $e)
		{
			echo $e->getMessage();
			die();
		}
	}
?>
