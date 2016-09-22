<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   index.php                                          :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/14 09:10:31 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/22 11:51:07 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	include_once("includes.php");
	include_all();

?>
<html>
	<?php ft_head()?>
	<body onload="ajax2()">
		<?php ft_navbar() ?>
		<?php $_SESSION["user_activ"] == 1 ? ft_index_webcam() : 0; ?>
		<?php ft_index_split() ?>
		<div id='pictures' class='picture_index'></div>
		<?php ft_footer() ?>
	</body>
	<?php if ($_SESSION["user_activ"] == 1) echo '<script src="./take_picture.js"></script>'; ?>
	<script src="./picture_list.js"></script>
</html>
