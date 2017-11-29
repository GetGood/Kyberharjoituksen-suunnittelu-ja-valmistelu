## Kali VMs

### NTP-synkronointi (Työasemat 1 & 2)

###### Vaihe 1:

Avaa komentorivi ja suorita komento ```sudo nano /etc/ntp.conf```, kommentoi ja lisää tiedostoon seuraavat tiedot ja tallenna tiedosto:

```
#pool 0.debian.pool.ntp.org iburst
#pool 1.debian.pool.ntp.org iburst
#pool 2.debian.pool.ntp.org iburst
#pool 3.debian.pool.ntp.org iburst
server 195.20.4.10
```

###### Vaihe 2:

Suorita uudelleenkäynnistys ja tarkista toimivuus komennoilla:

```
systemctl restart ntp
ntpq -4 -pn
``` 

### Verkkoasetukset (Työasema 1)

###### Vaihe 1:

VirtualBox:iin tehdään seuraavat muutokset:

![kali_virtualbox_step2](https://user-images.githubusercontent.com/16650292/32947333-0a5af218-cba4-11e7-9529-ceab7ddcd744.png)

###### Vaihe 2:

![kali_ip_step1](https://user-images.githubusercontent.com/16650292/32936857-9ffbac7a-cb7e-11e7-90ab-18233e80ebc7.png)

###### Vaihe 3:

![kali_ip_step2](https://user-images.githubusercontent.com/16650292/32936858-a0180b22-cb7e-11e7-9362-ab4fa39a14d0.png)

###### Vaihe 4:

![kali_ip_step3](https://user-images.githubusercontent.com/16650292/32936859-a03422da-cb7e-11e7-8692-169de5668de1.png)

###### Vaihe 5:

![kali_ip_step4](https://user-images.githubusercontent.com/16650292/32936860-a04fd8e0-cb7e-11e7-93f9-a9819ab7ca10.png)

###### Vaihe 6:

![kali_dns_step1](https://user-images.githubusercontent.com/16650292/32942382-934310c8-cb91-11e7-9b69-1317b65ac43c.png)

###### Vaihe 7:

![kali_ip_step7](https://user-images.githubusercontent.com/16650292/32936864-a0a5095a-cb7e-11e7-9419-1e937450c2de.png)

###### Vaihe 8:

![kali_dns_step2](https://user-images.githubusercontent.com/16650292/32942383-935e8dc6-cb91-11e7-86a0-d5867d316bf8.png)

### Verkkoasetukset (Työasema 2)

###### Vaihe 1:

VirtualBox:iin tehdään seuraavat muutokset:

![kali_virtualbox_step1](https://user-images.githubusercontent.com/16650292/32947332-0a3dba04-cba4-11e7-86fd-7c0151903414.png)

###### Vaihe 2:

![kali_ip_step1](https://user-images.githubusercontent.com/16650292/32936857-9ffbac7a-cb7e-11e7-90ab-18233e80ebc7.png)

###### Vaihe 3:

![kali_ip_step2](https://user-images.githubusercontent.com/16650292/32936858-a0180b22-cb7e-11e7-9362-ab4fa39a14d0.png)

###### Vaihe 4:

![kali_ip_step3](https://user-images.githubusercontent.com/16650292/32936859-a03422da-cb7e-11e7-8692-169de5668de1.png)

###### Vaihe 5:

![kali_ip_step4](https://user-images.githubusercontent.com/16650292/32936860-a04fd8e0-cb7e-11e7-93f9-a9819ab7ca10.png)

###### Vaihe 6:

![kali_dns_step11](https://user-images.githubusercontent.com/16650292/32942384-937a4b10-cb91-11e7-8d67-1e3c00d100a3.png)

###### Vaihe 7:

![kali_ip_step9](https://user-images.githubusercontent.com/16650292/32936985-27c93b18-cb7f-11e7-99c1-84d833377285.png)

###### Vaihe 8:

![kali_dns_step12](https://user-images.githubusercontent.com/16650292/32942381-932735ec-cb91-11e7-8a8c-7ed3ea0bf220.png)


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

### Slowloris asennus (Työasemat 1 & 2):

1) sudo apt-get install python3-pip
2) pip3 install slowloris
