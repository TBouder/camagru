<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   head.php                                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/14 09:10:31 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/27 19:00:53 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();

	function ft_head()
	{
		echo "<head>";
			echo "<title>Camagru</title>";
			echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />";
			echo "<meta name='viewport' content='width=device-width' />";
			echo "<link rel='icon' type='image/png' href='".PROJECT."favicon.png' />";
			echo "<link rel='stylesheet' type='text/css' href='".PROJECT_CSS."main.css' />";
			echo "<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet'>";
			echo "<link href='https://fonts.googleapis.com/css?family=Signika' rel='stylesheet'>";
		echo "</head>";
	}
?>
