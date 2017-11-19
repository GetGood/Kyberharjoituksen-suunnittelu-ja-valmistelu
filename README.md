# TTKW0310 Kyberharjoituksen suunnittelu ja valmistelu
## Toteutusajankohta

Syksy 2017 (09/2017-12/2017)

## Tietoa

Tämä repositorio sisältää ryhmän R1 harjoitussuunnitelman harjoitusympäristön teknisen osuuden asennusohjeet sekä ryhmän käyttämät konfiguraatiot.

Harjoitusympäristön tarkoituksena on simuloida internettiä niin tarkasti kuin harjoituksen kannalta on tarpeellista. Verkon runkona toimivat 4 Vyos reititintä, jotka reitittävät liikenettä
päätelaitteiden välillä käyttäen OSPF -protokollaa. Vyos reitittimien väliset verkkoadapterit ovat bridged -tilassa, joka mahdollistaa
reitittimien toimimisen eri fyysisillä laitteilla, kunhan kyseiset laitteet ovat samassa lähiverkossa.   
DNS palvelimena toimii BIND9 jota ajetaan Linux Debianilla. Sama kone toimii myös NTP-serverinä. Aika haetaan 
[mikesin](http://www.mikes.fi/julkinen-ntp-palvelu) stratum-2 palvelimilta. Tätä varten on erikseen konfiguroitu rajapinta, johon
on staattisesti reititetty mikesin palvelimien osoitteet. Mitään muuta liikennettä ympäristöstä ei lähde internettiin.

### Käytetty virtualisointialusta

Harjoitusympäristön luomiseen R1 käytti *Oracle VM VirtualBox Manager* virtualisointialustaa. Harjoitusympäristö toteutettiin virtualisoinnilla, koska sen avulla voidaan tehokkaasti mallintaa ympäristö, jossa voidaan testata haluttua skenaariota ja sen toimivuutta.

*Oracle VM VirtualBox Manager* - lataussivustolle [tästä.](https://www.virtualbox.org/wiki/Downloads)

### Harjoitusympäristön topologia

Harjoitusympäristössä on yhteensä 15 virtuaalikonetta, joilla jokaisella on oma rooli.





## Asennusohjeet

### Käyttöjärjestelmien asennus

Asennusohjeet löytyvät [täältä.](/Dokumentointi/OS)

### Vyos

Asennusohjeet löytyvät [täältä.](/Dokumentointi/Vyos)

### Työasemat

Asennusohjeet löytyvät [täältä.](/Dokumentointi/Tyoasemat/)

### pfSense

Asennusohjeet löytyvät [täältä.](/Dokumentointi/pfSense)

### DNS-NTP-CA

Asennusohjeet löytyvät [täältä.](/Dokumentointi/DNS-NTP-CA)

### OwnCloud

Asennusohjeet löytyvät [täältä.](/Dokumentointi/OwnCloud)

### Sosiaalinen media

Asennusohjeet löytyvät [täältä.](/Dokumentointi/SoMe/)

### Syötteet

Harjoitusympäristössä käytetyt syötteet löytyvät [täältä.](/Dokumentointi/Syotteet)

