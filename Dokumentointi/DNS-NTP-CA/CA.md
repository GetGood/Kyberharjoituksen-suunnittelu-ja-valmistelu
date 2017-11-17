### Varmennusorganisaation ”CyberCerts Certificate Authority” (CA) luominen

###### Virtuaalikone DNS–CA–NTP (Debian):

###### Vaihe 1:

Suorita komennot (ei välttämätön, jos paketti ja päivitykset on jo asennettu): 

```
sudo apt-get update
sudo apt-get install openssl
```

###### Vaihe 2:

Seuraavaksi, mene tiedostoon johon haluat luoda CA:n ja suorita komento: ```/usr/lib/ssl/misc/CA.pl -newca``` (tarvittaessa sudo/root) ja täytä kysytyt kohdat seuraavalla tavalla:


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
        

Edellinen komento luo kansion **demoCA**, joka sisältää **cacert.pem**-sertifikaattitiedoston


### Sertifikaatin "DataCenter Oy" (pfSense) luominen ja allekirjoitus varmenneorganisaatiolla ”CyberCerts Certificate Authority”

###### Vaihe 1:

Suorita komento: ```/usr/lib/ssl/misc/CA.pl -newreq``` (tarvittaessa sudo/root) ja täytä kysytyt kohdat seuraavalla tavalla:

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

        ”An optional company name []: Paina Enter


Edellinen komento luo tiedostot **newreq.pem** (pyyntö) ja **newkey.pem** (avain)

###### Vaihe 2:

Pyyntö voidaan allekirjoittaa CA:lla käytäen komentoa: ```/usr/lib/ssl/misc/CA.pl -sign```

        ”Enter pass pharase for ./demoCA/private/cakey.pem”: user66

        ”Sign the certificate [y/n]”: y

        ”1 out of 1 certificate request certified, commit? [y/n]”: y

Edellinen komento luo **newcert.pem**-sertifikaattitiedoston

### Sertifikaatin "DataCenter Oy" (OwnCloud) luominen ja allekirjoitus varmenneorganisaatiolla ”CyberCerts Certificate Authority”

###### Vaihe 1:

Suorita komento: ```/usr/lib/ssl/misc/CA.pl -newreq```(tarvittaessa sudo/root) ja täytä kysytyt kohdat seuraavalla tavalla:

        ”Enter PEM pass phrase”: user66

        ”Verifying – Enter PEM pass phrase”: user66

        ”Country Name (2 letter code) [AU]”: FI

        ”State or Province Name (full name) [Some-State]”: Uusimaa

        ”Locality Name (eg, city) []”: Helsinki
        
        ”Organization Name (eg, company) [Internet Widgits Pty Ltd]: DataCenter Oy

        ”Organizational Unit Name (eg, section) []”: DataCenter Oy

        ”Common Name (eg, server FQDN or Your name []”: 89.x.x.x

        ”Email Address []”: datacenter@datacenter.fi

        ”A challenge password []: Paina Enter

        ”An optional company name []: Paina Enter


Edellinen komento luo tiedostot **newreq.pem** (pyyntö) ja **newkey.pem** (avain)

###### Vaihe 2:

Pyyntö voidaan allekirjoittaa CA:lla käytäen komentoa ```/usr/lib/ssl/misc/CA.pl -sign```

        ”Enter pass pharase for ./demoCA/private/cakey.pem”: user66

        ”Sign the certificate [y/n]”: y

        ”1 out of 1 certificate request certified, commit? [y/n]”: y

Edellinen komento luo **newcert.pem**-sertifikaattitiedoston

### Sertifikaatin "SoMe Oy" (SoMe) luominen ja allekirjoitus varmenneorganisaatiolla ”CyberCerts Certificate Authority”

###### Vaihe 1:

Suorita komento: ```/usr/lib/ssl/misc/CA.pl -newreq```(tarvittaessa sudo/root) ja täytä kysytyt kohdat seuraavalla tavalla:

        ”Enter PEM pass phrase”: user66

        ”Verifying – Enter PEM pass phrase”: user66

        ”Country Name (2 letter code) [AU]”: FI

        ”State or Province Name (full name) [Some-State]”: Uusimaa

        ”Locality Name (eg, city) []”: Vantaa
        
        ”Organization Name (eg, company) [Internet Widgits Pty Ltd]: SoMe Oy

        ”Organizational Unit Name (eg, section) []”: SoMe Oy

        ”Common Name (eg, server FQDN or Your name []”: www.some.fi

        ”Email Address []”: some@some.fi

        ”A challenge password []: Paina Enter

        ”An optional company name []: Paina Enter


Edellinen komento luo tiedostot **newreq.pem** (pyyntö) ja **newkey.pem** (avain)

###### Vaihe 2:

Pyyntö voidaan allekirjoittaa CA:lla käytäen komentoa ```/usr/lib/ssl/misc/CA.pl -sign```

        ”Enter pass pharase for ./demoCA/private/cakey.pem”: user66

        ”Sign the certificate [y/n]”: y

        ”1 out of 1 certificate request certified, commit? [y/n]”: y

Edellinen komento luo **newcert.pem**-sertifikaattitiedoston

