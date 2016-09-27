<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   picture_list.php                                   :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/16 10:46:44 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/27 16:42:59 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	include_once("includes.php");
	include_all();
?>

<html>
	<?php ft_head() ?>
	<?php echo "<body onload='ajax_load(\"".$_GET['page']."\", \"".$_GET['sort']."\")'>";?>
		<?php ft_navbar() ?>
		<div class="picture_list_order">
			Order by :
			<?php echo "<select id='picture_list_select' onchange='ft_load_sort(\"".$_GET['page']."\", \"".$_GET['sort']."\")'>" ?>
				<option value="date">Date</option>
				<option value="like">Likes</option>
				<option value="dislike" >Dislikes</option>
				<option value="author">Author</option>
			</select>
		</div>

			<div id='pictures'></div>
		<?php ft_footer() ?>
	</body>
	<script>

	function ft_load_sort(page, sort)
	{
		var select = document.getElementById("picture_list_select").selectedIndex;

		if (select === 0)	ajax_load(page, "date");
		if (select === 1)	ajax_load(page, "like");
		if (select === 2)	ajax_load(page, "dislike");
		if (select === 3)	ajax_load(page, "author");
	}

	</script>
	<script src="picture_list.js"></script>
</html>
