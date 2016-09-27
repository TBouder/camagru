<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   picture_list.php                                   :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/26 15:35:14 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/27 18:47:43 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	function ft_picture_list_sort()
	{
		$page = $_GET['page'];
		$sort = $_GET['sort'];
		echo "<div class='picture_list_order'>";
			echo "Order by :";
			echo "<select id='picture_list_select' onchange='ft_load_sort(\"".$page."\", \"".$sort."\")'>";
				echo $sort == 'date' ? "<option value='date' selected>Date</option>" : "<option value='date'>Date</option>";
				echo $sort == 'like' ? "<option value='like' selected>Likes</option>" : "<option value='like'>Likes</option>";
				echo $sort == 'dislike' ? "<option value='dislike' selected>Dislikes</option>" : "<option value='dislike'>Dislikes</option>";
				echo $sort == 'author' ? "<option value='author' selected>Author</option>" : "<option value='author'>Author</option>";
			echo "</select>";
		echo "</div>";
	}
?>
