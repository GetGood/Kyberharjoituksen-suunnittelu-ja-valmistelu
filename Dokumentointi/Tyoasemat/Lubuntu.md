## Lubuntu VMs

### Verkkoasetukset (Työasemat 1 & 2)

###### Vaihe 1:

Avaa terminaali ja suorita komento:

```
sudo -i
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


### Varmenneorganisaation ”CyberCerts Certificate Authority” lisääminen selaimeen (Työasemat 1 & 2)

###### Vaihe 1:

```
scp user@195.20.4.10:/usr/lib/ssl/misc/demoCA/cacert.pem ~
Are you sure you want to continue connecting (yes/no)? yes
user@195.20.3.10's password: *****
``` 
![lubuntu_ca_step1](https://user-images.githubusercontent.com/16650292/32941323-18d3fe2c-cb8e-11e7-9fcb-8eb4d6face90.png)

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


![lubuntu_ca_step2](https://user-images.githubusercontent.com/16650292/32941325-18f2e8a0-cb8e-11e7-9bbd-69f92bb873b8.png)


Nyt varmenneorganisaation allekirjoittamat sertifikaatit ovat luotettuja ja selaaminen on suojattu SSL salauksella.
