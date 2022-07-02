# FoxCloud - Versione 1.0
**FoxCloud** è un cloud completamente in PHP e con qualche pezzo in JS per tenere e gestire i file online.<br>
Di seguito sono illustrate le informazioni importanti:

## Specifiche Tecniche
Versione minima di PHP richiesta: `PHP5`<br>
Versione consigliata di PHP: `PHP7.4 / PHP8.0`<br>
WebServer consigliato: `nginx`

## Installazione
Per installare **FoxCloud** è necessario:
1) Scaricare il repo qua da GitHub (possibilmente l'ultima versione) e caricarlo nel server
2) Scaricare PHP7.4 per NGINX (`php7.4-fpm`) e avviatelo con `sudo service php7.4-fpm start`
3) Utilizzare [questa configurazione di NGINX](https://fcosma.it/FoxCloud/config/nginx/example) per far andare il WebServer

## Configurazione
### Creazione di un utente
Per creare un utente è necessario:
1) Andare nella cartella `protected/users/`
2) Creare una directory con il nome dell'account
3) Creare un file chiamato `userinfo.conf` modificando [questo esempio](https://fcosma.it/FoxCloud/config/user/example)
4) Creare nella directory `protected/disk/` una directory che ha lo stesso nome del valore `dir` in `userinfo.conf`
5) Per impostare una password l'utente dovrà entrare inserendo solo l'username e quindi poi inserire la sua nuova password quando richiesto
### Eliminazione di un utente
Per eliminare l'utente basterà eliminare la sua cartella in `protected/users/`


## **Changelog**
## v1.1
- I file sono visualizzati a tabella finalmente
- La funzione della musica è stata completamente rimossa
- Ora si possono evidenziare i vari file
- Piccola patch ad alcuni file

## v1.0
### Aggiunte
- Aggiunta la possibilità di creare file di testo `.txt`, `.md` e `.fox` direttamente dal cloud
- Aggiunta la possibilità di rinominare file e directory, tramite l'apposito bottone
- Aggiunta la possibilità di spostare file e directory, tramite il bottone per rinominare
- Aggiunta la possibilità di condividere un file anche quando è visualizzato
### Bug Fix
- Sistemato l'allineamento dei file, ora non è più in % ma in px
- Sistemato l'allineamento dei bottoni per gestire il file, per evitarne la sovrapposizione anche da telefono
- Sistemato il file-uploading
### Rimozioni
- Rimossa l'opzione per la Musica


&copy; 2021 - 2022 | FoxCloud | by FoxWorn3365
