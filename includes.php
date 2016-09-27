<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   includes.php                                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/14 09:10:31 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/27 23:53:16 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	/* FRONT */
	define('PROJECT', '/camagru/');
	define('PROJECT_CONFIG', PROJECT."config/");
	define('PROJECT_SCRIPTS', PROJECT."php_scripts/");
	define('PROJECT_CSS', PROJECT."css/");
	define('PROJECT_IMG', PROJECT."img/");
	define('PROJECT_ADMIN', PROJECT."admin/");

	/* BACK */
	define('ROOT_DIR', dirname(__FILE__) . '/');
	define('CONFIG_DIR', ROOT_DIR."config/");
	define('SCRIPTS_DIR', ROOT_DIR."php_scripts/");
	define('IMG_DIR', ROOT_DIR."img/");

	function include_all()
	{
		/***********************************************************************
		** Include all the frameworks
		***********************************************************************/
		$dir = scandir(ROOT_DIR."php_framework");
		foreach ($dir as $file)
		{
			if ($file == "." || $file == "..")
				continue;
			include_once(ROOT_DIR."php_framework/$file");
		}
		include_once(ROOT_DIR."php_scripts/sc_tools.php");
	}

?>
