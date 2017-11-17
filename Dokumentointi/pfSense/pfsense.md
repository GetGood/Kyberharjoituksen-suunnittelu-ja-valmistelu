## PFsense configuration log

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

1. Työasemalla, jolla on yhteys pfSenseen, suorita komento: 
```scp user@DNS-CA-NTP_ip_osoite:polku_mistä_tuodaan_newcert.pem polku_minne_tuodaan_newcert.pem```

2. Työasemalla, jolla on yhteys pfSenseen, suorita komento: 
```scp user@DNS-CA-NTP_ip_osoite:polku_mistä_tuodaan_newkey.pem polku_minne_tuodaan_newkey.pem```

3. Työasemalla, jolla on yhteys pfSenseen, suorita komento: 
```scp user@DNS-CA-NTP_ip_osoite:polku_mistä_tuodaan_cacert.pem polku_minne_tuodaan_cacert.pem```

4. CA:n lisääminen selaimeen (Firefox):

        Avaa Firefox
        Paina "≡"
        Paina "Preferences"
        Paina "Advanced"
        Paina "Certificates"
        Paina "View Certificates"
        Paina "Authorities"
        Paina "Import..."
        Etsi "cacert.pem" (polku_minne_tuodaan_cacert.pem)
        Paina "Open"

5. Selaa selaimella osoitteeseen **10.0.0.1** (pfSense) ja kirjaudu käyttäjätunnuksella: **admin** ja salasanalla: **pfsense**

6. Sertifikaatin lisääminen (pfSense):

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

7. Sertifikaatin käyttöönottaminen (pfSense):

        Paina "≡"
        Paina "System"
        Paina "Advanced"
        "Protocol": HTTPS
        "SSL Certificate": DataCenter Oy
        "Save"

8. Sivustoon **10.0.0.1** (pfSense) voidaan muodostaan nyt varmennettu SSL-yhteys

### Huomioitavaa

Jos avaintiedosto **newkey.pem** ei aukea, voi sen DNS-CA-NTP-virtuaalikoneella aukaista käyttämällä komentoa: 
```openssl rsa -in newkey.pem -out newnewkey.pem``` ja siirtää tämän jälkeen **newnewkey.pem** halutulle virtuaalikoneelle.
