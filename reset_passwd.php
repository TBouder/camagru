<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   reset_passwd.php                                   :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/14 09:10:31 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/26 13:03:52 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	include_once("includes.php");
	include_all();
?>

<html>
	<?php ft_head()?>
	<body>
		<?php ft_navbar() ?>
		<?php ft_reset_form() ?>
		<?php ft_footer() ?>
	</body>
</html>
