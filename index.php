<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   index.php                                          :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/14 09:10:31 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/16 10:46:34 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	include_once("includes.php");
	include_all();

	function ft_webcam()
	{
		echo '
		<div class="webcam_container">
			<video id="video"></video>
			<div class="button_countainer"><button id="startbutton">Smile !</button></div>
			<div class="button_countainer"><span id="alternativbutton">Or upload it !
				<form action="'.PROJECT_SCRIPTS.'sc_import_image.php" method="POST" enctype="multipart/form-data">
					<input type="file" name="image" min="1">
					<input type="submit" name="submit" value="Go !">
				</form>
			</span></div>
			<canvas id="canvas"></canvas>
		</div>';
	}
	function ft_split()
	{
		if ($_SESSION["user_activ"] == 0)
		{
			echo '
			<div class="split_container_padding">
				<div class="split_content"></div>
				<a href="#goto_gallery">
					<span class="split_text" id="goto_gallery">Come and see our <span class="hold_eye">amazing</span> gallery !</span>
				</a>
				<div class="split_content"></div>
			</div>';
		}
		else
		{
			echo '
			<div class="split_container">
				<div class="split_content"></div>
				<a href="#goto_gallery">
					<span class="split_text" id="goto_gallery">Come and see our <span class="hold_eye">amazing</span> gallery !</span>
				</a>
				<div class="split_content"></div>
			</div>';
		}
	}
	function ft_display_picture()
	{
		include (CONFIG_DIR."/database.php");

		$DB = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$picture_db = $DB->prepare("SELECT * FROM db_tbouder.pictures;");
		$picture_db->execute();

		$all_pictures = $picture_db->fetchAll();
		echo '<div class="picture_container">';
		foreach ($all_pictures as $elem)
		{
			echo "<div class='picture_content'><div class='picture_content_2'>";
				echo "<img src=".$elem['link']." alt=".$elem['name']." />";
			echo "</div></div>";
		}
		echo '</div><div class="float_clr"></div>';
		$picture_db->closeCursor();
		$picture_db = NULL;
		$DB = NULL;
	}
?>
<!-- FAIRE SECURITE POUR LES PASSWORDS ET LES NOM DE COMPTE POUR EVITER
LES INJECTIONS ET BUGS -->
<html>
	<?php ft_head()?>
	<body>
		<?php ft_navbar() ?>
		<?php $_SESSION["user_activ"] == 1 ? ft_webcam() : 0; ?>
		<?php ft_split() ?>
		<?php ft_display_picture() ?>
		<?php ft_footer() ?>
	</body>
	<script src="./take_picture.js"></script>
</html>
