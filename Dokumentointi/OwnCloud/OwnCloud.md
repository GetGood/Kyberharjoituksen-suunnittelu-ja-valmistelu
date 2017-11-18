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

Tehdään verkkosivut komennolla ```nano /var/www/html/index.html``` ja tallennetaan tiedosto muutoksien jälkeen:

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
          <li><a href="palaute.php">Jätä palautetta</a></li>
        </ul>
      </nav>
    <section>
      <article>
        <h1>Tietoa yrityksestä</h1>
        <h2>Palvelut</h2>
                        <ul>
                                <li>Tallennustilaa pilvestä
                                <li>Mahtavaa asiakaspalvelua
                                <li>Luotettavaa tietoturvaa tärkeimille tiedoillesi!
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

Tehdään verkkosivuille tyylitiedosto komennolla ```nano /var/www/html/style.css``` ja tallennetaan tiedosto muutoksien jälkeen:

```
*
{margin: 0px;}

body
{ font: normal .80em trebuchet ms, sans-serif;
  background: #CBEBF4;
  color: #5D5D5D;}

p
{ padding-bottom: 20px;
  line-height: 1.7em;}

h1, h2, h3
{ font: normal 175% 'century gothic', arial, sans-serif;
  color: #666;
  margin-bottom: 14px;
  padding: 10px 0 5px 0;}

h2
{ font: normal 150% 'century gothic', arial, sans-serif;
  color: #58D0F2;}

h3
{ font: normal 140% 'century gothic', arial, sans-serif;}

a
{ color: #58D0F2;}

a:hover
{
  text-decoration: none;
  color: #A4AA04;}

header, nav, section, footer
{ margin-left: auto; 
  margin-right: auto;}

header
{ width: 860px;
  position: relative;
  height: 180px;}

header h1, header h2
{ font: normal 300% "century gothic", arial, sans-serif;}

header h1
{ padding-top:24px;
  margin:0;
  color: #FFF;}

header h2
{ font-size: 120%;
  padding-top: 5px;
  color: #666;}

header h1, header h1 a, header h1 a:hover 
{ padding-top:20px;
  color: #FFF;
  text-decoration: none;}

header h1 a .headervari
{ color: #888;}

header a:hover .headervari
{ color: #FFF;}

nav
{ 
  width: 880px;
  height: 36px;
  position: relative;
}

nav ul
{ float: right;
  margin: 0;
  padding: 0;}

nav ul li
{ float: left;
  padding: 0px;
  list-style: none;
  margin: 5px 2px 0 0;}

nav ul li a
{ 
font: normal 100% 'trebuchet ms', sans-serif;
  float: left; 
  height: 20px;
  padding: 6px 20px 5px 20px;
  text-align: center;
  color: #FFF;
  text-decoration: none;
  background: #99CFDE;} 

nav ul li.selected a, ul nav li.selected a:hover
{ background: #FFF;
  color: #666;}

nav ul li a:hover
{ color: #666;}

section
{ width: 858px;
  margin: 0 auto 0 auto;
  padding: 10px 20px 20px 20px;
  background: #E3F5FB;
  border: 15px solid #FFF;} 

aside
{ float: right;
  width: 190px;
  padding: 0 15px 20px 0;}

aside ul
{ width: 178px; 
  padding-top: 5px; 
  margin: 4px 0 30px 0;}

aside li
{  list-style-type: circle;
  padding: 0 0 7px 0; }

aside li a
{ 
padding-top: 5px;
  display: block;
 
}

article
{ text-align: left;
  width: 513px;
  padding: 0;}

footer
{ width: 916px;
  font-family: sans-serif;
  font-size: 90%;
  height: 28px;
  padding: 20px 0 5px 0;
  text-align: center; 
  
  color: #111;
  text-transform: uppercase;
  letter-spacing: 0.1em;}

footer a, footer a:hover
{ color: #111;
  text-decoration: underline;}

footer a:hover
{ text-decoration: none;}

footer p
{ line-height: 30px;
  padding: 0;}
```

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
