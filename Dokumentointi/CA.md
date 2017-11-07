#### Harjoitusympäristön varmennusorganisaatio ”CyberCerts Certificate Authority” (CA) 

###### Virtuaalikone DNS–CA–NTP (Debian):

1. Suorita *sudo apt-get update* (ei välttämätön, jos päivitykset on jo asennettu)

2. Suorita *sudo apt-get install openssl* (ei välttämätön, jos paketti on jo asennettu)

3. Seuraavaksi, mene tiedostoon johon haluat luoda CA:n

4. Seuraavaksi, suorita komento */usr/lib/ssl/misc/CA.pl -newca* (tarvittaessa sudo/root) ja täytä kysytyt kohdat seuraavalla tavalla:

        ”CA certificate filename (or enter to create)”: Paina Enter

        ”Enter PEM pass phrase”: user66

        ”Verifying – Enter PEM pass phrase”: user66

        ”Country Name (2 letter code) [AU]”: FI

        ”State or Province Name (full name) [Some-State]”: Uusimaa

        ”Locality Name (eg, city) []”: Helsinki

        ”Organization Name (eg, company) [Internet Widgits Pty Ltd]”: CyberCerts Oy

        ”Organizational Unit Name (eg, section) []”: CyberCerts Oy

        ”Common Name (eg, server FQDN or Your name []”: CyberCerts Certification Authority

        ”Email Address []”: cybercerts@cybercerts.fi

        ”A challenge password []”: Paina Enter

        ”An optional company name []”: Paina Enter

        ”Enter pass phrase for ./demoCA/private/cakey.pem”: user66

5. Edellinen komento luo kansion **demoCA**, joka sisältää **cacert.pem**-sertifikaattitiedoston


#### Luodaan sertifikaatti "DataCenter Oy" ja allekirjoitetaan sertifikaatti varmenneorganisaatiolla ”CyberCerts Certificate Authority”

###### Virtuaalikone DNS–CA–NTP (Debian):

1. Suorita komento */usr/lib/ssl/misc/CA.pl -newreq* (tarvittaessa sudo/root) ja täytä kysytyt kohdat seuraavalla tavalla:

        ”Enter PEM pass phrase”: user66

        ”Verifying – Enter PEM pass phrase”: user66

        ”Country Name (2 letter code) [AU]”: FI

        ”State or Province Name (full name) [Some-State]”: Uusimaa

        ”Locality Name (eg, city) []”: Helsinki
        
        ”Organization Name (eg, company) [Internet Widgits Pty Ltd]: DataCenter Oy

        ”Organizational Unit Name (eg, section) []”: DataCenter Oy

        ”Common Name (eg, server FQDN or Your name []”: 10.0.0.1

        ”Email Address []”: datacenter@datacenter.fi

        ”A challenge password []: Paina Enter

        ”An optional company name []: 89.x.x.x


6. Edellinen komento luo tiedostot **newreq.pem** (pyyntö) ja **newkey.pem** (avain)

7. Pyyntö voidaan allekirjoittaa CA:lla käytäen komentoa */usr/lib/ssl/misc/CA.pl -sign*

        ”Enter pass pharase for ./demoCA/private/cakey.pem”: user66

        ”Sign the certificate [y/n]”: y

        ”1 out of 1 certificate request certified, commit? [y/n]”: y

11. Edellinen komento luo **newcert.pem**-sertifikaattitiedoston

### ”DataCenter” sertifikaatin käyttöönotto

###### ws (Debian)

1. Työasemalla, jolla on yhteys pfSenseen, suorita komento *scp user@DNS-CA-NTP_ip_osoite:polku_mistä_tuodaan_newcert.pem polku_minne_tuodaan_newcert.pem*

2. Työasemalla, jolla on yhteys pfSenseen, suorita komento *scp user@DNS-CA-NTP_ip_osoite:polku_mistä_tuodaan_newkey.pem polku_minne_tuodaan_newkey.pem*

3. Työasemalla, jolla on yhteys pfSenseen, suorita komento *scp user@DNS-CA-NTP_ip_osoite:polku_mistä_tuodaan_cacert.pem polku_minne_tuodaan_cacert.pem*

4. CA:n lisääminen selaimeen:

        Avaa Firefox
        Paina "≡"
        Paina "Preferences"
        Paina "Advanced"
        Paina "Certificates"
        Paina "View Certificates"
        Paina "Authorities"
        Paina "Import..."
        Etsi "cacert.pem" (polku_minne_tuodaan)
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

Jos avaintiedostoa **newkey.pem** ei saa auki, voi sen DNS-CA-NTP-virtuaalikoneella aukaista käyttämällä komentoa: *openssl rsa -in ”newkey.pem” -out ”newnewkey.pem”* ja siirtää tämän jälkeen halutulle virtuaalikoneelle.
