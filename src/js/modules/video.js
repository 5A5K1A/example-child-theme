const video = document.querySelector('.video');
const playButton = document.querySelector('.play');
let clicked = false;
const loopEnd = 2;
const loopStart = 0;
const videoOwnHeight = 900;

// Check if video is loaded before
if (!sessionStorage.getItem('video_loaded')) {
  // wat until page is loaded
  window.setTimeout(function() {
    LoadVideo();
    sessionStorage.setItem('video_loaded', 1);
  }, 2000);
} else {
  // load video
  LoadVideo();
}

// play the video
function playVideo() {
  clicked = true;
  video.muted = false;
  document.querySelector('.hero-header--text-container').classList.add('fade-out');

  createControls();
}

function createControls() {
  // make play-pause
  const videoContainer = document.querySelector('.video-custom');
  const playPause = document.createElement('button');
  const mute = document.createElement('button');
  playPause.classList.add('play-pause', 'state-pause');
  mute.classList.add('mute', 'state-unmute');
  videoContainer.appendChild(playPause);
  videoContainer.appendChild(mute);

  playPause.addEventListener('click', togglePlay);
  mute.addEventListener('click', toggleSound);
}

// Play pause the video
function togglePlay() {
  const playPause = document.querySelector('.play-pause');

  if (video.paused === true) {
    video.play();
    playPause.classList.add('state-pause');
    playPause.classList.remove('state-play');
  } else {
    video.pause();
    playPause.classList.add('state-play');
    playPause.classList.remove('state-pause');
  }
}

// Toggle the sound of the video
function toggleSound() {
  const mute = document.querySelector('.mute');

  if ( video.muted === true ) {
    video.muted = false;
    mute.classList.add('state-unmute');
    mute.classList.remove('state-mute');
  } else {
    video.muted = true;
    mute.classList.add('state-mute');
    mute.classList.remove('state-unmute');
  }
}

// load the new source elements for the video
function LoadVideo() {
  // TODO: check if browser supports video properly
  if (window.innerWidth >= videoOwnHeight) {
    // Create elements
    const source = document.createElement('source');
    const webm = source.cloneNode(true);
    const mp4 = source.cloneNode(true);

    // add needed attr's
    webm.src = 'http://techslides.com/demos/sample-videos/small.webm';
    webm.type = 'video/webm';

    mp4.src = 'http://www.w3schools.com/html/mov_bbb.mp4';
    mp4.type = 'video/mp4';

    // append them to the video
    video.appendChild(webm);
    video.appendChild(mp4);
  }

  // Checks or the video needs to be looped
  video.ontimeupdate = function() {
    if ( !clicked && video.currentTime >= loopEnd ) {
      video.currentTime = loopStart;
    }
  };

  playButton.addEventListener('click', playVideo);
}




// Make the video full screen if your browser supports that
// function makeFullScreen(video) {
//    //Use the specification method before using prefixed versions
//   if (video.requestFullscreen) {
//     video.requestFullscreen();
//   }
//   else if (video.msRequestFullscreen) {
//     video.msRequestFullscreen();
//   }
//   else if (video.mozRequestFullScreen) {
//     video.mozRequestFullScreen();
//   }
//   else if (video.webkitRequestFullscreen) {
//     video.webkitRequestFullscreen();
//   } else {
//     console.log("Fullscreen API is not supported");
//   }
// }


// <source src="http://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">
// <source src="http://techslides.com/demos/sample-videos/small.webm" type="video/webm">


// jQuery(function($){
//
// 	function LoadVideo() {
// 		var video = $('<video />', {
// 			id: 	 	'video',
// 			class:   	'video-playing',
// 			preload: 	'auto',
// 			loop: 	 	true,
// 			autoplay: 	true,
// 			poster: 	hcj_static + '/images/blank-100x100.gif',
// 		});
// 		var mp4 = $('<source />', {
// 			src:  hcj_cdn + '/video/hcj.mp4',
// 			type: 'video/mp4'
// 		});
// 		mp4.appendTo(video);
// 		var webm = $('<source />', {
// 			src:  hcj_cdn + '/video/hcj.webm',
// 			type: 'video/webm;codecs="vp8, vorbis'
// 		});
// 		webm.appendTo(video);
// 		video.appendTo($('.video-wrapper'));
// 	}
//
// 	if( $('.video-wrapper').length ) {
// 		if( !sessionStorage.getItem('video_loaded') ) {
// 			setTimeout(function(){
// 				LoadVideo();
// 				sessionStorage.setItem('video_loaded', 1);
// 		 	}, 2000);
// 		} else {
// 			LoadVideo();
// 		}
// 	}
// });
