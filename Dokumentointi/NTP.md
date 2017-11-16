### NTP

###### Oleelliset konfiguraatiot tiedostossa /etc/network/interfaces

Adapter 1 Internal network dns  
Adapter 2 NAT  

```
auto enp0s3
  address 195.20.4.10
  netmask 255.255.255.0
  gateway 195.20.4.1
   
auto enp0s8
iface enp0s8 inet static
  address 10.0.3.15
  network 10.0.3.0
  netmask 255.255.255.0
  broadcast 10.0.3.255
 
  post-up ip route add 194.100.49.151 via 10.0.3.2 dev enp0s8
  post-up ip route add 194.100.49.152 via 10.0.3.2 dev enp0s8
  pre-down ip route add 194.100.49.151 via 10.0.3.2 dev enp0s8
  pre-down ip route add 194.100.49.151 via 10.0.3.2 dev enp0s8
  ```
  
###### Oleelliset konfiguraatiot tiedostossa /etc/ntp.conf
```
server 194.100.49.151 prefer #time1.mikes.fi
server 194.100.49.152 #time2.mikes.fi
```
Nat gateway ei välttämättä ole tuo 10.0.3.2, jos ntpq -4 -pn näyttää että reach on 0,
kokeile ottaa osoite dhcp:llä ja tarkistaa, mikä on gateway ja missä osoiteavaruudessa
liikutaan.
  
### Client
  
Ntpd:n asennus (debian):
  
```
sudo apt install ntp
```
  
Poista (tai kommentoi) default serverit /etc/ntp.conf tiedostosta ja lisää rivi
  
```
server 195.20.4.10
```

Uudelleenkäynnistä
```
sudo systemctl restart ntp
```

Kokeile lähtikö toimimaan

```
ntpq -4 -pn
```

Reach lähtee hitaasti kasvamaan nollasta ja päätyy 377:ään, joka tarkoittaa että jokainen kahdeksasta viimeisestä ntp kyselystä
on onnistunut.
