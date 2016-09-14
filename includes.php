<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   includes.php                                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/14 09:10:31 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/14 19:10:21 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	function include_all()
	{
		/***********************************************************************
		** Include all the frameworks
		***********************************************************************/
		$dir = scandir("./php_framework");
		foreach ($dir as $file)
		{
			if ($file == "." || $file == "..")
				continue;
			include_once("./php_framework/$file");
		}
		// include_once("./php_scripts/sc_display_list.php");
	}

?>
