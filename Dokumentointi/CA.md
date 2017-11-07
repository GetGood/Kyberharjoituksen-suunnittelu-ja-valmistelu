#### Harjoitusympäristön varmennusorganisaatio ”CyberCerts Certificate Authority” (CA) 

###### Virtuaalikone DNS – CA – NTP (Debian):

1. Suorita **sudo apt-get update** // ei välttämätön, jos päivitykset on jo asennettu

2. Suorita sudo apt-get install openssl // ei välttämätön, jos paketti on jo asennettu

3. Seuraavaksi, mene tiedostoon jonne haluat luoda CA:n

4. Seuraavaksi, suorita komento /usr/lib/ssl/misc/CA.pl -newca (tarvittaessa sudo/root) ja täytä kysytyt kohdat seuraavalla tavalla:

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

5. Edellinen komento luo kansion "demoCA", joka sisältää "cacert.pem"-sertifikaattitiedoston


#### Luodaan sertifikaatti "DataCenter Oy" ja allekirjoitetaan sertifikaatti varmenneorganisaatiolla ”CyberCerts Certificate Authority”

###### Virtuaalikone DNS – CA – NTP (Debian):

1. Suorita komento /usr/lib/ssl/misc/CA.pl -newreq (tarvittaessa sudo/root) ja täytä kysytyt kohdat seuraavalla tavalla:

        a. ”Enter PEM pass phrase”: user66

        b. ”Verifying – Enter PEM pass phrase”: user66

        c. ”Country Name (2 letter code) [AU]”: FI

        d. ”State or Province Name (full name) [Some-State]”: Uusimaa

        e. ”Locality Name (eg, city) []”: Kotka

        f. ”Organization Name (eg, company) [Internet Widgits Pty Ltd]: DataCenter Oy

        g. ”Organizational Unit Name (eg, section) []”: DataCenter Oy

        h. ”Common Name (eg, server FQDN or Your name []”: 10.0.0.1

        i. ”Email Address []”: datacenter@datacenter.fi

        j. ”A challenge password []: Paina Enter

        k. ”An optional company name []: 89.250.48.10


6. Edellinen komento luo tiedostot "newreq.pem" (pyyntö) ja n"ewkey.pem" (avain)

7. Pyyntö voidaan allekirjoittaa CA:lla käytäen komentoa /usr/lib/ssl/misc/CA.pl -sign

        ”Enter pass pharase for ./demoCA/private/cakey.pem”: user66

        ”Sign the certificate [y/n]”: y

        ”1 out of 1 certificate request certified, commit? [y/n]”: y

11. Edellinen komento luo ”newcert.pem”-sertifikaattitiedoston
