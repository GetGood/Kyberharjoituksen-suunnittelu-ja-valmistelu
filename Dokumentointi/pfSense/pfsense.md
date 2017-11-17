## pfSense VM

### Verkkoasetukset

###### Vaihe 1:

VirtualBox:iin tehdään seuraavat muutokset:

![pfsense_virtualbox_step1](https://user-images.githubusercontent.com/16650292/32948292-69a430ce-cba7-11e7-9da6-5069244eb3f7.png)

ja

![pfsense_virtualbox_step2](https://user-images.githubusercontent.com/16650292/32948293-69c0c0c2-cba7-11e7-87e8-cc2c75a75f59.png)

### PFsense configuration log

Started up Pfsense 64 bit BSD with only one bridged interface to install and configure packages needed.
```
Installed SNORT ISD package pfSense-pkg-snort-3.2.9.5_2
Installed Dark stat pfSense-pkg-darkstat: 3.1.3_4
```
Downloaded and updated following rulesets for Snort:
```
Snort GPLv2 Community Rules
Emerging Threats Open Rules
```
Setup Snort for Alerts only. Blue team will have to make own decision as for how to react.  
Installe Darkstat, ~~but this might not be used, as it doesn't support the HTTPS GUI, unless configured for proxy or some other way of getting around the limitation.~~
Dark Stat will be used to monitor network traffic

After updating packets and items that need internet access, switched interfaces to match the exercise topology.  

### interfaces  
```
WAN -> em0 -> v4: 89.250.48.10/24  
Lan -> em1 -> v4: 10.0.0.1/24  
```

The Wan is the public IP for datacenter, Lan is the internal network  
Lan uses DHCP to give addresses and DNS for Datacenter workstations  
```
DHCP range 10.0.0.20 -> 10.0.0.50. 
Static ip 10.0.0.11 for Owncloud + www-server  
Range 10.0.0.10-20 can be used for other static leases if needed  
```
### Other settings  

redirected ports 80 and 443 to www/owncloud  
DNS set to use 190.20.4.10. DHCP will distribute this to datacenter computers  
changed web GUI for HTTPS only  
Certified with Datacenter certificate

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

### Huomioitavaa

Jos avaintiedosto **newkey.pem** ei aukea, voi sen DNS-CA-NTP-virtuaalikoneella aukaista käyttämällä komentoa: 
```openssl rsa -in newkey.pem -out newnewkey.pem``` ja siirtää tämän jälkeen **newnewkey.pem** halutulle virtuaalikoneelle.
