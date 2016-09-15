<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   navbar.php                                         :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/14 09:10:31 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/15 19:40:03 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	function ft_navbar()
	{
		echo '
		<div class="navbar_container">
			<ul class="navbar_title_container">
				<li class="navbar_title"><a href="'.PROJECT.'index.php"><h1>Camagru</h1></a></li>
				<li class="navbar_link"><a href="'.PROJECT.'index.php"><h1>Home</h1></a></li>
				<li class="navbar_link"><a href="'.PROJECT.'about.php"><h1>About</h1></a></li>';

		if ($_SESSION["loggued_on_user"] == FALSE)
		{
			echo '
				<li class="navbar_right"><a href="'.PROJECT.'login.php"><h1>Login</h1></a><br><br><a href="'.PROJECT.'create_account.php"><h1>Create account</h1></a></li>
			</ul>
		</div>';
		}
		else
		{
			echo '
				<li class="navbar_link navbar_right"><h1>'.$_SESSION['loggued_on_user'].'</h1><br><br><a href="'.PROJECT.'logout.php" style="float:right"><h1>Logout</h1></a></li>
			</ul>
		</div>';
		}
	}
?>
