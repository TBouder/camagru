<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   error.php                                          :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/22 10:21:58 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/27 19:04:50 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();

	function ft_error()
	{
		if ($_SESSION['error'] != FALSE)
		{
			echo "<div class='error_container'>";
				echo "<div class='content'>".$_SESSION['error']."</div>";
				echo "<div class='redirect'>";
					echo "<a href='".$_SESSION['error_redirect']."'>Click here to get redirected</a><br>or wait 5 secondes";
				echo "</div>";
			echo "</div>";
			$to_redirect = $_SESSION['error_redirect'];
			$_SESSION['error'] = FALSE;
			$_SESSION['error_redirect'] = '';
			echo "<meta http-equiv=\"refresh\" content=\"5;url=".$to_redirect."\"/>";
		}
		else
			echo "<meta http-equiv=\"refresh\" content=\"0;url=".PROJECT."\"/>";
	}
?>
