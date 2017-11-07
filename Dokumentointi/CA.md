#### Luodaan harjoitusympäristöön varmennusorganisaatio ”CyberCerts Certificate Authority” (CA) virtuaalikoneelle DNS – CA – NTP (Debian)

1. Suorita sudo apt-get update // ei välttämätön, jos päivitykset on jo asennettu

2. Suorita sudo apt-get install openssl // ei välttämätön, jos paketti on jo asennettu

3. Seuraavaksi, mene tiedostoon jonne haluat luoda CA:n

4. Seuraavaksi, suorita komento /usr/lib/ssl/misc/CA.pl -newca (tarvittaessa sudo/root) ja täytä kysytyt kohdat seuraavalla taballa:

        a. ”CA certificate filename (or enter to create)”: Paina Enter

        b. ”Enter PEM pass phrase”: ”user66”

        c. ”Verifying – Enter PEM pass phrase”: ”user66”

        d. ”Country Name (2 letter code) [AU]”: ”FI”

        e. ”State or Province Name (full name) [Some-State]”: ”Uusimaa”

        f. ”Locality Name (eg, city) []”: ”Helsinki”

        g. ”Organization Name (eg, company) [Internet Widgits Pty Ltd]”: ”CyberCerts Oy”

        h. ”Organizational Unit Name (eg, section) []”: ”CyberCerts Oy”

        i. ”Common Name (eg, server FQDN or Your name []”: CyberCerts Certification Authority”

        j. ”Email Address []”: ”cybercerts@cybercerts.fi”

        k. ”A challenge password []”: Paina Enter

        l. ”An optional company name []”: Paina Enter

        m. ”Enter pass phrase for ./demoCA/private/cakey.pem”: ”user66”

5. Edellinen komento luo kansion demoCA, joka sisältää cacert.pem tiedoston
