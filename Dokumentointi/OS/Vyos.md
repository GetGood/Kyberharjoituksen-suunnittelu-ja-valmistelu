## VyOS asennusohjeet

### VirtualBox

###### Vaihe 1:

![virtualbox_new](https://user-images.githubusercontent.com/16650292/32906076-89fef3c0-cb04-11e7-9e1c-c0cce28cad3c.PNG)

###### Vaihe 2:

![virtualbox_new_vyos_step_1](https://user-images.githubusercontent.com/16650292/32906175-cdbd408a-cb04-11e7-92c4-ee9b0bbe3808.png)

###### Vaihe 3:

![virtualbox_new_vyos_step_2](https://user-images.githubusercontent.com/16650292/32906184-d320fb66-cb04-11e7-8504-823305847c87.png)

###### Vaihe 4:

![virtualbox_new_vyos_step_3](https://user-images.githubusercontent.com/16650292/32906185-d33d818c-cb04-11e7-8093-c966efaddbd5.png)

###### Vaihe 5:

![virtualbox_new_vyos_step_4](https://user-images.githubusercontent.com/16650292/32906187-d35b69ea-cb04-11e7-82a1-000ecc6468f0.png)

###### Vaihe 6:

![virtualbox_new_vyos_step_5](https://user-images.githubusercontent.com/16650292/32906188-d3782742-cb04-11e7-82cc-4b919464399d.png)

###### Vaihe 7:

![virtualbox_new_vyos_step_6](https://user-images.githubusercontent.com/16650292/32906190-d3b83df0-cb04-11e7-8f06-a69009fc7b0c.png)

###### Vaihe 8:

![virtualbox_new_vyos_step_7](https://user-images.githubusercontent.com/16650292/32906192-d3d8307e-cb04-11e7-8009-2133fa870715.png)

###### Huom!
Levyn kuvaa painaessa avautuu valikko, josta valitaan "Choose Virtual Optical Disk File...". Selaa tämän jälkeen levyn näköistiedoston sisältävään kansioon, valitse levyn näköistiedosto ja paina "Avaa".

###### Vaihe 9:

![virtualbox_new_vyos_step_8](https://user-images.githubusercontent.com/16650292/32906275-18315f5c-cb05-11e7-8c17-14e4b9b7a9fa.png)

###### Vaihe 10:

![virtualbox_new_vyos_step_9](https://user-images.githubusercontent.com/16650292/32906276-184d82b8-cb05-11e7-9610-ea1b51c5284f.png)

###### Vaihe 11:

![virtualbox_new_vyos_step_10](https://user-images.githubusercontent.com/16650292/32906277-186a4ec0-cb05-11e7-9bfd-be6a0a857c7a.png)


### Vyos VM

![vyos_asennusohjeet_1](https://user-images.githubusercontent.com/16650292/32906861-ecfc2536-cb06-11e7-9291-425bdae7d3f4.png)

##### Ohjeet:

```
vyos login: vyos
Password: vyos
vyos@vyos:~$ install image
Would you like to continue? (Yes/No) [Yes]: yes
Partition (Auto/Parted/Skip) [Auto]: Paina enter
Install the image on? [sda]: Paina enter
Continue? (Yes/No) [No]: yes
How big of a root partition should I create? (1000MB-8589MB) [8589]MB: Paina enter
What would you like to name this image? [1.1.7]: Paina enter
Which one should I copy to sda? [/config/config.boot]: Paina enter
Enter password for user 'vyos': vyos
Retype password for user 'vyos': vyos
Which drive should GRUB modify the boot partition on? [sda]: Paina enter
```
Käyttöjärjestelmän asennus onnistui jos saat ilmoituksen:

```
Done!
```

Sammuta Vyos VM komennolla:

```
vyos@vyos:~$ poweroff
Proceed with poweroff? (Yes/No) [No] yes
```

### VirtualBox

###### Vaihe 12:




