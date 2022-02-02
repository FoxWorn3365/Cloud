<br>
 <h1>Crea una nuova Directory</h1>
 <a href="<?= $_SERVER["HTTP_REFERER"]; ?>"><i class="fa fa-level-up" aria-hidden="true"></i></a>
 <br><hr><br>
 <br>
 <form method="post" action="/newdir">
   <input type="hidden" name="user" value="<?= $pp[0]; ?>">
   <input type="hidden" name="dir" value="<?= $bb; ?>">
   Inserisci il nome: <input type="text" name="nomedelladirectory"><br>
   <br><button class="w3-button w3-green w3-text-white">Crea</button>
 </form>