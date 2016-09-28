<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   index.php                                          :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/14 09:10:31 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/28 15:16:42 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();

	function ft_index_webcam()
	{
		$user_dir = PROJECT."png/";
		$scan_dir = scandir(ROOT_DIR."png/");

		echo "<div class='webcam_container'>";
			echo "<video id='video'></video>";
			echo "<canvas id='video_face'></canvas>";
			echo "<div class='selectable_png'>";
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
					echo "<form method='POST' enctype='multipart/form-data' id='import' onsubmit='ft_send_file(); return false' onchange='ft_preview_file()'>";
						echo "<input type='file' name='image' min='1' id='import_image'>";
						echo "<input type='submit' name='submit' value='Go !' id='import_button'>";
					echo "</form>";
					echo "<button id='cancel_submit' onclick='ft_cancel_upload()'>Cancel preview</button>";
				echo "</span>";
			echo "</div>";
			echo "<canvas id='canvas'>";
				echo "<img id='frame' width='132' height='150'>";
				echo "<canvas id='uploaded_picture'></canvas>";
				echo "<canvas id='taken_picture'></canvas>";
				echo "<canvas id='png_picture'></canvas>";
			echo "</canvas>";
		echo "</div>";
	}

	function ft_index_split()
	{
		echo $_SESSION["user_activ"] == 0 ? "<div class='split_container_padding'>" : "<div class='split_container'>";
			echo "<div class='split_content'></div>";
			echo "<a href='#goto_gallery'>";
				echo "<span class='split_text' id='goto_gallery'>Come and see our <span class='hold_eye'>amazing</span> gallery !</span>";
			echo "</a>";
			echo "<div class='split_content'></div>";
		echo "</div>";
	}
?>
