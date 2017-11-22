### Palaute exploit

Perustuu datacentterin palautefoorumeilla piilevään haavoittuvuuteen. Foorumeille lähetetyt viestit tallennetaan tekstitiedostoihin
omaan alikansioonsa. Viestit luetaan näytölle käyttämällä php:n include -funktiota. Jos viestin sisällä on merkkejä, jotka php tulkitsee
ohjelmakoodiksi, niin kyseinen ohjelmakoodi suoritetaan. Esimerkiksi jos tiedosto sisältää merkit 
```
<?php echo 1+1; ?>
```
tulostuu sivulle numero 2. Palaute_exploit.py käyttää cURL -työkalua tehdäkseen GET -pyyntöjä, joiden parametreissä on tekstiä, jonka
serveri tulee tulkitsemaan joko html elementiksi tai php koodiksi. Hyökkäys aloitetaan ajamalla scripti:
```
python palaute_exploit.py
```
Syötteitä laukaistaan kirjoittamalla varmenteeseen "yes" ja painamalla entteriä. Hyökkäyksien näkyvyys ja vakavuus kasvavat ja
viimeinen syöte kirjoittaa sanan "HACKED" punaisella yhtiön etusivuille.

### Puppua

Puppua.py scriptin tarkoitus on helpottaa liikenteen generoimista harjoitusympäristöön. Scripti kirjoittaa jonkin määritellyistä 
kommenteista datacentterin nettisivuille, pingaa datacentterin palomuuria ja hakee kommenttisivun ilman get -parametreja. Tämän jälkeen
sripti vaihtaa host koneen ip -osoitteen joksikin välillä 31.7.16.2-200 ja toistaa edellä mainitut toiminnallisuudet. Scripti on
todettu toimivaksi Lubuntu -työasemalla.

Ajetaan näin:
```
python puppua.py
```

Paranneltavaa:
  * Tee molempiin scripteihin chekki että ollaan oikeassa ympäristössä, hae vaikka dns serveriä ja jos ei palaudu oikea ip niin exit
  * Tee puppugeneraattoriin mac change ominaisuus niin ei ole sama mac kaikilla osoitteilla.
  * Laita puppugeneraattorin ping ja curl suorittamaan random määrän hakuja niin että datacentteriä kohti tuleva datan määrä ei ole joka kerta sama
