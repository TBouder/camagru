<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   sc_like_plus_picture.php                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/19 11:12:16 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/28 00:10:27 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	include_once("../includes.php");
	include_all();

	if ($_SESSION["user_activ"] == 0)
		return;

	$name = $_POST['image_name'];
	$sql = "UPDATE db_tbouder.pictures SET nb_like=nb_like+1 WHERE name='$name';";
	ft_exec_sql(FALSE, $sql);
?>
