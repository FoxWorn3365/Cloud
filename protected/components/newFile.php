<?php

$bb = str_replace("%20", " ", $bb);
?>
<br>
 <h1>Crea un file</h1>
 <br><br>
 Stai creando il file <code><?= $bb; ?><span id='next'></span><span id='est'></span></code></b>
 <br><br>
 <div id='form'>
  <div id='in'>
    Nome del file:<br>
    <input type='text' name='nome' id='filename'>
    <select name="exte" class='ex-select'>
     <option value="txt">.txt</option>
     <option value="md">.md</option>
     <option value="fox">.fox</option>
    </select><br>
    <br><br>
    Scrivi qualcosa nel tuo file:<br>
    <textarea name='content' id='content'></textarea><br>
    <button class="w3-button w3-orange w3-text-white" onclick='sendForm()'>Crea!</button>
  </div>
 </div>
 <div id='load' style='display: none;'>
  <br><i id='spinner' class="fa-solid fa-spinner w3-spin" style='font-size: 100px'></i><br><br>
  <span id='stext'>Stiamo sistemando la tua opera nel cloud...</span><br><br>
  <center><button id='btn' class='w3-center w3-button w3-orange w3-text-white' onclick='redi()'>Torna indietro</button></center>
 </div>
 <br><br><br>
 <script>
 document.getElementById('filename').addEventListener('input', () => { document.getElementById('next').innerHTML = document.getElementById('filename').value;});
 document.getElementById('est').innerHTML = ".txt";

 const selectElement = document.querySelector('.ex-select')

 selectElement.addEventListener('change', (event) => {
   document.getElementById('est').innerHTML = "." + event.target.value;
 });
 </script>
 <div id='test' style='display: none'></div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 <script>
 function sendForm(){
    document.getElementById('form').style.display = "none";
    document.getElementById('load').style.display = "block";

    var file = document.getElementById('filename').value;
    var ext = document.getElementById('est').innerHTML;
    var content = document.getElementById('content').value;
    var filename = file+ext;
    $.ajax({
        type:"post",
        url:"/createFile",
        data: 
        {  
           'file' :filename,
           'dir' :'<?= $bb; ?>',
           'content' :content
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