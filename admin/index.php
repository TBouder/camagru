<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   index.php                                          :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/14 09:10:31 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/28 12:18:28 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	include_once("../includes.php");
	include_all();

	if ($_SESSION["user_level"] != 2)
		header("Location: ".PROJECT);
?>

<html>
	<?php ft_head()?>
	<?php echo "<body onload='adm_ajax_load()'>" ?>
		<?php ft_navbar() ?>
		<div id="adm_core"></div>
		<?php ft_footer() ?>
	</body>
	<script src="adm_ajax.js"></script>
</html>
