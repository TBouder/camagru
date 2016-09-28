<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   sc_remove_user.php                                 :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/28 11:54:14 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/28 13:12:28 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	include_once("../includes.php");
	include_all();

	if ($_SESSION["user_level"] != 2)
		header("Location: ".PROJECT);

	$login = strtolower($_POST['login']);
	$login = htmlspecialchars($login);

	$sql = "DELETE FROM db_tbouder.users WHERE login='".$login."';";
	ft_exec_sql(FALSE, $sql);

	$sql = "DELETE FROM db_tbouder.comments WHERE poster='".$login."';";
	ft_exec_sql(FALSE, $sql);
	$sql = "DELETE FROM db_tbouder.comments WHERE owner='".$login."';";
	ft_exec_sql(FALSE, $sql);

	$sql = "SELECT * FROM db_tbouder.pictures WHERE owner='".$login."';";
	$images = ft_exec_sql("fetchAll", $sql);
	foreach ($images as $image)
		unlink(IMG_DIR.$image['link']);

	$sql = "DELETE FROM db_tbouder.pictures WHERE owner='".$login."';";
	ft_exec_sql(FALSE, $sql);


?>
