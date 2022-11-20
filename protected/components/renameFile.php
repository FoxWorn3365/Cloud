<?php
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

$bb = str_replace("%20", " ", $bb);
?>
<br>
 <h1>Rinomina un File</h1>
 <br><br>
 <b>Stai per rinominare il file</b> <code>/<?= $bb; ?></code></b>
 <br><br>
 <div id='form'>
   <input type="hidden" name="file" id='file' value="<?= $bb; ?>">
   Inserisci il nuovo nome.<br>Non può superare i 32 caratteri!<br><br>
   <input type="text" name="renameFile" id='renameFile' maxlenght="32" value="<?= end(explode('/', $bb)); ?>"><br><br>
   <button class="w3-button w3-orange w3-text-white" onclick='sendForm()'>Modifica il nome</button>
 </div>
 <div id='load' style='display: none'>
   <br>
   <i id='spinner' class="fa-solid fa-spinner w3-spin" style='font-size: 100px'></i><br><br>
   <span id='stext' style='font-size: 25px'>Stiamo rinominando il file...</span>
   <br><br>
   <center><button id='btn' class='w3-center w3-button w3-orange w3-text-white' onclick='redi()'>Torna indietro</button></center>
 </div>
 <br><br><br>
 <br><br>
 <div id='test' style='display: none'></div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 <script>
 function sendForm(){
    document.getElementById('form').style.display = "none";
    document.getElementById('load').style.display = "block";

    var filename = document.getElementById('renameFile').value;
    var content = document.getElementById('file').value;
    $.ajax({
        type:"post",
        url:"/renameFile",
        data: 
        {  
           'file' :filename,
           'dir' :'<?= $bb; ?>'
        },
        cache:false,
        success: function (html) 
        {
           $('#test').html(html);
           setPopup();
        }
    });
    return false;
 }

 function setPopup() {
   var dev = JSON.parse(document.getElementById('test').innerHTML);
   if (document.getElementById('test').innerHTML != "") {
     if (dev.status == 200) {
        document.getElementById('spinner').className = "fa-solid fa-square-check";
        document.getElementById('stext').style.color = "green";
        document.getElementById('stext').innerHTML = "Fatto!";
        document.getElementById('btn').style.display = "block";
     } else if (dev.status == 400) {
        window.replace("https://cloud.fcosma.it/login");
     } else if (dev.status == 401) {
        document.getElementById('spinner').className = "fa-solid fa-square-xmark";
        document.getElementById('stext').style.color = "green";
        document.getElementById('stext').innerHTML = "Errore!<br>Il server dice: <code>" + dev.message;
        document.getElementById('btn').style.display = "block";
     } else {
        document.getElementById('spinner').className = "fa-solid fa-question";
        document.getElementById('stext').style.color = "green";
        document.getElementById('stext').innerHTML = "Errore!<br>Il server dice: <code>" + dev.message;
        document.getElementById('btn').style.display = "block";
     }
   } else {
     document.getElementById('spinner').className = "fa-solid fa-question";
     document.getElementById('stext').style.color = "green";
     document.getElementById('stext').innerHTML = "Errore!<br>Il server non ha rilevato errori ma non ha neanche confermato l'operazione!";
     document.getElementById('btn').style.display = "block";
   }
 }

 function redi() {
   window.location.replace("<?= $_SERVER["HTTP_REFERER"]; ?>");
 }
 </script>
