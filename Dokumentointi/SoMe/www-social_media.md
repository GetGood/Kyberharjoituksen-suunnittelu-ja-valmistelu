## WWW-Sosiaalinen media VM

### Verkkoasetukset

###### Vaihe 1:

VirtualBox:iin tehdään seuraavat muutokset:

![www_some_virtualbox_step1](https://user-images.githubusercontent.com/16650292/32946671-26986f1c-cba1-11e7-8c64-d16a3c5ceab4.png)

###### Vaihe 2:

Suorita komennot:

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

###### Vaihe 1:

