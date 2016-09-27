<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   account.php                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/14 09:10:31 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/27 19:47:44 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();

	function ft_create_account_form()
	{
		echo "<div class='create_account'>";
			echo "<h3>Create Account</h3><br /><br />";
		if ($_SESSION["loggued_on_user"] == FALSE)
		{
			echo "<form method='POST' action='".PROJECT_SCRIPTS."sc_form_create_account.php'>";
				echo "Username :<br /><br /><input type='text' name='user'/><br /><br />";
				echo "Email :<br /><br /><input type='text' name='email'/><br /><br />";
				echo "Password :<br /><br /><input type='password' name='passwd'/><br /><br />";
				echo "<input type='submit' name='submit' value='Submit' />";
			echo "</form>";
		}
		else
		{
			echo "You are already logged<br /><br />";
			echo "<a href='".PROJECT."' class='redirect'>Go back home</a>";
		}
		echo "</div>";
	}

	function ft_login_form()
	{
		echo "<div class='login'>";
			echo "<h3>Login</h3><br /><br />";
		if ($_SESSION['loggued_on_user'] == FALSE)
		{
			echo "<form method='POST' action='".PROJECT_SCRIPTS."sc_form_login.php'>";
				echo "Username :<br /><br /><input type='text' name='user'/><br /><br />";
				echo "Password :<br /><br /><input type='password' name='passwd'/><br /><br />";
				echo "<input type='submit' name='submit' value='Submit' class='login_button' />";
			echo "</form>";
			echo "<div class='reset_passwd'><a href='".PROJECT."reset_passwd.php'>Reset password</a></div>";
		}
		else
		{
			echo "You are already logged<br /><br />";
			echo "<a href='".PROJECT."' class='redirect'>Go back home</a>";
		}
		echo "</div>";
	}

	function ft_reset_form()
	{
		echo "<div class='login'>";
			echo "<h3>Reset password</h3><br /><br />";
		if ($_SESSION['loggued_on_user'] == FALSE)
		{
			echo "<form method='POST' action='".PROJECT_SCRIPTS."sc_form_reset_passwd.php'>";
				echo "Username :<br /><br /><input type='text' name='user'/><br /><br />";
				echo "Email :<br /><br /><input type='text' name='email'/><br /><br />";
				echo "<input type='submit' name='submit' value='Submit'/>";
			echo "</form>";
		}
		else
		{
			echo "You are already logged<br /><br />";
			echo "<a href='".PROJECT."' class='redirect'>Go back home</a>";
		}
		echo "</div>";
	}

	function ft_new_passwd_form()
	{
		include (CONFIG_DIR."database.php");
		$DB = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM db_tbouder.users WHERE unique_id IN ('".$_GET['id']."');";
		$request = $DB->prepare($sql);
		$request->execute();
		$users = $request->fetchAll()[0];
		$count = $request->rowCount();
		$request->closeCursor();
		$request = NULL;

		echo '
		<div class="login">
			<h3>Reset password</h3><br /><br />';
		if ($_SESSION["loggued_on_user"] == FALSE)
		{
			echo "<form method='POST' action='".PROJECT_SCRIPTS."sc_mail_edit_passwd.php'>";
				echo "Username :<br /><br /><input type='text' name='user' value='".$users['login']."' readonly/><br /><br />";
				echo "Email :<br /><br /><input type='text' name='email' value='".$users['email']."' readonly/><br /><br />";
				echo "Password :<br /><br /><input type='password' name='passwd' value='' /><br /><br />";
				echo "<input type='submit' name='submit' value='Submit' class='login_button' />";
			echo "</form>";
		}
		else
		{
			echo "You are already logged<br /><br />";
			echo "<a href='index.php' class='redirect'>Go back home</a>";
		}
		echo "</div>";
	}
?>
