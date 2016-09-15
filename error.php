<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   error.php                                          :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/14 09:10:31 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/15 10:25:33 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	include_once("includes.php");
	include_all();

	function ft_error()
	{
		echo '
		<div class="error_container">
			<div class="content">'.$_SESSION["error"].'</div>
			<div class="redirect"> <a href="'.$_SESSION["error_redirect"].'">Click here to get redirected</a><br>or wait 5 secondes</div>
		</div>';
		$to_redirect = $_SESSION["error_redirect"];
		$_SESSION["error"] = 0;
		$_SESSION["error_redirect"] = "";
		echo "<meta http-equiv=\"refresh\" content=\"5;url=".$to_redirect."\"/>";
	}
?>

<html>
	<?php ft_head()?>
	<body>
		<?php ft_navbar() ?>
		<?php ft_error() ?>
		<?php ft_footer() ?>
	</body>
</html>
