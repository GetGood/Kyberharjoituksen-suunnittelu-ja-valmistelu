## WWW-OwnCloud

### OwnCloud 10 asennusohjeet

Tässä ohjeessa kerrotaan kuinka OwnCloud 10 pilvipalvelin on asennettu Debian 9 pohjalle. Tätä pilvipalvelinta käytetään kyberharjoituksessa.

#### Asennuksen pääkohdat

```
- Järjestelmän päivitys
- LAMP serverin asennus
- Owncloudin asennus
- Owncloudin konfigurointi selaimella
```

#### Asennus

###### Päivitys

```
apt update && apt upgrade
```

###### LAMP-asennus

Asennetaan Apache web server:

```
apt install apache2
Do you want to continue? [Y/n] Valitse Y
```

Apachen käynnistys ja boottaus:

```
systemctl start apache2
systemctl enable apache2
```

MariaDB Server asennus:
```
apt install mysql-server
Do you want to continue? [Y/n] Valitse Y
```

MariaDB:n käynnistys ja boottaus:
```
systemctl start mariadb
```
```
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
Asennetaan PHP:
```
apt install php php-mysql
```
Tarkistetaan versio:
```
root@debian:~# php --version
PHP 7.0.19-1 (cli) (built: May 11 2017 14:04:47) ( NTS )
```
Ja näin LAMP on asennettu Debian 9:lle.
```
mysql -u root -p
```

###### Owncloud asennus

Suorita komennot:
```
apt install -y apache2 mariadb-server libapache2-mod-php7.0 \
php7.0-gd php7.0-json php7.0-mysql php7.0-curl \
php7.0-intl php7.0-mcrypt php-imagick \
php7.0-zip php7.0-xml php7.0-mbstring
```
Valitaan owncloud versio ks. www.owncloud.org ja ladataan .bz2 tiedosto:
```
cd /tmp
wget https://download.owncloud.org/community/owncloud-10.0.2.tar.bz2
```
Puretaan tiedosto ja muutetaan oikudet:
```
tar -xvf owncloud-10.0.2.tar.bz2
chown -R www-data:www-data owncloud
```
Siirretään tiedosto:
```
mv owncloud /var/www/html/
```
Apache Web Server konfigurointi:

Tehdään tiedosto:
```
nano /etc/apache2/sites-available/owncloud.conf
```
Minne laitetaan kyseiset tiedot:
```
alias /owncloud "/var/www/html/owncloud/"
```
nano /var/www/html/owncloud/..

    <Directory /var/www/html/owncloud/>
    Options +FollowSymlinks
    AllowOverride All
    <IfModule mod_dav.c>
    Dav off
    </IfModule>
    SetEnv HOME /var/www/html/owncloud
    SetEnv HTTP_HOME /var/www/html/owncloud
    </Directory>

Luodaan symlink:

```
ln -s /etc/apache2/sites-available/owncloud.conf /etc/apache2/sites-enabled/owncloud.conf
```
Konfiguroidaan owncloud selaimen kautta

Mennään owncloudin osoitteeseen. http://ip.ip.ip.ip/owncloud

Luodaan tunnukset

OwnCloud

Asetetaan lisää domaineja palvelimelle

Index.html muokkaus

Tästä tiedostosta voit muokata datacentterin html sivustoa katso linkki alhaalta.

https://www.digitalocean.com/community/tutorials/how-to-set-up-apache-virtual-hosts-on-debian-8

Luodaan domain

Muokataan oikeuksia

Kopioidaan sivusto uuteen kohteeseen

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

Suorita komento: ```a2enmod ssl``` (ei välttämätön, jos default_ssl jo luotu)

###### Vaihe 4:

Suorita komento: ```a2ensite default-ssl``` (ei välttämätön, jos default_ssl jo luotu)

###### Vaihe 5:

Suorita komento: ```service apache2 restart``` (ei välttämätön, jos default_ssl jo luotu)

###### Vaihe 6:

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

![ca_verification](https://user-images.githubusercontent.com/16650292/32949655-54915ca2-cbac-11e7-891b-b2a5c3a4b35b.png)

Nyt varmenneorganisaation allekirjoittama sertifikaatti on otettu onnistuneesti käyttöön.

### Huomioitavaa

Jos tiedostossa **default-ssl.conf** rivi **SSLEngine on** on kommentoitu, poista kommentointi.
