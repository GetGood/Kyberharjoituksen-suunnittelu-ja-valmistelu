## Lubuntu VMs

### Verkkoasetukset (Työasema 1)

###### Vaihe 1:

![lubuntu_ip_step1](https://user-images.githubusercontent.com/16650292/32936397-c9b57ae8-cb7c-11e7-9963-40e82229500f.png)

###### Vaihe 2:

![lubuntu_ip_step2](https://user-images.githubusercontent.com/16650292/32936399-c9d4f1fc-cb7c-11e7-9d4e-327b425bc8a6.png)

###### Vaihe 3:

![lubuntu_ip_step3](https://user-images.githubusercontent.com/16650292/32936400-c9ef7e3c-cb7c-11e7-94a9-ca152f49abb8.png)

###### Vaihe 4:

![lubuntu_ip_step5](https://user-images.githubusercontent.com/16650292/32936402-ca25d86a-cb7c-11e7-8e38-edcba339d57a.png)

Järjestelmän uudelleenkäynnistyksen jälkeen asetetut verkkoasetukset ovat tulleet voimaan.

### Verkkoasetukset (Työasema 2)

###### Vaihe 1:

![lubuntu_ip_step1](https://user-images.githubusercontent.com/16650292/32936397-c9b57ae8-cb7c-11e7-9963-40e82229500f.png)

###### Vaihe 2:

![lubuntu_ip_step2](https://user-images.githubusercontent.com/16650292/32936399-c9d4f1fc-cb7c-11e7-9d4e-327b425bc8a6.png)

###### Vaihe 3:

![lubuntu_ip_step4](https://user-images.githubusercontent.com/16650292/32936401-ca0abcc4-cb7c-11e7-9828-e61740072d81.png)

###### Vaihe 4:

![lubuntu_ip_step6](https://user-images.githubusercontent.com/16650292/32936403-ca4080c0-cb7c-11e7-9e59-bbe0b24f9c02.png)

Järjestelmän uudelleenkäynnistyksen jälkeen asetetut verkkoasetukset ovat tulleet voimaan.

### Varmenneorganisaation ”CyberCerts Certificate Authority” lisääminen selaimeen (Työasemat 1&2)

###### Vaihe 1:

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

Nyt varmenneorganisaation allekirjoittamat sertifikaatit ovat luotettuja ja selaaminen on suojattu SSL salauksella:

