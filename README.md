## ISLM-Bahn Ticketautomat und Admin Anwendung Version 1.0
***

## Generelle Information
***
Die Webanwendung dient am Ticketautomaten den Verkauf der Tickets der ISLM-Bahn.
Die Admin Anwendung ermöglicht die Änderung der Preise und Prozente zur Preisentstehung und eine Einsicht
in die Statistik seit Inbetriebnahme des Automaten.

## Voraussetzung
***
Voraussetzung zur Nutzung der Software ist PHP mit der Version >=8.1.
PHP muss global auf dem System installiert sein.

## Installation über localhost
***
Entpacken Sie die mitgelieferte ZIP-Datei.
Öffnen Sie ein Terminal Ihrer Wahl.
Lokalisieren Sie den enptackten Ordner:
```
$ cd path/to/islm_bahn_ticketautomat
```
Führen Sie anschließend folgenden Befehl aus:
```
$ php -S localhost:8000
```
Öffnen Sie anschließend einen Webbrowser und fügen folgende URL ein:
localhost:8000/startseite.php

## Installation über Webhosting
***
Zur Installation werden zwei Webserver und eine Domain benötigt.
Hier werden die JSON am Webserver der Admin Anwendung gespeichert und über eine Domain zur Admin Anwendung
wieder im Ticketautomaten eingelesen.

## Technologien
***
Der empfohlene Browser ist FireFox ab Version 106.0.1, 
Microsoft Edge ab Version 10 und Google Chrome ab Version 107.0.5304.
