# coding=utf-8
import time
from subprocess import call
from random import randint

lauseet = ["Erittäin+hieno+ja+turvallinen+saitti,+kiitos+teille+tästä",
"Hahaa+olen+spam+monsteri+spammi+poika+pistää+XDDDD",
"Olen+jymy+juntunen+T:+jymyjuntunen",
"Datasentteri+on+kyllä+hyvä+paikka+laittaa+omia+datojaan+kyllä+kyllä",
"Olen+kommentoija+ja+kommentoin+tähän+kommenttipalstalle+hihii",
"Ei+sitä+ihan+joka+paikassa+näin+hienoa+saittia+ole+värit+on+kohallaaan+kiitos"]

print(lauseet)
while True:
    position = randint(0,5)
    stringval = "http://89.250.48.10/tallenna.php?merkinta=" + lauseet[position] +"&nappi=Tallenna"
    print("Sending puppu...")
    call(["curl", stringval])
    time.sleep(10)