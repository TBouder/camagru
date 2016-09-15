<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   index.php                                          :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/14 09:10:31 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/15 20:11:50 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	include_once("../includes.php");
	include_all();

	function ft_button()
	{
		echo '
			<a href="'.PROJECT_CONFIG.'setup.php"><div class="adm_button">Create Database (AJOUTER SECURITE SI DEJA LA)</div></a>
			<a href="'.PROJECT_ADMIN.'sc_clear_db.php"><div class="adm_button">Reset Database (AJOUTER SECURITE SI PAS LA)</div></a>
		';
	}

?>

<html>
	<?php ft_head()?>
	<body>
		<?php ft_navbar() ?>
		<?php ft_button() ?>
		<?php ft_footer() ?>
	</body>
</html>
