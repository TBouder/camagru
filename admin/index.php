<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   index.php                                          :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/14 09:10:31 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/28 00:22:48 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	include_once("../includes.php");
	include_all();

	if ($_SESSION["user_level"] != 2)
		header("Location: ".PROJECT);

	function ft_button()
	{
		$sql = "SHOW DATABASES LIKE 'db_tbouder';";
		$count = ft_exec_sql("rowCount", $sql);
		echo "<div class='adm_container'>";
		if ($count === 0)
		{
			echo "<a href='".PROJECT_CONFIG."setup.php'><div class='adm_button'>Create Database</div></a>";
			echo "<a href='".PROJECT_ADMIN."sc_clear_db.php' class='disable_link'><div class='adm_button adm_red'>Reset Database</div></a>";
		}
		else
		{
			echo "<a href='".PROJECT_CONFIG."setup.php' class='disable_link'><div class='adm_button adm_red'>Create Database</div></a>";
			echo "<a href='".PROJECT_ADMIN."sc_clear_db.php'><div class='adm_button'>Reset Database</div></a>";
		}
		echo "</div>";
		$sql = "SELECT * FROM db_tbouder.users;";
		$users = ft_exec_sql("fetchAll", $sql);
		foreach ($users as $key => $value)
		{
			echo $value['login']." ";
			echo $value['email']." ";
			echo $value['user_level']." ";
			echo $value['activ'];
			echo "<br>";
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
