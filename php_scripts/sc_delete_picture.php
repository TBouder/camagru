<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   sc_delete_picture.php                              :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/26 12:17:13 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/27 23:58:17 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	include_once("../includes.php");
	include_all();

	if ($_POST['picture_name'])
	{
		$name = $_POST['picture_name'];
		$user = $_SESSION['loggued_on_user'];
		/*DELETE IMAGE*/
		$sql = "DELETE FROM db_tbouder.pictures WHERE name='".$name."' AND owner='".$user."';";
		ft_exec_sql(FALSE, $sql);
		/*DELETE COMMENTS*/
		$sql = "DELETE FROM db_tbouder.comments WHERE image_name='".$name."' AND owner='".$user."';";
		ft_exec_sql(FALSE, $sql);
	}
?>
