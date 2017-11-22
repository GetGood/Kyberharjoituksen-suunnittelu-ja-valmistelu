## WWW-OwnCloud

### OwnCloud 10 asennusohjeet

Tässä ohjeessa kerrotaan kuinka OwnCloud 10 pilvipalvelin on asennettu Debian 9 virtuaalikoneelle.

#### Asennuksen pääkohdat

```
- Järjestelmän päivitys
- LAMP serverin asennus
- OwnCloudin asennus
- OwnCloudin konfigurointi selaimella
```

#### Palveluiden asennus

###### Vaihe 1 (Päivitys):

Suorita komento:

```
apt update && apt upgrade
```

###### Vaihe 2 (LAMP-asennus):

Apache Web Server asennus ja uudelleenkäynnistys komennoilla:
```
apt install apache2
Do you want to continue? [Y/n] Valitse Y
systemctl start apache2
systemctl enable apache2
```

MariaDB Server asennus ja uudelleenkäynnistys komennoilla:
```
apt install mysql-server
Do you want to continue? [Y/n] Valitse Y
systemctl start mariadb
systemctl enable mariadb
```

Tarkistetaan status:
```
systemctl status mariadb
```

Secure MariaDB asennus:
```
mysql_secure_installation
```

Asennetaan PHP, tarkistetaan versio ja määritetään salasana:
```
apt install php php-mysql
root@debian:~# php --version
PHP 7.0.19-1 (cli) (built: May 11 2017 14:04:47) ( NTS )
mysql -u root -p
```

Ja näin LAMP on asennettu Debian 9:lle.

#### OwnCloud asennus

###### Vaihe 1 (OwnCloud asennus):

Suorita komennot:
```
apt install -y apache2 mariadb-server libapache2-mod-php7.0 \
php7.0-gd php7.0-json php7.0-mysql php7.0-curl \
php7.0-intl php7.0-mcrypt php-imagick \
php7.0-zip php7.0-xml php7.0-mbstring
```
Siirrytään kansioon, valitaan OwnCloud versio (ks. www.owncloud.org) ja ladataan .bz2 tiedosto komennoilla:

```
cd /tmp
wget https://download.owncloud.org/community/owncloud-10.0.2.tar.bz2
```

Puretaan tiedosto ja muutetaan oikeudet komennoilla:

```
tar -xvf owncloud-10.0.2.tar.bz2
chown -R www-data:www-data owncloud
```

Siirretään tiedosto:
```
mv owncloud /var/www/html/
```

###### Vaihe 2 (Apache Web Server konfigurointi):

Tehdään uusi tiedosto ```nano /etc/apache2/sites-available/owncloud.conf```, lisätään seuraavat tiedot ja tallennetaan:

```
Alias /owncloud "/var/www/html/owncloud/"

<Directory /var/www/html/owncloud/>
    Options +FollowSymlinks
    AllowOverride All
    
    <IfModule mod_dav.c>
    Dav off
    </IfModule>
    
    SetEnv HOME /var/www/html/owncloud
    SetEnv HTTP_HOME /var/www/html/owncloud
</Directory>
```

Luodaan SymLink:

```
ln -s /etc/apache2/sites-available/owncloud.conf /etc/apache2/sites-enabled/owncloud.conf
```

###### Vaihe 3 (OwnCloud:in konfigurointi selaimen kautta): 

Selaataan OwnCloudin osoitteeseen. http://10.0.0.11/owncloud ja luodaan tunnukset:



###### Vaihe 3 (OwnCloud:in konfigurointi): 

Lisätään domaineja palvelimelle komennolla ```nano /var/www/html/owncloud/config/config.php``` ja tallennetaan tiedosto muutoksien jälkeen:

```
...
...
...
'tusted_domains' =>
array (
    0 => 'www.datacenter.fi','89.250.48.10.','10.0.0.11'
),
...
...
...
```
###### Vaihe 4 (WWW-palveluiden konfigurointi):

Tehdään verkkosivujen etusivu komennolla ```nano /var/www/html/index.html``` ja tallennetaan tiedosto muutoksien jälkeen:

