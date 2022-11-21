// +-----------------------------------+
// |             FoxCloud              |
// +-----------------------------------+
// | Questo file fa parte del progetto |
// | di Cloud Open Source "FoxCloud",  |
// | realizzato da FoxWorn.            |
// +-----------------------------------+
// | Web: https://foxcloud.fcosma.it   |
// | GH: github.com/FoxWorn3365/Cloud  |
// | License: GNU GPL 3.0              |
// +-----------------------------------+
// | You can write me an email at:     |
// | foxworn3365@gmail.com, also for   |
// | talk!                             |
// +-----------------------------------+

// +-----------------------------------+
// |   FoxPlayer for FoxCloud v1.3     |
// +-----------------------------------+
// | Author: FoxWorn3365               |
// | License: GNU GPL 3.0              |
// +-----------------------------------+
// |   github.com/FoxWorn3365/Cloud    |
// +-----------------------------------+

// Valori di partenza
let volume = 1;
let icons;
let play = false;
let videoDuration;
let time = 0;
let fullscreen = false;

// Recuperiamo il video
const player = document.getElementsByClassName('foxPlayer')[0];
if (typeof player != 'undefined') {
  initPlayer();
}

// Funzione di avvio del player
async function initPlayer() {
// Andiamo ad applicare i controlli
  let controls = await fetch('/videoplayerstemplate.html').then(response => { return response.text() });
  if (controls == undefined) {
    return;
  }
  const controlsDiv = document.createElement('div');
  controlsDiv.innerHTML = controls;
  // Per lo styling andiamo prima a recuperare le misure del div
  let playerPos = player.getBoundingClientRect();
  controlsDiv.style = 'position: absolute; top: ' + playerPos.bottom + 'px;';
  controlsDiv.style.left = playerPos.left + 'px';
  controlsDiv.style.width = player.offsetWidth + 'px';
  document.body.appendChild(controlsDiv);
  // Il player ora è avviato, definiamo giusto due variabili finali
  icons = {play:'<i class="fa-solid fa-play"></i>', pause:'<i class="fa-solid fa-pause"></i>', muted:'<i class="fa-solid fa-volume-xmark"></i>', audioMedium:'<i class="fa-solid fa-volume-low"></i>', audio:'<i class="fa-solid fa-volume-high"></i>', error:'<i class="fa-solid fa-circle-exclamation"></i>', full:'<i class="fa fa-arrows-alt" aria-hidden="true"></i>', normal:'<i class="fa fa-compress" aria-hidden="true"></i>'};
  // Ora procediamo con il verificare che non siano già attivi i controls nel player
  player.controls = false;
  // Mettiamo come durata massima quella del video
  videoDuration = player.duration;
  // Avviamo il video
  player.play();
}

/*
let playButton = document.getElementById('foxplayer-buttons-play');
let back = document.getElementById('foxplayer-buttons-back');
let next = document.getElementById('foxplayer-buttons-next');
let volumeButton = document.getElementById('foxplayer-buttons-volumeIcon');
let volumeBar = document.getElementById('foxplayer-buttons-volume');
let duration = document.getElementById('foxplayer-buttons-duration');
let timeSeconds = document.getElementById('foxplayer-buttons-second');
let timeMinute = document.getElementById('foxplayer-buttons-minute');
*/

