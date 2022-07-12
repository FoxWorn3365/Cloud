<?php require_once("protected/components/header.php"); ?>
  <style>
  input {
    color: white;
    background-color: gray;
    border: none;
    width: 50%;
  }
  </style>
  <h1>Crea un nuovo utente</h1>
  <br><br>
  <form method='POST' action='/admin.php?action=createUser'>
   <pre style='background-color: gray; border: solid 6px gray; border-radius: 20px; color: white; text-align: left; position: absolute; left: 15px; width: 50%'>
{
  "username":"<input type='text' name='username'>",
  "nome":"<input type='text' name='nome'>",
  "cognome":"<input type='text' name='cognome'>",
  "email":"<input type='email' name='email'>",
  "diskSpace":"<input type='number' name='disk'>",
  "firstLogin":"<input type='number' value='<?= strtotime("now"); ?>'>",
  "isVisible":"<select name='visible'><option value='true'>true</option><option value='false'>false</option></select>",
  "dir":"<input type='text' name='dir'>"
}
   </pre>
   <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
   <button class='w3-button w3-green w3-text-white'>Crea</button>
  </form>
  