```
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
  <title>Datacenter Oy</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body> 
    <header> 
        <h1><a href="index.html">Data<span class="headervari">Center</span></a></h1>
        <h2>Tietosi turvassa</h2>
     </header>
      <nav>
        <ul>
          <li><a href="index.html">Etusivu</a></li>
          <li><a href="owncloud">Siirry palveluun</a></li>
          <li><a href="palaute.php">JÃ¤tÃ¤ palautetta</a></li>
        </ul>
      </nav>
    <section>
      <article>
        <h1>Tietoa yrityksestÃ¤</h1>
        <h2>Palvelut</h2>
			<ul>
				<li>Tallennustilaa pilvestÃ¤
				<li>Mahtavaa asiakaspalvelua
				<li>Luotettavaa tietoturvaa tÃ¤rkeimille tiedoillesi!
				<li><a href="owncloud">Siirry palveluun</a>
				<p>Yritys on ollut voimassa vuodesta 2016. <br>
					<br><br><br><br><br><br><br><br><br><br><br><br><br>
				</p>
			</ul>
      </article>
    </section>
    <footer>
      <p>Datacenter Oy</p>
    </footer>
</body>
</html>
```

Tehdään verkkosivujen palautesivu komennolla ```nano /var/www/html/palaute.php``` tämän sivun haavoittuvuutta käytetään harjoituksen syötteessä: [palaute]( Kyberharjoituksen-suunnittelu-ja-valmistelu/Dokumentointi/Syotteet/palaute_puppu_ohje.md ) Tiedoston sisältö: [palaute.php](palaute/palaute.php)

tallenna.php ```nano /var/www/html/tallenna.php``` sisällöllä: [tallenna.php](palaute/tallenna.php)

style.css ```nano /var/www/html/style.css``` sisällöllä: [style.css](palaute/style.css)



Selaamalla osoitteeseen www.datacenter(.)fi ja www.datacenter(.)fi/palaute.php nähdään että verkkosivut toimivat:

# KUVIA SIVUISTA TÄHÄN
Lisätään sähköpostipalvelu yritykselle. Tätä sähköpostia käytetään syötteessä: [sahkoposti]( Kyberharjoituksen-suunnittelu-ja-valmistelu/Dokumentointi/Syotteet/email.md ) Ensin luodaan kansio sähköpostille:
```
mkdir /var/www/html/email/datadir

```
Tämän jälkeen kyseiseen email kansioon lisätään seuraavat PHP tiedostot:
index.php ```nano /var/www/html/email/index.php``` sisällöllä: [index.php](email/index.php)  
login.php ```nano /var/www/html/email/login.php``` sisällöllä: [login.php](email/login.php)  
logout.php ```nano /var/www/html/email/logout.php``` sisällöllä: [logout.php](email/logout.php)  
tallenna.php ```nano /var/www/html/email/tallenna.php``` sisällöllä: [tallenna.php](email/tallenna.php)  
style.css ```nano /var/www/html/email/style.css``` sisällöllä: [style.css](email/style.css)  


### Verkkoasetukset

###### Vaihe 1:

VirtualBox:iin tehdään seuraavat muutokset:

![owncloud_virtualbox_step1](https://user-images.githubusercontent.com/16650292/32946843-e13fcc2a-cba1-11e7-9803-77ed4d93879c.png)

WWW-OwnCloud-palvelin saa verkkoasetuksensa DHCP-palvelimelta (pfSense), jolloin verkkoasetukset päivittyvät automaattisesti virtuaalikoneelle, eikä tällöin vaadi manuaalista konfigurointia.

### Sertifikaatin ”DataCenter Oy” (OwnCloud) käyttöönotto

###### Vaihe 1:

Suorita komento: ```scp user@195.20.4.10:/usr/lib/ssl/misc/datacenter/newcert.pem polku_minne_tuodaan_newcert.pem```

###### Vaihe 2:

Suorita komento: ```scp user@195.20.4.10:/usr/lib/ssl/misc/datacenter/newkey.pem polku_minne_tuodaan_newkey.pem```

###### Vaihe 3:

Suorita komennot (ei välttämätöntä, jos default_ssl jo luotu): 

```
a2enmod ssl
a2ensite default-ssl
service apache2 restart
```

###### Vaihe 4:

Suorita komento: ```nano /etc/apache2/apache2.conf``` ja lisää seuraavat tiedot tiedoston loppuun ja tallenna muutokset:

        <VirtualHost 10.0.0.11:80>
                ServerName 10.0.0.11
                Redirect permanent / https://www.datacenter.fi/
        </VirtualHost>
        
        <VirtualHost 89.x.x.x:80>
                ServerName 89.x.x.x
                Redirect permanent / https://www.datacenter.fi/
        </VirtualHost>
        
        <VirtualHost _default_:443>
                ServerName 89.x.x.x
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

![ca_verification](https://user-images.githubusercontent.com/16650292/32949655-54915ca2-cbac-11e7-891b-b2a5c3a4b35b.png)

Nyt varmenneorganisaation allekirjoittama sertifikaatti on otettu onnistuneesti käyttöön.

### Huomioitavaa

Jos tiedostossa **default-ssl.conf** rivi **SSLEngine on** on kommentoitu, poista kommentointi.
