## Red Team Syöte Porttiskannaus

Red Team aloittaa nmap- porttiskannauksen käyttäen Decoy flagia määrittäen eri IP osoitteita eripuolelta maailmaa,  
jotta kohde ei voi helpolla tunnista lähdettä tai estää sitä palomuurista.
```
sudo nmap -D RND:15 -A 89.250.48.10
```
Tämä vaihtaa pakettien source IP:ksi 15 sattumanvaraista IP osoitetta  
Tämä näkyy kaikki Datacenterin palomuurin IDS:n Alerteissa hyvin suurena määräänä merkintöjä  

### Blue teamin reaktio

Blue team ei voi säätää Snorttia estämään kyseisiä hosteja, sillä osa voi olla oikeiden asiakkaiden IP osoitteita  
Asiasta on kuitenkin ilmoitettava eteenpäin, koska toiminta on huomattavan laajamittaista
