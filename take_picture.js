/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   take_picture.js                                    :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: tbouder <tbouder@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/09/19 14:28:31 by tbouder           #+#    #+#             */
/*   Updated: 2016/09/20 13:10:55 by tbouder          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

/*******************************************************************************
** Variables
*******************************************************************************/
	var streaming = false;
	var video = document.querySelector('#video'); // The stream
	var canvas = document.querySelector('#canvas'); // The saved file
	var canvas2 = document.querySelector('#video_face'); // The preview stream
	var frame = document.querySelector('#frame'); // The preview stream
	var startbutton = document.querySelector('#startbutton');
	var width = 600;
	var height = 455;

/*******************************************************************************
** Start stream
*******************************************************************************/
	navigator.getMedia = (navigator.getUserMedia || navigator.webkitGetUserMedia
		|| navigator.mozGetUserMedia || navigator.msGetUserMedia);

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
			streaming = true;
		}
	}, false);

	video.addEventListener('timeupdate', function(ev)
	{
		img = frame;
		var ctx2 = canvas2.getContext('2d');
		ctx2.drawImage(video, 0, 0, width, height);
		ctx2.drawImage(img, 0, 0);
	}, false);

	startbutton.addEventListener('click', function(ev)
	{
		if (frame.src)
		{
			takepicture();
			ev.preventDefault();
		}
		else
			alert("Please select a filter");
	}, false);

/*******************************************************************************
** Ajax functions
*******************************************************************************/
	function ajax2()
	{
		pictures = document.getElementById('pictures');
		var request2 = new XMLHttpRequest;
		request2.open('POST', 'php_scripts/sc_display_picture.php', true);
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

	function ajax(img, callback)
	{
		var request = new XMLHttpRequest;
		request.open('POST', 'php_scripts/sc_take_photo.php', true);
		request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
		request.send("data=" + img);
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
	  var ctx = canvas.getContext('2d');
	  ctx.drawImage(video, 0, 0, width, height);
	  ctx.drawImage(frame,0,0);
	  var data = canvas.toDataURL();
	  var output = data.replace(/^data:image\/(png|jpg);base64,/, "");
	  ajax(output, ajax2);
	}

/*******************************************************************************
** Change filter
*******************************************************************************/
function png_select(elem, name)
{
	if (document.getElementById(name).classList.contains('png_select'))
	{
		a = document.getElementById(name);
		a.classList.remove("png_select");
		frame.removeAttribute("src");
		return;
	}
	Array.prototype.filter.call(elem.parentNode.children, function(child)
	{
		child.classList.remove("png_select");
	});
	frame.src = "png/" + name;
	a = document.getElementById(name);
	a.classList.add("png_select");
}
