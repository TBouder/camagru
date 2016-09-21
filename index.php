<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   index.php                                          :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/14 09:10:31 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/20 20:50:16 by tbouder          ###   ########.fr       */
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
			<canvas id="video_face"></canvas>
			<div class="selectable_png">';
			$user_dir = PROJECT."png/";
			$scan_dir = scandir(ROOT_DIR."png/");

			foreach ($scan_dir as $name)
			{
				if ($name === "." || $name === "..")
					continue;
				echo '<img src="'.$user_dir.$name.'" class="png_img" id="'.$name.'" onclick="png_select(this, \''.$name.'\')">';
			}

		echo '</div>
			<div class="button_countainer"><button id="startbutton">Smile !</button></div>
			<div class="button_countainer"><span id="alternativbutton">Or upload it !
				<form action="'.PROJECT_SCRIPTS.'sc_import_image.php" method="POST" enctype="multipart/form-data">
					<input type="file" name="image" min="1">
					<input type="submit" name="submit" value="Go !">
				</form>
			</span></div>
			<canvas id="canvas">
				<img id="frame" width="132" height="150">
				<canvas id="taken_picture"></canvas>
				<canvas id="png_picture"></canvas>
			</canvas>
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

?>
<html>
	<?php ft_head()?>
	<body onload="ajax2()">
		<?php ft_navbar() ?>
		<?php $_SESSION["user_activ"] == 1 ? ft_webcam() : 0; ?>
		<?php ft_split() ?>
		<div id='pictures'></div>
		<?php ft_footer() ?>
	</body>
	<?php if ($_SESSION["user_activ"] == 1) echo '<script src="./take_picture.js"></script>'; ?>
</html>
