<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   index.php                                          :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/14 09:10:31 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/27 15:38:58 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

	session_start();
	include_once("includes.php");
	include_all();

?>
<html>
	<?php ft_head()?>
	<?php if ($_SESSION["user_activ"] == 1) echo '<body onload="ajax2()">'; else echo '<body>'; ?>
		<?php ft_navbar() ?>
		<?php $_SESSION["user_activ"] == 1 ? ft_index_webcam() : 0; ?>
		<?php ft_index_split() ?>
		<div id='pictures' class='picture_index'></div>
		<?php ft_footer() ?>
	</body>
	<?php if ($_SESSION["user_activ"] == 1) echo '<script src="./take_picture.js"></script>'; ?>
	<script>
	function ft_send_file()
	{
		var preview = document.createElement("img");
		var file    = document.querySelector('input[type=file]').files[0];
		var reader  = new FileReader();

		if (document.querySelector('#frame').src)
		{
			reader.addEventListener("load", function ()
			{
				preview.src = reader.result;
				var ctx_taken_picture = document.querySelector('#taken_picture').getContext('2d');
				var ctx_png_picture = document.querySelector('#png_picture').getContext('2d');
				ctx_taken_picture.drawImage(preview, 0, 0, width, height);
				ctx_png_picture.drawImage(document.querySelector('#frame'), 0, 0);
				var output1 = taken_picture.toDataURL().replace(/^data:image\/(png|jpg);base64,/, "");
				var output2 = png_picture.toDataURL().replace(/^data:image\/(png|jpg);base64,/, "");
				ajax(output1, output2, ajax2);
				ctx_taken_picture.clearRect(0, 0, width, height);
				ctx_png_picture.clearRect(0, 0, width, height);
			}, false);
			if (file)
				reader.readAsDataURL(file);
		}
		else
			alert("Please select a filter");
		return false;
	}


	function ft_preview_file()
	{
		var preview = document.createElement("img");
		var file    = document.querySelector('input[type=file]').files[0];
		var reader  = new FileReader();

		reader.addEventListener("load", function ()
		{
			preview.src = reader.result;
			var container = document.querySelector('#uploaded_picture');
			var img = document.querySelector('#frame');
			var ctx2 = document.querySelector('#video_face').getContext('2d');
			ctx2.drawImage(preview, 0, 0, width, height);
			ctx2.drawImage(img, 0, 0);
			container.appendChild(preview);
		}, false);
		if (file)
			reader.readAsDataURL(file);
	}
	</script>
	<script src="./picture_list.js"></script>
</html>
