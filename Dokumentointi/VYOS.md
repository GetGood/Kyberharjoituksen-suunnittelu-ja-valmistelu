## VYOS relevantit konfiguraatiot

###### Vyos 0

Internal interface: 195.20.4.1/24  
Bridged interface: 20.0.0.10/24  
Loopback interface 1.1.1.1/32  

```
interfaces {
  ethernet eth1 {
    address 195.20.4.1/24
  }
  ethernet eth2 {
    address 20.0.0.10/24
  }
  loopback lo {
    address 1.1.1.1/32
  }
}
protocols {
  ospf {
    area 0 {
      network 20.0.0.0/24
      network 195.20.4.0/24
    }
    parameters {
      router-id 1.1.1.1
    }
    passive interface eth1
    redistribute {
      connected {
        metric-type 2
      }
    }
  }
}

system {
  ntp {
    server 195.20.4.10
    }
  }
}
```

###### Vyos 1

Internal interface: 89.250.48.1/24  
Bridged interface: 20.0.0.1/24  
Loopback: 2.2.2.2/32  

```
interfaces {
  ethernet eth1 {
    address 89.250.48.1/24
  }
  ethernet eth2 {
    address 20.0.0.1/24
  }
  loopback lo {
    address 2.2.2.2/32
  }
}
protocols {
  ospf {
    area 0 {
      network 20.0.0.0/24
      network 89.250.48.0/24
    }
    parameters {
      router-id 2.2.2.2
    }
    passive interface eth1
    redistribute {
      connected {
        metric-type 2
      }
    }
  }
}

system {
  ntp {
    server 195.20.4.10
    }
  }
}
```

###### Vyos 2

Internal interface: 31.7.16.1/24  
Internal interface: 31.7.17.1/24  
Bridged interface: 20.0.0.2/24  
Loopback: 3.3.3.3/32  

```
interfaces {
  ethernet eth1 {
    address 31.7.16.1/24
  }
  ethernet eth2 {
    address 20.0.0.1/24
  }
   ethernet eth3 {
    address 31.7.17.1/24
  }
  loopback lo {
    address 3.3.3.3/32
  }
}
protocols {
  ospf {
    area 0 {
      network 20.0.0.0/24
      network 31.7.16.0/24
      network 31.7.17.0/24
    }
    parameters {
      router-id 3.3.3.3
    }
    passive interface eth1
    passive-interface eth3
    redistribute {
      connected {
        metric-type 2
      }
    }
  }
}

system {
  ntp {
    server 195.20.4.10
    }
  }
}
```

###### Vyos 3

Internal interface: 79.175.127.0/24  
Internal interface: 37.47.255.0/24  
Bridged interface: 20.0.0.3/24  
Loopback: 4.4.4.4/32  

```
interfaces {
  ethernet eth1 {
    address 79.175.127.1/24
  }
  ethernet eth3 {
    address 37.47.255.0/24
  }
  ethernet eth2 {
    address 20.0.0.3/24
  }
  loopback lo {
    address 4.4.4.4/32
  }
}
protocols {
  ospf {
    area 0 {
      network 20.0.0.0/24
      network 37.47.255.0/24
      network 79.175.127.1
    }
    parameters {
      router-id 4.4.4.4
    }
    passive interface eth1
    passive interface eth2
     redistribute {
        connected {
          metric-type 2
        }
      }
    }
  }
}

system {
  ntp {
    server 195.20.4.10
    }
  }
}
```
