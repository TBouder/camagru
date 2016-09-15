var streaming = false,
	video        = document.querySelector('#video'),
	cover        = document.querySelector('#cover'),
	canvas       = document.querySelector('#canvas'),
	photo        = document.querySelector('#photo'),
	startbutton  = document.querySelector('#startbutton'),
	width = 300,
	height = 225;

navigator.getMedia = (navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia);

if (navigator.getMedia)
{
	navigator.getMedia(
    {
		video: true,
		audio: false
    },
    function(stream)
	{
		var video = document.querySelector('video');
        video.src = window.URL.createObjectURL(stream);
		video.play();
    },
	function(err)
	{
		console.log("The following error occured: " + err);
    });
}
else
	console.log("getUserMedia not supported");


video.addEventListener('canplay', function(ev)
{
	if (!streaming)
	{
		height = video.videoHeight / (video.videoWidth/width);
		video.setAttribute('width', width);
		video.setAttribute('height', height);
		canvas.setAttribute('width', width);
		canvas.setAttribute('height', height);
		streaming = true;
	}
}, false);

function ajax(img)
{
	var request = new XMLHttpRequest;
	request.open('POST', 'php_scripts/sc_take_photo.php', true);
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
	// console.log(img);
	request.send("data=" + img);
	request.onload = function()
	{
		if (request.status >= 200 && request.status < 400)
		{
			var resp = request.responseText;
			console.log(resp);
		}
	};
}

// function takepicture()
// {
// 	canvas.getContext('2d').drawImage(video, 0, 0, width, height);
// 	var data = canvas.toDataURL('image/png');
// 	ajax(data);
// }

function takepicture()
{
  canvas.width = width;
  canvas.height = height;
  canvas.getContext('2d').drawImage(video, 0, 0, width, height);
  var data = canvas.toDataURL();
  var output=data.replace(/^data:image\/(png|jpg);base64,/, "");

  // console.log(data);
  ajax(output);
  // console.log(data);

}

startbutton.addEventListener('click', function(ev)
{
	takepicture();
	ev.preventDefault();
}, false);
