<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   sc_clear_db.php                                    :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/15 18:41:39 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/28 00:17:38 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	include_once("../includes.php");
	include_all();

	if ($_SESSION["user_level"] != 2)
		header("Location: ".PROJECT);

	$sql = "DROP DATABASE db_tbouder";
	ft_exec_sql(FALSE, $sql);
	$directory = scandir(IMG_DIR);
	foreach ($directory as $image)
	{
		if ($image === "." || $image === "..")
			continue;
		unlink(IMG_DIR.$image);
	}
	header("Location: ".PROJECT_CONFIG."setup.php");

?>
