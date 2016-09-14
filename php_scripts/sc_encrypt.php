<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   sc_encrypt.php                                     :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/14 17:20:07 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/14 19:47:54 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	function ft_encrypt_passwd($login, $passwd)
	{
		$log_infos = "_4@2koa!".$login.$passwd."+la";
		$iterations = 1000;
		$password = hash_pbkdf2("gost", $log_infos, 10, $iterations);
		$password .= hash("whirlpool", $password);
		return ($password);
	}
?>
