## OwnCloud 10 asennusohjeet

Tässä ohjeessa kerrotaan kuinka OwnCloud 10 pilvipalvelin on asennettu Debian 9 pohjalle. Tätä pilvipalvelinta käytetään kyberharjoituksessa.

### Asennuksen pääkohdat

```
- Järjestelmän päivitys
- LAMP serverin asennus
- Owncloudin asennus
- Owncloudin konfigurointi selaimella
```

### Asennus

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
