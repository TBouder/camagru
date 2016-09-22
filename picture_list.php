<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   picture_list.php                                   :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/16 10:46:44 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/22 11:38:04 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	include_once("includes.php");
	include_all();
?>

<html>
	<?php ft_head() ?>
	<?php echo "<body onload='ajax_load(\"".$_GET['page']."\")'>";?>
		<?php ft_navbar() ?>
		<br><br><br><br>SORT BY ???? +++++ RESPONSIV ????
			<div id='pictures'></div>
		<?php ft_footer() ?>
	</body>
	<script src="picture_list.js"></script>
</html>
