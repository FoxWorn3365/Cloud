# FoxCloud - Versione 1.9
**FoxCloud** è un cloud creato in PHP che ti permette di gestire i tuoi file online.<br>

![Immagine di presentazione](https://i.imgur.com/IjGXDWS.png)

Ecco i punti di forza di **FoxCloud**:

### Interfaccia user-friendly e semplice da usare
Grazie alla sua interfaccia estremamente semplice ed ovviamente al restyling che ha caratterizzato<br>questa versione è veramente facile e veloce da usare dove vuoi.<br>
Inoltre, grazie al supporto dei plugin puoi integrare molte funzionalità aggiuntive senza toccare il codice sorgente!<br>

### Player personalizzato ed ottimizzato
Un'altra cosa importante è stata l'ascesa di **FoxPlayer**, un player personalizzato di FoxCloud che va a sostituire quello default dei vostri browser.<br>
FoxPlayer è user-friendly, semplice da usare ed esteticamente allineato al resto del cloud.

![FoxPlayer](https://i.imgur.com/ydDC2IH.png)

### Sicurezza incredibile
**FoxCloud** rispetta tutti gli standard di sicurezza delle WebApp PHP in quanto non usa `eval()` oppure altre funzioni che permettono l'esecuzione di codice remoto.<br>
Inoltre questo Cloud adopera dei filtri per evitare Code Injection in file e quindi mettere in pericolo l'intero Cloud.<br>
Altro fattore che fa aumentare la sicurezza di **FoxCloud** è l'introduzione degli url `blob` per il caricamento dei video nelle pagine shared.<br>

## Link utili
-  [Documentazione ufficiale](https://github.com/FoxWorn3365/Cloud/wiki/v1.7)   *Sì è quella della versione precedente perché tecnicamente parlando non è cambiato molto*
-  [Sito ufficiale](https://foxcloud.fcosma.it/)
-  [Plugins per FoxCloud](https://github.com/FoxWorn3365/Cloud/blob/v1.9/plugins.md)

## Pacchetti aggiuntivi usati
[**Parsedown**](https://github.com/erusev/parsedown) by [`erusev`](https://github.com/erusev) per il markdown ai file `.md`<br>
[**FoxPlayer**](https://github.com/FoxWorn3365/FoxPlayer) by [`FoxWorn3365`](https://github.com/FoxWorn3365) *custom* per la gestione dei video.

## FoxCloud World
**FoxCloudWorld** è un servizio online offerto e gestito dalla .FoxOrg che ha come scopo quello di migliorare l'assistenza tra l'Org e gli utilizzatori di FoxCloud ed anche statistiche.<br>
Ricordiamo che non raccogliamo nessuna informazione se non l'hostname e la versione.<br>

[Per saperne di più / disattivarlo](https://github.com/FoxWorn3365/Cloud/blob/v1.9/protected/config/FoxCloudWorld_INFO.md)

## Gli url `blob`
FoxCloud usa un sistema di `url blob` per la condivisione di contenuti multimediali senza mostrare l'URL di origine.<br>
Al momento risultano facoltativi per gli utilizzatori del cloud con un account mentre sono già stati implementati come standard obbligatorio per i contenuti shared ma nonostante questo è sempre possibile disattivare questa funzione andando a modificare il file `foxplayer.js`:
```js
let fullscreen = false;
const useBlob = true;  // ANDIAMO A MODIFICARE QUESTO VALORE
```

## Cosa è cambiato
### Aggiunte
- Aggiunti gli url `blob`
- Aggiunte impostazioni relative a FoxPlayer
- Aggiunto un **Integrity Checker** per controllare l'integrità del Cloud
### Bug fix
- Ottimizzato FoxPlayer, rimuovendo bug dovuti al codice nativo

## Contattami
Puoi scrivermi quando vuoi via Email e Discord:
- Discord: `FoxWorn#0001`
- Email: `foxworn3365@gmail.com`


`FoxCloud@v1.9 - 21/11/2022 by FoxWorn3365`

&copy; 2021 - 2022 [.FoxOrg](https://foxorg.fcosma.it/)
