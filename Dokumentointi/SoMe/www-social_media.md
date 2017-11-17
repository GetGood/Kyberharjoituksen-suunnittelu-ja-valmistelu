## WWW-Sosiaalinen media VM

### Verkkoasetukset

###### Vaihe 1:

VirtualBox:iin tehdään seuraavat muutokset:

![www_some_virtualbox_step1](https://user-images.githubusercontent.com/16650292/32946671-26986f1c-cba1-11e7-8c64-d16a3c5ceab4.png)

###### Vaihe 2:

Komentorivilla suorita seuraavat komennot:

```
su
Password: ******
nano /etc/network/interfaces
```

###### Vaihe 3:

Lisää tiedostoon seuraavat tiedot ja tallenna tiedosto muutoksien jälkeen:

```
allow-hotplug enps03
iface enp0s3 inet static
        address 31.7.16.10
        netmask 255.255.255.0
        network 31.7.16.0
        broadcast 31.7.16.255
        gateway 31.7.16.1
        dns-nameservers 195.20.4.10
```

Järjestelmän uudelleenkäynnistyksen jälkeen asetetut verkkoasetukset ovat tulevat voimaan.

### WWW-palvelut

SoMe-palvelin vastaa harjoitusympäristössä sosiaalisen median roolista. Palvelimella on omat kotisivut, joiden kautta käyttäjä näkee uusimmat uutiset ja ajankohtaiset päivitykset. Sivun kautta käyttäjä pääsee myös foorumille, jolla simuloidaan harjoitusmaailman SoMea.

###### Vaihe 1:

Suorita komennot: 

```
rm /var/www/html/index.html
touch /var/www/html/index.html
touc /var/www/html/style.css
```

###### Vaihe 2:

Suorita komento: ```nano /var/www/html/index.html``` ja lisää tiedostoon seuraavat tiedot.
```
<!DOCTYPE html>
<html>
<head>
    <title>Koko Suomen Uutiset</title>
    <link rel="stylesheet" href="style.css" type="text/css" />	
</head>
<body>  
	<div id="page">
		<div id="logo">
			<h1><a href="/" id="logoLink">Koko Suomen Uutiset</a></h1>
		</div>
		<div id="nav">
			<ul>
				<li><a href="index.html">Etusivu</a></li>
				<li><a href="/uutiset.html">Uutiset</a></li>
				<li><a href="/index.php">Foorumi</a></li>
			</ul>	
		</div>
		<div id="content">
			<h2>Tervetuloa</h2>
			<p>
				Olet saapunut Koko Suomen Uutisten sivuille.<br>
                                Taalta loydat Suomen ajankohtaisimmat uutiset!
			</p>
		</div>
		<div id="footer">
			<p>
				Koko Suomen Uutiset <a href="/" target="_blank">[(C) SOME]</a>
			</p>
		</div>
	</div>
</body>
</html>
```


### Sertifikaatin ”SoMe Oy” (SoMe) käyttöönotto

###### Vaihe 1:

Suorita komento: ```scp user@195.20.4.10:/usr/lib/ssl/misc/some/newcert.pem polku_minne_tuodaan_newcert.pem```

###### Vaihe 2:

Suorita komento: ```scp user@195.20.4.10:/usr/lib/ssl/misc/some/newkey.pem polku_minne_tuodaan_newkey.pem```

###### Vaihe 3:

Suorita komento: ```a2enmod ssl``` (ei välttämätön, jos default_ssl jo luotu)

###### Vaihe 4:

Suorita komento: ```a2ensite default-ssl``` (ei välttämätön, jos default_ssl jo luotu)

###### Vaihe 5:

Suorita komento: ```service apache2 restart``` (ei välttämätön, jos default_ssl jo luotu)

###### Vaihe 6:

Suorita komento: ```nano /etc/apache2/apache2.conf``` ja lisää seuraavat tiedot tiedoston loppuun ja tallenna muutokset:

        <VirtualHost 31.7.16.10:80>
                ServerName 31.7.16.10
                Redirect permanent / https://www.some.fi/
        </VirtualHost>
                
        <VirtualHost www.some.fi:80>
                ServerName 31.7.16.10
                Redirect permanent / https://www.some.fi/
        </VirtualHost>
        
        <VirtualHost _default_:443>
                ServerName 89.x.x.x
                Redirect permanent / https://www.some.fi/
        </VirtualHost>
        
###### Vaihe 7:

Suorita komento: ```nano /etc/apache2/sites-enabled/default-ssl.conf``` ja muuta seuraavat tiedot tiedostoon ja tallenna muutokset:

        Ennen:
                        SSLCertificateFile      /alkuperäinen/polku
                        SSLCertificateKeyFile   /alkuperäinen/polku
        
        Jälkeen:
                        SSLCertificateFile      polku_minne_tuodaan_newcert.pem
                        SSLCertificateKeyFile   polku_minne_tuodaan_newkey.pem   


###### Vaihe 8:

Suorita komento: ```service apache2 restart```

###### Vaihe 9:

Tarkista, että Apache on päällä suorittamalla komento: ```service apache2 status```

###### Vaihe 10:

![ca_verification_some](https://user-images.githubusercontent.com/16650292/32953655-8eebc092-cbb9-11e7-8cb3-73309d2d4053.png)


Nyt varmenneorganisaation allekirjoittama sertifikaatti on otettu onnistuneesti käyttöön.

### Huomioitavaa

Jos tiedostossa **default-ssl.conf** rivi **SSLEngine on** on kommentoitu, poista kommentointi.

