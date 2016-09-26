<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   picture_details.php                                :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/21 19:50:11 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/26 15:34:44 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	include_once("includes.php");
	include_all();
?>

<html>
	<?php ft_head() ?>
	<?php echo "<body onload='ajax_load(\"".$_GET['name']."\")'>";?>
		<?php ft_navbar() ?>
		<div id='pictures'></div>
		<?php ft_comment() ?>
		<?php ft_footer() ?>
	</body>
	<script src="picture_details.js"></script>
</html>
