### DNS konfiguraatiot

BIND9 asennus

```
apt-get install bind9
```

###### named.conf.options

```
acl "trusted" {
        31.7.16.0/24;
        195.20.4.0/24;
        89.250.48.0/24;
};

options {
        directory "/var/cache/bind";
        dnssec-validation auto;

        auth-nxdomain no;    # conform to RFC1035
        listen-on-v6 { any; };

        listen-on { 195.20.4.10; };
        recursion yes;
        allow-query { any; };
        allow-recursion { trusted; };
};

```
###### named.conf.local

```
zone "fi" {
        type master;
        file "/etc/bind/db.fi";
};

zone "16.7.31.in-addr.arpa" {
        type master;
        notify no;
        file "/etc/bind/db.31.7.16";
};

zone "4.20.195.in-addr.arpa" {
        type master;
        notify no;
        file "/etc/bind/db.195.20.4";
};

zone "48.250.89.in-addr.arpa" {
        type master;
        notify no;
        file "/etc/bind/db.89.250.48";
};
```

###### db.fi

```
;
; BIND data file for local loopback interface
;
$TTL    604800
@       IN      SOA     fi. root.fi. (
                     2017111006         ; Serial
                         604800         ; Refresh
                          86400         ; Retry
                        2419200         ; Expire
                         604800 )       ; Negative Cache TTL
;
@       IN      NS      ns.fi.
@       IN      A       195.20.4.10
ns      IN      A       195.20.4.10

;other servers
www.some.fi.    IN      A       31.7.16.10
www.datacenter.fi.      IN      A       89.250.48.10

```

###### db.31.7.16
```
;
; BIND reverse data file for 31.7.16.X
;
$TTL    604800
@       IN      SOA     ns.fi. root.fi. (
                     2017111005         ; Serial
                         604800         ; Refresh
                          86400         ; Retry
                        2419200         ; Expire
                         604800 )       ; Negative Cache TTL
;
@       IN      NS      ns.fi.
10      IN      PTR     www.some.fi.

```

###### db.89.250.48

```
;
; BIND reverse data file for 89.250.48.X
;
$TTL    604800
@       IN      SOA     ns.fi. root.fi. (
                     2017111001         ; Serial
                         604800         ; Refresh
                          86400         ; Retry
                        2419200         ; Expire
                         604800 )       ; Negative Cache TTL
;
@       IN      NS      ns.fi.
10      IN      PTR     www.datacenter.fi.

```

###### db.195.20.4
```
;
; BIND reverse data file for 195.20.4.X
;
$TTL    604800
@       IN      SOA     ns.fi. root.fi. (
                     2017111002         ; Serial
                         604800         ; Refresh
                          86400         ; Retry
                        2419200         ; Expire
                         604800 )       ; Negative Cache TTL
;
@       IN      NS      ns.fi.
10      IN      PTR     ns.fi.

```

Testaa ettei tullut helppoa virhettä:

```
named-checkconf
```

Uudelleenkäynnistä BIND9

```
/etc/init.d/bind9 restart
```

Nslookup miltä tahansa työasemalta (johon dns on konfiguroitu oikein) pitäisi nyt onnistua:   
![dns][Dokumentointi/Kuvat/dns.PNG]

Jos haluat lisätä uuden osoitteen, lisää ip avaruus trusted alueelle named.conf.optionissa, luo uusi reverse lookup zone
named.conf.localissa, lisää nimi ja osoite other serversien alle db.fi:ssä ja luo uusi db.X.X.X. Kopioi joku muu db.X.X.X ja
laita serialin viimeinen numero ykköseksi sekä tee muut tarvittavat muutokset.
