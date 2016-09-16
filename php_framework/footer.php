<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   footer.php                                         :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/14 09:10:31 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/16 10:07:20 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	function ft_footer()
	{
		if ($_SESSION['user_level'] == 2)
		{
			echo '
			<div class="footer_container">
				<div class="footer_content">
				<p class="footer_admin"><a href="'.PROJECT_ADMIN.'">[Access to the Admin Panel]</a></p>
				Copyright &#169 '.date("Y").' TBouder
				</div>
			</div>';
		}
		else
		{
			echo '
			<div class="footer_container">
				<div class="footer_content">
					Copyright &#169 '.date("Y").' TBouder
				</div>
			</div>';
		}
	}
?>
