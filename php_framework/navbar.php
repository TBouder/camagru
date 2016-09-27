<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   navbar.php                                         :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/14 09:10:31 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/27 19:18:43 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	function ft_navbar()
	{
		echo "<div class='navbar_container'>";
			echo "<ul class='navbar_title_container'>";
				echo "<li class='navbar_title'><a href='".PROJECT."index.php'><h1>Camagru</h1></a></li>";
				echo "<li class='navbar_link'><a href='".PROJECT."index.php'><h1>Home</h1></a></li>";
				echo "<li class='navbar_link'><a href='".PROJECT."picture_list.php?page=0&sort=date'><h1>Gallery</h1></a></li>";
			if ($_SESSION["user_level"] == 2)
				echo "<li class='navbar_link'><a href='".PROJECT_ADMIN."'><h1>Admin</h1></a></li>";
			if ($_SESSION["loggued_on_user"] == FALSE)
			{
				echo "<li class='navbar_right'><a href='".PROJECT."login.php'><h1>Login</h1></a>";
				echo "<br><br><a href='".PROJECT."create_account.php'><h1>Create account</h1></a></li>";
			}
			else
			{
				echo "<li class='navbar_link navbar_right'><h1>".$_SESSION['loggued_on_user']."</h1>";
				echo "<br><br><a href='".PROJECT."logout.php' style='float:right'><h1>Logout</h1></a></li>";
			}
			echo "</ul>";
		echo "</div>";
	}
?>
