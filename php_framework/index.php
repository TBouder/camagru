<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   index.php                                          :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/14 09:10:31 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/27 00:29:36 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();

	function ft_index_webcam()
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

		echo "</div>";
			echo "<div class='button_countainer'><button id='startbutton'>Smile !</button></div>";
			echo "<div class='button_countainer'>";
				echo "<span id='alternativbutton'>Or upload it !";
					// echo "<form action='".PROJECT_SCRIPTS."sc_import_image.php' method='POST' enctype='multipart/form-data'>";
					echo "<form method='POST' enctype='multipart/form-data' id='import' onchange='previewFile()'>";
						echo "<input type='file' name='image' min='1' id='import_image'>";
						echo "<input type='submit' name='submit' value='Go !' id='import_button'>";
					echo "</form>";
				echo "</span>";
			echo "</div>";
			echo "<canvas id='canvas'>";
				echo "<img id='frame' width='132' height='150'>";
				echo "<canvas id='taken_picture'></canvas>";
				echo "<canvas id='png_picture'></canvas>";
			echo "</canvas>";
		echo "</div>";
	}
	function ft_index_split()
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
