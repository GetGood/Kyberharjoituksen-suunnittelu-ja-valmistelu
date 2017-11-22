## Lubuntu VMs

### NTP-synkronointi (Työasemat 1 & 2)

###### Vaihe 1:

Avaa komentorivi ja suorita komennot:
```
sudo -i
apt install ntp
```
###### Vaihe 2:

Suorita komento ```nano /etc/ntp.conf```, kommentoi ja lisää tiedostoon seuraavat tiedot ja tallenna tiedosto:

```
#pool 0.ubuntu.pool.ntp.org iburst
#pool 1.ubuntu.pool.ntp.org iburst
#pool 2.ubuntu.pool.ntp.org iburst
#pool 3.ubuntu.pool.ntp.org iburst
server 195.20.4.10
```

###### Vaihe 3:

Suorita uudelleenkäynnistys ja tarkista toimivuus komennoilla:

```
systemctl restart ntp
ntpq -4 -pn
``` 

### Verkkoasetukset (Työasemat X,Y,Z,W)

###### Vaihe 1:

Työasema X: VirtualBox:iin tehdään seuraavat muutokset:

![lubuntu_virtualbox_step1](https://user-images.githubusercontent.com/16650292/32948013-66d2f840-cba6-11e7-88c1-4f45e844a3d4.png)

Työasema Y: VirtualBox:iin tehdään seuraavat muutokset:

![lubuntu_virtualbox_step2](https://user-images.githubusercontent.com/16650292/32948014-66ee1bac-cba6-11e7-8d03-d7683e92b221.png)

Työasemiin Z ja W: VirtualBox:iin tehdään seuraavat muutokset:

![ws_virtualbox_step1](https://user-images.githubusercontent.com/16650292/32947049-b17a1184-cba2-11e7-894e-40bab4058c89.png)

###### Vaihe 2:

Avaa komentorivi ja suorita komennot:

```
sudo -i
nano /etc/network/interfaces
```

###### Vaihe 3:

Työasema X: Lisää tiedostoon seuraavat tiedot ja tallenna tiedosto muutoksien jälkeen:

```
auto enp0s3
iface enp0s3 inet static
        address 31.7.17.10
        netmask 255.255.255.0
        network 31.7.17.0
        broadcast 31.7.17.255
        gateway 31.7.17.1
        dns-nameservers 195.20.4.10
```

Työasema Y: Lisää tiedostoon seuraavat tiedot ja tallenna tiedosto muutoksien jälkeen:

```
auto enp0s3
iface enp0s3 inet static
        address 31.7.16.20
        netmask 255.255.255.0
        network 31.7.16.0
        broadcast 31.7.16.255
        gateway 31.7.16.1
        dns-nameservers 195.20.4.10
```

Järjestelmän uudelleenkäynnistyksen jälkeen asetetut verkkoasetukset ovat tulevat voimaan.

Työasemat Z ja W: Työasemat saavat verkkoasetuksensa DHCP-palvelimelta (pfSense), joten työasemien verkkoasetuksien manuaalista konfiguraatiota ei tarvitse suorittaa. Työasemien IP-osoite jaetaan poolista, joka kattaa seuraavat osoitteet: 10.0.0.x-10.0.0.y.

### Varmenneorganisaation "CyberCerts CA” lisääminen selaimeen (Työasemat 1 & 2)

###### Vaihe 1:

Suorita komennot:

```
scp user@195.20.4.10:/usr/lib/ssl/misc/demoCA/cacert.pem ~
Are you sure you want to continue connecting (yes/no)? yes
user@195.20.3.10's password: *****
``` 

###### Vaihe 2:

CA:n lisääminen selaimeen (Firefox):

        Avaa Firefox
        Paina "≡"
        Paina "Preferences"
        Paina "Advanced"
        Paina "Certificates"
        Paina "View Certificates"
        Paina "Authorities"
        Paina "Import..."
        Etsi ja valitse "cacert.pem"
        Paina "Open"
        
        
###### Vaihe 3:    

Avautuneessa ikkunassa: "Downloading Certificate" - "You have been asked to trust a new Certificate Authority (CA)." kaikki esitetyt kysymykset hyväksytään ja painetaan "OK"


###### Vaihe 4:   

![ca_verification](https://user-images.githubusercontent.com/16650292/32949655-54915ca2-cbac-11e7-891b-b2a5c3a4b35b.png)

Nyt varmenneorganisaation allekirjoittamat sertifikaatit ovat luotettuja ja selaaminen on suojattu SSL-salauksella.
