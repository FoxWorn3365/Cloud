# FoxCloud - World
FoxCloudWorld o comunemente chiamato FoxCloud World è un sistema automatico che tiene traccia di tutte le istanza di FoxCloud presenti su Internet

## Scopo di FoxCloudWorld
Lo scopo è pienamente relativo alla statistica ed in futuro potrebbe comportare anche l'inserimento di feedback supportati solo da FoxCloudWorld

## Quali dati raccogliamo
Al momento viene eseguita __una sola richiesta__ ai server di FoxCloudWorld (`https://foxcloud.fcosma.it/api/world/`) che serve per registrare il cloud sulla piattaforma.<br>
L'unico dato che viene condiviso **solo ed esclusivamente con .FoxOrg** è l'hostname (esempio: `pappino.example.com` oppure `banana.example.com`) e la versione con cui è stata eseguita la richiesta.<br>
Verrà, in seguito ad una richiesta di registrazione, recuperato anche il file `/foxworldwrapper.php` direttamente dai nostri server per verificarne la validità ed evitare falsi.

## Come trattiamo i tuoi dati
I tuoi dati sono protetti da una password e sono visibili solo ai membri del team **.FoxOrg**.<br>
Come indicato dalla Normativa Europera sul Trattamento dei Dati Personali online (GDPR) potrai richiedere in qualsiasi momento i dati che possediamo su di te (sulla tua istanza FoxCloud) e richiederne anche l'eliminazione scrivendo un'email a `foxworn3365@gmail.com`.

## Come posso evitare questo
### Se avevo FoxCloudWorld attivo
In questo caso basterà rimuovere il file `foxworldverifycodemain.temp.txt` situato in `protected/sys/` e cambiare la configurazione impostando:
```json
  "foxcloudworld":false
```
### Se non avevo FoxCloudWorld attivo
In questo caso basterà cambiare la configurazione impostando:
```json
  "foxcloudworld":false
```

## Non ho capito abbastanza
Siamo aperti ad ogni eventuale domanda all'indirizzo email `foxworn3365@gmail.com`
