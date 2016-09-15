var streaming = false,
	video        = document.querySelector('#video'),
	cover        = document.querySelector('#cover'),
	canvas       = document.querySelector('#canvas'),
	photo        = document.querySelector('#photo'),
	startbutton  = document.querySelector('#startbutton'),
	width = 1500,
	height = 0;

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

function takepicture()
{
	canvas.width = width;
	canvas.height = height;
	canvas.getContext('2d').drawImage(video, 0, 0, 200, 200);
	var data = canvas.toDataURL('image/png');
	photo.setAttribute('src', data);
	console.log(data);
}

startbutton.addEventListener('click', function(ev)
{
	takepicture();
	ev.preventDefault();
}, false);
