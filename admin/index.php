<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   index.php                                          :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/14 09:10:31 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/16 10:43:18 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	include_once("../includes.php");
	include_all();
	if ($_SESSION["user_level"] != 2)
		header("Location: ".PROJECT);

	function ft_button()
	{
		include (CONFIG_DIR."database.php");
		try
		{
			$DB = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$request = $DB->prepare("SHOW DATABASES LIKE 'db_tbouder';");
			$request->execute();
			$count = $request->rowCount();
			$request->closeCursor();
			$request = NULL;
			$DB = NULL;
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
			die();
		}
		if ($count === 0)
		{
			echo '
				<a href="'.PROJECT_CONFIG.'setup.php"><div class="adm_button">Create Database</div></a>
				<a href="'.PROJECT_ADMIN.'sc_clear_db.php" class="disable_link"><div class="adm_button adm_red">Reset Database</div></a>
			';
		}
		else
		{
			echo '
				<a href="'.PROJECT_CONFIG.'setup.php" class="disable_link"><div class="adm_button adm_red">Create Database</div></a>
				<a href="'.PROJECT_ADMIN.'sc_clear_db.php"><div class="adm_button">Reset Database</div></a>
			';
		}
	}

?>

<html>
	<?php ft_head()?>
	<body>
		<?php ft_navbar() ?>
		<?php ft_button() ?>
		<?php ft_footer() ?>
	</body>
</html>
