<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   index.php                                          :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/14 09:10:31 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/27 18:50:11 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	include_once("includes.php");
	include_all();

?>
<html>
	<?php ft_head()?>
	<?php if ($_SESSION["user_activ"] == 1) echo '<body onload="ajax2()">'; else echo '<body>'; ?>
		<?php ft_navbar() ?>
		<?php $_SESSION["user_activ"] == 1 ? ft_index_webcam() : 0; ?>
		<?php ft_index_split() ?>
		<div id='pictures' class='picture_index'></div>
		<?php ft_footer() ?>
	</body>
	<?php if ($_SESSION["user_activ"] == 1) echo '<script src="js/take_picture.js"></script>'; ?>
	<script src="js/picture_list.js"></script>
</html>
