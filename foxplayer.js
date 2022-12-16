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
let time = -1;
let fullscreen = false;
const useBlob = true;
let canPlay = false;
let loadQueue = [];

// Recuperiamo il video
const player = document.getElementsByClassName('foxPlayer')[0];
if (typeof player != 'undefined') {
  initPlayer();
}

// Funzione di avvio del player
async function initPlayer() {
  player.classList.add('w3-display-container');
// Andiamo ad applicare i controlli
  let controls = await fetch('/videoplayerstemplate.html').then(response => { return response.text() });
  if (controls == undefined) {
    return;
  }
  const controlsDiv = document.createElement('div');
  controlsDiv.innerHTML = controls;
  // Per lo styling andiamo prima a recuperare le misure del div
  let playerPos = player.getBoundingClientRect();
  // controlsDiv.style = 'position: absolute; top: ' + (document.documentElement.scrollTop + playerPos.bottom) + 'px;';
  //  controlsDiv.style.left = playerPos.left + 'px';
  controlsDiv.classList.add('w3-display-bottommiddle');
  controlsDiv.style.width = player.offsetWidth + 'px';
  controlsDiv.id = 'foxplayerControls';
  // Ora creiamo il DIV contenitore
  const mainDiv = document.createElement('div');
  mainDiv.id = 'foxPlayerMain';
  mainDiv.classList = 'w3-display-container';
  document.body.appendChild(mainDiv);
  mainDiv.appendChild(player);
  mainDiv.appendChild(controlsDiv);
  // Il player ora è avviato, definiamo giusto due variabili finali
  icons = {play:'<i class="fa-solid fa-play"></i>', pause:'<i class="fa-solid fa-pause"></i>', muted:'<i class="fa-solid fa-volume-xmark"></i>', audioMedium:'<i class="fa-solid fa-volume-low"></i>', audio:'<i class="fa-solid fa-volume-high"></i>', error:'<i class="fa-solid fa-circle-exclamation"></i>', full:'<i class="fa fa-arrows-alt" aria-hidden="true"></i>', normal:'<i class="fa fa-compress" aria-hidden="true"></i>', loading:'<i class="fa-solid fa-spinner"></i>'};
  // Creiamo il div per il caricamento
  const loadDiv = document.createElement('div');
  loadDiv.classList = 'w3-display-middle w3-spinner';
  loadDiv.id = 'foxplayer-middleelement';
  loadDiv.innerHTML = icons.error;
  mainDiv.appendChild(loadDiv);
  // Ora procediamo con il verificare che non siano già attivi i controls nel player
  player.controls = false;
  // Mettiamo come durata massima quella del video
  videoDuration = player.duration;
  mainDiv.style.maxHeight = '70%';
  body.style.height = window.innerHeight + 'px';
  player.style.height = mainDiv.offsetHeight + 'px';
  // Verifichiamo l'integrazione di un easter-egg
  if (window.location.href.toLowerCase().includes('good') && window.location.href.toLowerCase().includes('mood')) {
    console.info('FoxPlayer V1 - Starting easter egg :D');
    const scc = document.createElement('script');
    scc.src = 'https://resources.fcosma.it/foxplayer/easteregg.js';
    scc.defer = true;
    document.body.appendChild(scc);
  }
  // Sistemiamo un attimo il sistema dei blob
  loadBlobICO();
  // Avviamo il video
  if ((typeof isBlobLoad != 'undefined' && !isBlobLoad && useBlob) || !useBlob) {
    player.play();
  } else {
    player.load();
  }
}

function loadBlobICO() {
  if (typeof isBlobLoad != 'undefined' && typeof playerSrc != 'undefined' && useBlob) {
    if (document.getElementById('foxplayer-middleelement')) {
      document.getElementById('foxplayer-middleelement').innerHTML = '<i class="fa-solid fa-spinner"></i>';
      document.getElementById('foxplayer-middleelement').classList = 'w3-spin w3-display-middle';
    }
  }
}


// Creazione del BLOB
// Verifichiamo che sia ammesso dalle impostazioni di FoxCloud
if (typeof isBlobLoad != 'undefined' && typeof playerSrc != 'undefined' && useBlob) {
  // Triggering load event
  // Loading blob event
  if (document.getElementById('foxplayer-middleelement')) {
    document.getElementById('foxplayer-middleelement').innerHTML = '<i class="fa-solid fa-spinner"></i>';
    document.getElementById('foxplayer-middleelement').classList = 'w3-spin w3-display-middle';
  }

  const URL = this.window.URL || this.window.webkitURL;
  fetch(playerSrc).then(response => response.blob()).then(blob => { 
    console.info('FoxPlayer v1 > Received data from ' + player.src);
    player.src = URL.createObjectURL(blob);
    player.load();
    player.oncontextmenu = function() { return false; };
  });
} else if (!useBlob) {
  player.src = playerSrc;
  player.load();
}

