<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   index.php                                          :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/14 09:10:31 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/28 15:32:19 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	include_once("includes.php");
	include_all();

?>
<html>
	<?php ft_head()?>
		<body onload="ajax_load_index()">
		<?php ft_navbar() ?>
		<?php $_SESSION["user_activ"] == 1 ? ft_index_webcam() : 0; ?>
		<?php ft_index_split() ?>
		<div id='pictures' class='picture_index'></div>
		<?php ft_footer() ?>
	</body>
	<?php if ($_SESSION["user_activ"] == 1) echo '<script src="js/take_picture.js"></script>'; ?>
	<script src="js/picture_list.js"></script>
	<script>
		function ajax_load_index()
		{
			pictures = document.getElementById('pictures');
			var request = new XMLHttpRequest;
			request.open('POST', 'php_scripts/sc_display_picture_index.php', true);
			request.onload = function()
			{
				if (request.status >= 200 && request.status < 400)
				{
					var resp = request.responseText;
					pictures.innerHTML = resp;
				}
			};
			request.send();
		}
	</script>
</html>
