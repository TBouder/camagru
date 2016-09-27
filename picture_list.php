<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   picture_list.php                                   :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/16 10:46:44 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/27 18:47:23 by tbouder          ###   ########.fr       */
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
		<?php ft_picture_list_sort() ?>
		<div id='pictures'></div>
		<?php ft_footer() ?>
	</body>
	<script src="js/picture_list.js"></script>
</html>
