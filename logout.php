<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   logout.php                                         :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/04 14:00:02 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/16 10:39:38 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	include_once("includes.php");
	include_all();
	
	$_SESSION['loggued_on_user'] = "";
	$_SESSION["user_level"] = 0;
	$_SESSION["user_activ"] = 0;
	header("Location: ".PROJECT);
?>
