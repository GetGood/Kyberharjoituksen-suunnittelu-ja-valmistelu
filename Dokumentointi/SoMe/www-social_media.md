## WWW-Sosiaalinen media VM

### Verkkoasetukset

###### Vaihe 1:

Avaa terminaali ja suorita komento:

```
su

nano /etc/network/interfaces
```

###### Vaihe 2:

Työasema 1: Lisää tiedostoon seuraavat tiedot ja tallenna tiedosto muutoksien jälkeen:

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

Työasema 2: Lisää tiedostoon seuraavat tiedot ja tallenna tiedosto muutoksien jälkeen:

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

###### Vaihe 1:

![debian_ip_step1](https://user-images.githubusercontent.com/16650292/32937685-2cc230ae-cb82-11e7-93b4-68da7b5f9cf4.png)

###### Vaihe 2:

![debian_ip_step2](https://user-images.githubusercontent.com/16650292/32937686-2ce1443a-cb82-11e7-862e-7f5d1f340219.png)

###### Vaihe 3:

![debian_ip_step3](https://user-images.githubusercontent.com/16650292/32937687-2cfbedda-cb82-11e7-90a1-17f4f9a329a9.png)

Järjestelmän uudelleenkäynnistyksen jälkeen asetetut verkkoasetukset ovat tulleet voimaan.

### WWW-palvelut

###### Vaihe 1:

