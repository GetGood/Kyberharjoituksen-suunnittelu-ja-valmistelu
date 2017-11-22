## pfSense VM

### pfSense Konfiguraatio

Asennettiin pfSense 64-bittinen BSD ainoastaan yhdellä sillatulla adapterilla jota käytettiin tarvittavien pakettien asentamiseen
```
Asennettu SNORT ISD paketti pfSense-pkg-snort-3.2.9.5_2
Asennettu darkstat pfSense-pkg-darkstat: 3.1.3_4
```
Ladattiin ja asennettiin seuraavat säännöt Snort IDS:ään
```
Snort GPLv2 Community Rules
Emerging Threats Open Rules
```
Konfiguroitiin Snort antamaan pelkkiä varoituksia. Blue teamin on tehtävä omia päätökisä mitä tehdä varoituksien ilmaantuessa  
Asennettiin darkstat, darkstattia käytetään liikenteen tarkkailuun ulkoverkosta sisäverkkoon

Kun paketit mitkä vaativat internet yhteyttä asentamiseen oli asennettu, vaihdettiin rajapinnat seuraaviksi:  

### interfaces  
```
WAN -> em0 -> v4: 89.250.48.10/24  
Lan -> em1 -> v4: 10.0.0.1/24  
```
WAN on yrityksen julkinen IP osoite ja Lan sisäisen verkon oletusyhdysskäytävä. Sisäverkkoon jaetaan DHCP:llä IP osoitteet sekä DNS palvelin. Sisäverkon IP osoitteiden alue on 10.0.0.20->10.0.0.50. osoitteet 10-20 on varattu staattisesti määritetyille osoitteille
```
DHCP range 10.0.0.20 -> 10.0.0.50. 
Static ip 10.0.0.11 for Owncloud + www-server  
Range 10.0.0.10-20 can be used for other static leases if needed  
```
### Muut asetukset

Ohjattiin portit 80 ja 443 Owncloud- palvelimeen
DNS asetettiin käyttämään palvelinta osoitteesta 190.20.4.10. DHCP jakaa tämän palvelimen sisäverkon koneille. vaihdettiin graafinen web- käyttöliittymä käyttämään SSL-salattua yhteyttä joka sertifikoidaan Datacenter Oy:n sertifikaatilla.


### Verkkoasetukset

###### Vaihe 1:

VirtualBox:iin tehdään seuraavat muutokset:

![pfsense_virtualbox_step1](https://user-images.githubusercontent.com/16650292/32948292-69a430ce-cba7-11e7-9da6-5069244eb3f7.png)

ja

![pfsense_virtualbox_step2](https://user-images.githubusercontent.com/16650292/32948293-69c0c0c2-cba7-11e7-87e8-cc2c75a75f59.png)


### Sertifikaatin ”DataCenter” (pfSense) käyttöönotto

###### Vaihe 1:

Työasemalla, jolla on yhteys pfSenseen, suorita komennot:

```
scp user@195.20.4.10:/usr/lib/ssl/misc/pfsense/newcert.pem polku_minne_tuodaan_newcert.pem
scp user@195.20.4.10:/usr/lib/ssl/misc/pfsense/newkey.pem polku_minne_tuodaan_newkey.pem
```

###### Vaihe 2:

Selaa selaimella osoitteeseen **10.0.0.1** (pfSense) ja kirjaudu käyttäjätunnuksella: **admin** ja salasanalla: **pfsense**

###### Vaihe 3:

Sertifikaatin lisääminen (pfSense):

        Paina "≡"
        Paina "System"
        Paina "Cert. Manager"
        Paina "Certificates"
        Paina "+Add/Sign"
        Valitse "Import an existing Certificate"
        "Descriptive Name": DataCenter Oy
        "Import Certificate": Kopioi ja liitä "newcert.pem"-sertifikaatin tiedot
        "Private key data": Kopioi ja liitä "newkey.pem"-avaimen tiedot
        Paina "Save"
        
###### Vaihe 4:

Sertifikaatin käyttöönottaminen (pfSense):

        Paina "≡"
        Paina "System"
        Paina "Advanced"
        "Protocol": HTTPS
        "SSL Certificate": DataCenter Oy
        "Save"


Sivustoon **10.0.0.1** (pfSense) voidaan muodostaan nyt varmennettu SSL-yhteys

##### Split DNS

Sisäverkosta ei päässyt Owncloud- palvelimeen käyttäen domain nimeä, vaan pfSense antoi varoituksen: 
Potential DNS rebound attack detected.
```
By default, pfSense does not redirect internally connected devices to reach forwarded ports and 1:1 NAT on WAN interfaces. If a client is trying to reach a service on port 80 or 443 (or the port a web interface is using if it has been changed), the connection will hit the web interface and they will be presented with a certificate error if the GUI is running HTTPS, and a DNS rebinding error since it's an unrecognized hostname
```
Tämän korjaamiseksi vaihdoimme: Register DHCP static mappings in DNS forwarder päälle




