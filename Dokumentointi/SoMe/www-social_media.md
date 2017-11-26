## WWW-Sosiaalinen Media VM

### Verkkoasetukset

###### Vaihe 1:

VirtualBox:iin tehdään seuraavat muutokset:

![www_some_virtualbox_step1](https://user-images.githubusercontent.com/16650292/32946671-26986f1c-cba1-11e7-8c64-d16a3c5ceab4.png)

###### Vaihe 2:

Suorita seuraavat komennot:

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

### WWW-palvelut (Kotisivut)

SoMe-palvelin vastaa harjoitusympäristössä sosiaalisen median roolista. Palvelimella on omat kotisivut, joiden kautta käyttäjä näkee uusimmat uutiset ja ajankohtaiset päivitykset. Sivun kautta käyttäjä pääsee myös foorumille, jolla simuloidaan harjoitusmaailman SoMea.

###### Vaihe 1:

Suorita komennot: 

```
rm /var/www/html/index.html
touch /var/www/html/index.html
touc /var/www/html/style.css
```

###### Vaihe 2:

Suorita komento: ```nano /var/www/html/index.html``` , lisää seuraavat tiedot ja tallenna tiedosto:
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
###### Vaihe 3:

Suorita komento: ```nano /var/www/html/style.css``` , lisää seuraavat tiedot ja tallenna tiedosto:
```
p{ line-height: 1em; }
h1, h2, h3, h4{
    color: orange;
	font-weight: normal;
	line-height: 1.1em;
	margin: 0 0 .5em 0;
}
h1{ font-size: 1.7em; }
h2{ font-size: 1.5em; }
a{
	color: black;
	text-decoration: none;
}
	a:hover,
	a:active{ text-decoration: underline; }
body{
    font-family: arial; font-size: 80%; line-height: 1.2em; width: 100%; margin: 0; background: #eee;
}
#page{ margin: 20px; }
#logo{
	width: 35%;
	margin-top: 5px;
	font-family: georgia;
	display: inline-block;
}
#nav{
	width: 60%;
	display: inline-block;
	text-align: right;
	float: right;
}
	#nav ul{}
		#nav ul li{
			display: inline-block;
			height: 62px;
		}
			#nav ul li a{
				padding: 20px;
				background: orange;
				color: white;
			}
			#nav ul li a:hover{
				background-color: #ffb424;
				box-shadow: 0px 1px 1px #666;
			}
			#nav ul li a:active{ background-color: #ff8f00; }
#content{
	margin: 30px 0;
	background: white;
	padding: 20px;
	clear: both;
}
#footer{
	border-bottom: 1px #ccc solid;
	margin-bottom: 10px;
}
	#footer p{
		text-align: right;
		text-transform: uppercase;
		font-size: 80%;
		color: grey;
	}

#content,
ul li a{ box-shadow: 0px 1px 1px #999; }
```
###### Vaihe 4:

Suorita komento: ```service apache2 restart```

###### Vaihe 5:

Selaamalla osoitteeseen www.some.fi, nähdään että verkkosivut toimivat:


![www_verification_some](https://user-images.githubusercontent.com/16650292/32954546-148b4176-cbbc-11e7-9a81-8deef7ddd483.png)


## WWW-palvelut (phpBB3-foorumi)

### Huomioitavaa! 

Vaiheen 1 suorittamiseksi on virtuaalikoneen verkkoasetuksia muutettava hetkellisesti.

Suorita komento ```sudo nano /etc/network/interfaces``` ja muokkaa tiedostoa:

Ennen:
	
	auto enp0s3 inet static

Jälkeen:

	auto enp0s3 inet dhcp
	

Muutosten jälkeen tallenna tiedosto ja sammuta virtuaalikone. Virtuaalikoneen sammuttua muuta virtuaalikoneen VirtualBox:in adapteri seuraavasti:

![some_virtualbox_adapter](https://user-images.githubusercontent.com/16650292/33211337-c46d9796-d126-11e7-864d-651a9958b758.png)

Käynnistämällä virtuaalikoneen uudelleen voit siirtyä vaiheeseen 1.


###### Vaihe 1:

Suoritetaan seuraavat komennot:

```
apt-get update && apt-get upgrade -y
apt-get install php-xml
cd /opt
wget --no-check-certificate https://download.phpbb.com/pub/release/3.2/3.2.1/phpBB-3.2.1.zip
unzip phpBB-3.1.2.zip
cp -R phpBB3/* /var/www/html/
```

Komentojen suorittamisen jälkeen palaa muuttamaan "Huomioitavaa!"-kohdassa tehdyt verkkoasetukset takaisin harjoitusympäristöön. (Tarvittaessa löydät ohjeet tämän dokumentin alusta "Verkkoasetukset"-kappaleesta.)

###### Vaihe 2:

Suoritetaan oikeuksien muuttaminen komennoilla:

```
cd /var/www/html/
for files in config.php cache files store images/avatars/upload/; do chmod 777 $files; done
```

###### Vaihe 3:

Aloitetaan MySQL-tietokannan luominen komennolla:

```
mysql -u root -p
```

, jonka jälkeen syötetään seuraavat tiedot:

	mysql> CREATE DATABASE foorumi;

	mysql> GRANT ALL PRIVILEGES on foorumi.* TO 'user'@'localhost' IDENTIFIED BY 'user66';

	mysql> FLUSH PRIVILEGES;

	mysql> quit;
	

###### Vaihe 4:

Selaa osoitteeseen www.some.fi/index.php Lubuntu työasemalla ja paina "INSTALL" välilehteä, jonka jälkeen voit aloittaa phpBB3-foorumin asennuksen painamalla "Install". Seuraamalla kuvakaappauksien ohjeita voidaan phpBB3-foorumin asennus harjoitusympäristöön suorittaa onnistuneesti.

![phpbb_install_1](https://user-images.githubusercontent.com/16650292/33239183-29ac2daa-d2a5-11e7-8adc-bfa66b8e43c3.png)

![phpbb_install_2](https://user-images.githubusercontent.com/16650292/33239184-29c9f434-d2a5-11e7-9ca6-12aaa2148ef6.png)

![phpbb_install_3](https://user-images.githubusercontent.com/16650292/33239185-29e4ee9c-d2a5-11e7-911e-5aa4db2adc51.png)

![phpbb_install_4](https://user-images.githubusercontent.com/16650292/33239186-29ff674a-d2a5-11e7-9b3e-7a0425ff98e8.png)

![phpbb_install_5](https://user-images.githubusercontent.com/16650292/33239187-2a19ddc8-d2a5-11e7-9bb7-6c4f6fb5ee75.png)

![phpbb_install_6](https://user-images.githubusercontent.com/16650292/33239188-2a34fc0c-d2a5-11e7-9dcb-63953bb45c2b.png)

![phpbb_install_7](https://user-images.githubusercontent.com/16650292/33239189-2a4e8078-d2a5-11e7-9fa6-791a0ab3ca03.png)

###### Vaihe 5:

phpBB3-foorumin asennustiedoston poistaminen ja palvelimen uudelleenkäynnistys komennoilla:

```
rm -rf /var/www/html/install
service apache2 restart
```

Nyt phpBB3-foorumi on onnistuneesti asennettu palvelimelle.

### Sertifikaatin ”SoMe Oy” (SoMe) käyttöönotto

###### Vaihe 1:

Suorita komento: ```scp user@195.20.4.10:/usr/lib/ssl/misc/some/newcert.pem polku_minne_tuodaan_newcert.pem```

###### Vaihe 2:

Suorita komento: ```scp user@195.20.4.10:/usr/lib/ssl/misc/some/newkey.pem polku_minne_tuodaan_newkey.pem```

###### Vaihe 3:

Suorita komennot (ei välttämätöntä, jos default_ssl jo luotu): 

```
a2enmod ssl
a2ensite default-ssl
service apache2 restart
```

###### Vaihe 4:

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
                ServerName 31.7.16.10
                Redirect permanent / https://www.some.fi/
        </VirtualHost>
        
###### Vaihe 5:

Suorita komento: ```nano /etc/apache2/sites-enabled/default-ssl.conf``` ja muuta seuraavat tiedot tiedostoon ja tallenna muutokset:

        Ennen:
                        SSLCertificateFile      /alkuperäinen/polku
                        SSLCertificateKeyFile   /alkuperäinen/polku
        
        Jälkeen:
                        SSLCertificateFile      polku_minne_tuodaan_newcert.pem
                        SSLCertificateKeyFile   polku_minne_tuodaan_newkey.pem   


###### Vaihe 6:

Suorita komento: ```service apache2 restart```

###### Vaihe 7:

Tarkista, että Apache on päällä suorittamalla komento: ```service apache2 status```

###### Vaihe 8:

![ca_verification_some](https://user-images.githubusercontent.com/16650292/32953655-8eebc092-cbb9-11e7-8cb3-73309d2d4053.png)


Nyt varmenneorganisaation allekirjoittama sertifikaatti on otettu onnistuneesti käyttöön.

### Huomioitavaa

Jos tiedostossa **default-ssl.conf** rivi **SSLEngine on** on kommentoitu, poista kommentointi.

