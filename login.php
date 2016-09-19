<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   login.php                                          :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/14 09:10:31 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/19 14:19:15 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	include_once("includes.php");
	include_all();

	function ft_login()
	{
		echo '
		<div class="login">
			<h3>Login</h3><br /><br />';
		if ($_SESSION["loggued_on_user"] == FALSE)
		{
			echo '
			<form method="POST" action="'.PROJECT_SCRIPTS.'sc_login.php">
				Username :<br /><br /><input type="text" name="user" value=""/><br /><br />
				Password :<br /><br /><input type="password" name="passwd" value=""/><br /><br />
			   <input type="submit" name="submit" value="Submit" class="login_button" />
			</form>';
		}
		else
		{
			echo '
			You are already logged<br /><br />
			<a href="index.php" class="redirect">Go back home</a>';
		}
		echo '</div>';
	}
?>

<html>
	<?php ft_head()?>
	<body>
		<?php ft_navbar() ?>
		<?php ft_login() ?>
		<?php ft_footer() ?>
	</body>
</html>