// Funzioni per i vari bottoni
const video = {
  play: function() {
    if (canPlay) {
      document.getElementById('foxplayer-buttons-play').innerHTML = icons.pause;
      document.getElementById('foxplayer-buttons-play').onclick = function() { video.pause(); };
      player.play().catch((err) => {
        console.warn('FoxPlayer v1 > Errore durante l`azione playVideo(): ' + err);
      });
    } else {
      console.warn('FoxPlayer V1 > Avviare un video non ancora caricato non risulta possibile!');
      loadQueue = [1];
      console.info('FoxPlayer V1 > Avvio aggiunto alla queue');
    }
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
    document.getElementById('foxplayer-buttons-full').innerHTML = icons.full;
    document.getElementById('foxplayer-buttons-full').onclick = function() { video.fullscreen(); };
    fullscreen = true;
  }
});

player.addEventListener('play', function() {
  if (loadQueue != '') {
    loadQueue = '';
  }

  document.getElementById('foxplayer-middleelement').style.display = "none";
  play = true;
  document.getElementById('foxplayer-buttons-duration').max = videoDuration;
  document.getElementById('foxplayer-buttons-duration').value = player.currentTime;
  mainEventsGo();
 });

player.addEventListener('pause', function() {
  play = false; 
});

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

function mainEventsGo() {
  player.addEventListener('timeupdate', function() {
    document.getElementById('foxplayer-buttons-duration').value = player.currentTime;
    document.getElementById('foxplayer-buttons-duration').max = player.duration;
    var temp = toAcceptableData(player.currentTime);
    document.getElementById('foxplayer-buttons-timeLabel').innerHTML = (temp.hours + temp.minutes).replace('00', '') + ':' + temp.seconds;
  });

  player.addEventListener('ended', function() {
    document.getElementById('foxplayer-buttons-duration').value = document.getElementById('foxplayer-buttons-duration').value + 1;
    document.getElementById('foxplayer-buttons-play').innerHTML = icons.play;
    document.getElementById('foxplayer-buttons-play').onclick = function() { video.play(); };
  });

  document.getElementsByClassName('foxPlayer')[0].addEventListener('mouseenter', function() {
    document.getElementById('foxplayerControls').style.display = "block";
  });

  document.getElementsByClassName('foxPlayer')[0].addEventListener('mouseout', function() {
    document.getElementById('foxplayerControls').style.display = "none";
  });

  document.getElementById('foxplayerControls').addEventListener('mouseenter', function() {  
    document.getElementById('foxplayerControls').style.display = "block";
  });
}

// Eventi esterni
player.addEventListener('progress', function() {
  if (document.getElementById('foxplayer-middleelement')) {
    document.getElementById('foxplayer-middleelement').innerHTML = '<i class="fa-solid fa-spinner"></i>';
    document.getElementById('foxplayer-middleelement').classList = 'w3-spin w3-display-middle';
  }
});

player.addEventListener('canplay', function() {
  if (loadQueue != '') {
    loadQueue = '';
    console.info('FoxPlayer V1 - Video avviato da un event nella queue');

    player.play()
      .then(() => {
        document.getElementById('foxplayer-buttons-play').innerHTML = icons.pause;
        document.getElementById('foxplayer-buttons-play').onclick = function() { video.pause(); };
      })
      .catch((e) => {
        console.error('FoxPlayer V1 > Errore durante l`avvio del video da queue: ' + e);
      });
  }

  canPlay = true;
  if (navigator.userAgent.toLowerCase().indexOf('firefox') > -1) {
    URL.revokeObjectURL(player.src);
  console.info('FoxPlayer V1 - CanPlayEvent ricevuto, il video può essere riprodotto | BLOB URL revocato con successo!');
  } else {
    console.warn('FoxPlayer V1 - Rimozione dell`URL (blob) non possibile a causa del browser, provvedo a lasciare un trigger');
  }
  if (document.getElementById('foxplayer-middleelement')) {
    document.getElementById('foxplayer-middleelement').style.display = "none";
  }
});

if (navigator.userAgent.toLowerCase().indexOf('firefox') > -1) {
  // Non è firefox
  player.addEventListener('loadeddata', function() {
    URL.revokeObjectURL(player.src);
    console.info('FoxPlayer V1 - Rimozione dell`URL (blob) richiamata da un trigger precedente completato!');
  });
}

player.addEventListener('waiting', function() {
  if (document.getElementById('foxplayer-middleelement')) {
    document.getElementById('foxplayer-middleelement').innerHTML = '<i class="fa-solid fa-spinner"></i>';
  }
});

player.addEventListener('click', function() {
  if (play) {
    video.pause();
  } else {
    video.play();
  }
});
