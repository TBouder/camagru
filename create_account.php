<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   create_account.php                                 :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/14 09:10:31 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/14 19:37:19 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	include_once("includes.php");
	include_all();

	function ft_create_account()
	{
		echo '
		<div class="create_account">
			<h3>Enregistrement</h3><br /><br />';
		if ($_SESSION["loggued_on_user"] == FALSE)
		{
			echo '
			<form method="POST" action="php_scripts/sc_create_account.php">
				Username :<br /><br /><input type="text" name="user" value="" size="30" /><br /><br />
				Email :<br /><br /><input type="text" name="email" value="" size="30" /><br /><br />
				Password :<br /><br /><input type="password" name="passwd" value="" size="30" /><br /><br />
			   <input type="submit" name="submit" value="Submit" />
			</form>';
		}
		else
		{
			echo '
			Vous êtes déjà connecté<br /><br />
			<a href="index.php" class="redirect">Retourner à l\'acceuil</a>';
		}
		echo '</div>';
	}
?>

<html>
	<?php ft_head()?>
	<body>
		<?php ft_navbar() ?>
		<?php ft_create_account() ?>
		<?php ft_footer() ?>
	</body>
</html>
