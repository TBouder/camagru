/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   take_picture.js                                    :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/19 14:28:31 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/28 14:43:58 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

/*******************************************************************************
** Variables
*******************************************************************************/
	var streaming = false;
	var video = document.querySelector('#video'); // The stream
	var canvas = document.querySelector('#canvas'); // The saved file
	var canvas2 = document.querySelector('#video_face'); // The preview stream
	var startbutton = document.querySelector('#startbutton');
	var import_button = document.querySelector('#import_button');
	var width = 600;
	var height = 455;

/*******************************************************************************
** Start stream
*******************************************************************************/
	navigator.getMedia = (navigator.getUserMedia || navigator.webkitGetUserMedia
		|| navigator.mediaDevices.getUserMedia || navigator.msGetUserMedia);

	if (typeof InstallTrigger !== 'undefined')
	{
		var p = navigator.mediaDevices.getUserMedia({ audio: false, video: true });
		p.then(function(stream)
		{
			video.src = window.URL.createObjectURL(stream);
			video.onloadedmetadata = function(e)
			{
				video.play();
			};
		});
		p.catch(function(err) { console.log(err.name); }); // always check for errors at the end.
	}
	else
	{
		if (navigator.getMedia)
		{
			navigator.getMedia( { video: true, audio: false },
		    function(stream)
			{
		        video.src = window.URL.createObjectURL(stream);
				video.play();
		    },
			function(err) { console.log("The following error occured: " + err); });
		}
	}

/*******************************************************************************
** Ajax functions
*******************************************************************************/
	function ajax2()
	{
		pictures = document.getElementById('pictures');
		var request2 = new XMLHttpRequest;
		request2.open('POST', 'php_scripts/sc_display_picture_index.php', true);
		request2.onload = function()
		{
			if (request2.status >= 200 && request2.status < 400)
			{
				var resp = request2.responseText;
				pictures.innerHTML = resp;
			}
		};
		request2.send();
	}
	function ajax(data1, data2, callback)
	{
		var request = new XMLHttpRequest;
		request.open('POST', 'php_scripts/sc_take_photo.php', true);
		request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
		request.send("data1=" + data1 + "&data2=" + data2);
		request.onload = function()
		{
			if (request.status >= 200 && request.status < 400)
			{
				var resp = request.responseText;
				callback();
			}
		};
	}

/*******************************************************************************
** Screenshot
*******************************************************************************/
	function takepicture()
	{
		var ctx_taken_picture = document.querySelector('#taken_picture').getContext('2d');
		var ctx_png_picture = document.querySelector('#png_picture').getContext('2d');

		ctx_taken_picture.drawImage(video, 0, 0, width, height);
		ctx_png_picture.drawImage(document.querySelector('#frame'), 0, 0);
		var output1 = taken_picture.toDataURL().replace(/^data:image\/(png|jpg);base64,/, "");
		var output2 = png_picture.toDataURL().replace(/^data:image\/(png|jpg);base64,/, "");
		ajax(output1, output2, ajax2);
		ctx_taken_picture.clearRect(0, 0, width, height);
		ctx_png_picture.clearRect(0, 0, width, height);
	}

/*******************************************************************************
** Event listener
*******************************************************************************/
	video.addEventListener('canplay', function(ev)
	{
		if (!streaming)
		{
			height = video.videoHeight / (video.videoWidth/width);
			video.setAttribute('width', width);
			video.setAttribute('height', height);
			canvas2.setAttribute('width', width);
			canvas2.setAttribute('height', height);
			canvas.setAttribute('width', width);
			canvas.setAttribute('height', height);

			taken_picture.setAttribute('width', width);
			taken_picture.setAttribute('height', height);
			png_picture.setAttribute('width', width);
			png_picture.setAttribute('height', height);
			streaming = true;
		}
	}, false);

	video.addEventListener('timeupdate', function(ev)
	{
		if (document.querySelector('#uploaded_picture').innerHTML === "")
		{
			var ctx = canvas2.getContext('2d');
			ctx.drawImage(video, 0, 0, width, height);
			if (document.querySelector('#frame').src !== "")
			{
				var img = document.querySelector('#frame');
				ctx.drawImage(img, 0, 0);
			}
		}
		else
			ft_preview_file();
	}, false);

	startbutton.addEventListener('click', function(ev)
	{
		if (document.querySelector('#frame').src)
		{
			takepicture();
			ev.preventDefault();
		}
		else
			alert("Please select a filter");
	}, false);

/*******************************************************************************
** Change filter + Like and Dislike
*******************************************************************************/
	function png_select(elem, name)
	{
		if (document.getElementById(name).classList.contains('png_select'))
		{
			a = document.getElementById(name);
			a.classList.remove("png_select");
			document.querySelector('#frame').removeAttribute("src");
			return;
		}
		Array.prototype.filter.call(elem.parentNode.children, function(child)
		{
			child.classList.remove("png_select");
		});
		document.querySelector('#frame').src = "png/" + name;
		a = document.getElementById(name);
		a.classList.add("png_select");
	}
	function ft_like_index(name)
	{
		ajax_like(name, ajax2, 1);
	}
	function ft_dislike_index(name)
	{
		ajax_like(name, ajax2, -1);
	}

/*******************************************************************************
** Image upload and preview
*******************************************************************************/
	function ft_send_file()
	{
		var preview = document.createElement("img");
		var file    = document.querySelector('input[type=file]').files[0];
		var reader  = new FileReader();

		if (!file.type.match('image.*'))
			return false;

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

		if (!file.type.match('image.*'))
			return false;

		reader.addEventListener("load", function ()
		{
			canvas2.getContext('2d').clearRect(0, 0, width, height);
			preview.src = reader.result;
			var container = document.querySelector('#uploaded_picture');
			var img = document.querySelector('#frame');
			var ctx = canvas2.getContext('2d');
			ctx.drawImage(preview, 0, 0, width, height);
			ctx.drawImage(img, 0, 0);
			container.appendChild(preview);
		}, false);
		if (file)
			reader.readAsDataURL(file);
	}

	function ft_cancel_upload()
	{
		document.querySelector('#uploaded_picture').innerHTML = "";
	}
