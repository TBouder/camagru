<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   head.php                                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/14 09:10:31 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/15 13:25:32 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	function ft_head($camera = FALSE)
	{
		echo '
		<head>
			<title>Camagru</title>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
			<meta name="viewport" content="width=device-width" />
			<link rel="stylesheet" type="text/css" href="./css/main.css" />
			<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
			<link href="https://fonts.googleapis.com/css?family=Signika" rel="stylesheet">';
		// if ($camera == TRUE)
			// echo '<script src="./take_picture.js"></script>';
		echo '
		</head>';
	}
?>
