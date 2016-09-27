<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   footer.php                                         :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/14 09:10:31 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/27 19:05:25 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();

	function ft_footer()
	{
		echo "<div class='footer_container'>";
			echo "<div class='footer_content'>";
				echo "Copyright &#169 ".date('Y')." TBouder";
			echo "</div>";
		echo "</div>";
	}
?>
