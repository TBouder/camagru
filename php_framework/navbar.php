<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   navbar.php                                         :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/14 09:10:31 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/14 19:09:53 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	function ft_navbar()
	{
		echo '
		<div class="navbar_container">
			<ul class="navbar_title_container">
				<li class="navbar_title"><a href="index.php"><h1>Camagru</h1></a></li>
				<li class="navbar_link"><a href="index.php"><h1>Acceuil</h1></a></li>
				<li class="navbar_link"><a href="about.php"><h1>À propos</h1></a></li>';

		if ($_SESSION["loggued_on_user"] == FALSE)
		{
			echo '
				<li class="navbar_right"><a href="login.php"><h1>Se connecter</h1></a><br><br><a href="create_account.php"><h1>Créer un compte</h1></a></li>
			</ul>
		</div>';
		}
		else
		{
			echo '
				<li class="navbar_link navbar_right"><h1>'.$_SESSION['loggued_on_user'].'</h1><br><br><a href="logout.php" style="float:right"><h1>Se déconnecter</h1></a></li>
			</ul>
		</div>';
		}
	}
?>
