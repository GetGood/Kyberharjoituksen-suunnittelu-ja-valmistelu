Palaute exploit

Perustuu datacentterin palautefoorumeilla piilevään haavoittuvuuteen. Foorumeille lähetetyt viestit tallennetaan tekstitiedostoihin
omaan alikansioonsa. Viestit luetaan näytölle käyttämällä php:n include -funktiota. Jos viestin sisällä on merkkejä, jotka php tulkitsee
ohjelmakoodiksi, niin kyseinen ohjelmakoodi suoritetaan. Esimerkiksi jos tiedosto sisältää merkit 
```
<?php echo 1+1; ?>
```
tulostuu sivulle numero 2. Palaute_exploit.py käyttää cURL -työkalua tehdäkseen GET -pyyntöjä, joiden parametreissä on tekstiä, jonka
serveri tulee tulkitsemaan joko html elementiksi tai php koodiksi.
