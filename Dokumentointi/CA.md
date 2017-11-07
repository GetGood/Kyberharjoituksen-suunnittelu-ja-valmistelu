#### Harjoitusympäristön varmennusorganisaatio ”CyberCerts Certificate Authority” (CA) 

###### Virtuaalikone DNS – CA – NTP (Debian):

1. Suorita sudo apt-get update // ei välttämätön, jos päivitykset on jo asennettu

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

5. Edellinen komento luo kansion demoCA, joka sisältää cacert.pem tiedoston