// Funzioni per i vari bottoni
const video = {
  play: function() {
    document.getElementById('foxplayer-buttons-play').innerHTML = icons.pause;
    document.getElementById('foxplayer-buttons-play').onclick = function() { video.pause(); };
    player.play();
  },
  
  pause: function() {
    document.getElementById('foxplayer-buttons-play').innerHTML = icons.play;
    document.getElementById('foxplayer-buttons-play').onclick = function() { video.play(); };
    player.pause();
  },

  fullscreen: function() {
    document.getElementById('foxplayer-buttons-full').innerHTML = icons.normal;
    document.getElementById('foxplayer-buttons-full').onclick = function() { video.normalize(); };
    player.requestFullscreen();
    player.controls = true;
  },

  normalize: function() {
    fullscreen = false;
    document.getElementById('foxplayer-buttons-full').innerHTML = icons.full;
    document.getElementById('foxplayer-buttons-full').onclick = function() { video.fullscreen(); };
    document.exitFullscreen();
    player.controls = false;
  },
 
  changeAudio: function() {
    player.volume = document.getElementById('foxplayer-buttons-volume').value;
    volume = document.getElementById('foxplayer-buttons-volume').value;
  },

  mute: function() {
    document.getElementById('foxplayer-buttons-volumeIcon').innerHTML = icons.muted;
    document.getElementById('foxplayer-buttons-volumeIcon').onclick = function() { video.unmute(); };
    player.volume = 0;
  },

  unmute: function() {
    document.getElementById('foxplayer-buttons-volumeIcon').innerHTML = icons.audio;
    document.getElementById('foxplayer-buttons-volumeIcon').onclick = function() { video.mute(); };
    player.volume = volume;
  },

  changeTiming: function() {
    player.currentTime = document.getElementById('foxplayer-buttons-duration').value;
  },

  next: function() {
    player.currentTime = player.currentTime + 10;
    document.getElementById('foxplayer-buttons-duration').value = document.getElementById('foxplayer-buttons-duration').value + 10;
  },

  back: function() {
    player.currentTime = player.currentTime - 10;
    document.getElementById('foxplayer-buttons-duration').value = document.getElementById('foxplayer-buttons-duration').value - 10;
  },

  // FUNZIONI GENERICHE PREVALENTEMENTE DI STYLING
  displayVolumeBar: function() {
    document.getElementById('foxplayer-buttons-volume').style.display = "inline";
  },
   
  hideVolumeBar: function() {
    document.getElementById('foxplayer-buttons-volume').style.display = "none";
  }
}



// Aggiungiamo degli eventi obbligatori
player.addEventListener('fullscreenchange', function() {
  if (fullscreen) {
    player.controls = false;
    fullscreen = false;
  } else {
    fullscreen = true;
  }
});

player.addEventListener('play', function() { play = true; document.getElementById('foxplayer-buttons-duration').max = videoDuration; });
player.addEventListener('pause', function() { play = false; });

setInterval(() => {
    if (play) {
      if (time != document.getElementById('foxplayer-buttons-duration').value) {
        time = document.getElementById('foxplayer-buttons-duration').value;
      }

      document.getElementById('foxplayer-buttons-duration').value = Number(document.getElementById('foxplayer-buttons-duration').value) + 1;
      time++;

      var temp = toAcceptableData(time);
      document.getElementById('foxplayer-buttons-timeLabel').innerHTML = temp.hours + ':' + temp.minutes + ':' + temp.seconds;

      if (document.getElementById('foxplayer-buttons-duration').value == document.getElementById('foxplayer-buttons-duration').max) {
        document.getElementById('foxplayer-buttons-duration').value = document.getElementById('foxplayer-buttons-duration').value + 1;
        play = false;
        video.pause();
      }  
    }
}, 1000);

// Funzioni di utilità estetica
function toAcceptableData(seconds) {
  var temps = 0;
  var minute = 0;
  var hr = 0;
  for (let i = 0; i < (seconds + 1); i++) {
    temps++;
    if (temps == 60) {
      temps = 0;
      minute++;
      if (minute == 60) {
        minute = 0;
        hr++;
      }
    }
  }
  if (temps < 10) {
    temps = '0' + temps;
  }
  if (minute < 10) {
    minute = '0' + minute;
  }
  if (hr < 10) {
    hr = '0' + hr;
  }
  hr = hr ?? '00';
  minute = minute ?? '00';
  return {'seconds':temps, 'minutes':minute, 'hours':hr};
}
