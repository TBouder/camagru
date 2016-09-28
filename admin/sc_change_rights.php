<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   sc_change_rights.php                               :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/28 11:54:14 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/28 13:12:12 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	include_once("../includes.php");
	include_all();

	if ($_SESSION["user_level"] != 2)
		header("Location: ".PROJECT);

	$data = $_POST['data'];
	$change = $_POST['change'];
	$login = strtolower($_POST['login']);
	$login = htmlspecialchars($login);

	if ($data == "user_level")
	{
		$sql = "SELECT * FROM db_tbouder.users WHERE login='$login';";
		$user_level = ft_exec_sql("fetchAll", $sql)[0]['user_level'];

		if ($change == "minus" && $user_level > 0)
			$sql = "UPDATE db_tbouder.users SET user_level=user_level-1 WHERE login='$login';";
		else if ($change == "plus" && $user_level < 2)
			$sql = "UPDATE db_tbouder.users SET user_level=user_level+1 WHERE login='$login';";
		else
			$sql = FALSE;
	}

	if ($data == "activ")
	{
		$sql = "SELECT * FROM db_tbouder.users where login='$login';";
		$activ = ft_exec_sql("fetchAll", $sql)[0]['activ'];

		if ($change == "minus" && $activ == 1)
			$sql = "UPDATE db_tbouder.users SET activ=activ-1 WHERE login='$login';";
		else if ($change == "plus" && $activ == 0)
			$sql = "UPDATE db_tbouder.users SET activ=activ+1 WHERE login='$login';";
		else
			$sql = FALSE;
	}
	if ($sql != FALSE)
		ft_exec_sql(FALSE, $sql);
?>
