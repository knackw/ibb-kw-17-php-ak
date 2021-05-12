#IBB PHP, Aufbaukurs

Link: https://www.ibb.com/weiterbildung/php-aufbaukurs

Im Rahmen der Weiterbildung werden weitergehende Kenntnisse der Programmiersprache PHP vermittelt. 
Die Teilnehmer erwerben praktische, anwendungsbereite Fähigkeiten und Kenntnisse in der Programmierung 
und Entwicklung von Webanwendungen, die mit Datenbanken interagieren. Insbesondere wird die Umsetzung 
des objektorientierten Ansatzes mit PHP und das Zusammenspiel von MySQL und PHP betrachtet.

- Fortgeschrittene Konzepte
- Das OOP Konzept von PHP
- Klassen und Objekte
- Konstruktoren und Destruktoren
- Klonen und vererben
- Zusammenspiel von PHP und dem Datenbankmanagementsystem
- MySQL
- Sicherheit
- Error Handling
- Exception Handling
- Bibliotheken

Die SQL Dump Dateien befinden sich im Verzeichnis `"backups"`.

### PHP

- Umgebungsvariablen GET, POST, SESSION
- ARRAYS (indiziert, assoziativ)
- Empfang/Verwaltung Upload Bild
- Anlage Javascript Array/PHP Array in Ausgabedokument
- Erstellung eines Demo-Eingabeformulars

### MySQL

- Definitionen einer Datenbank
- phpmyadmin für Datenverwaltung
- einfache SQL-Abfragen für Datenbank
- Umgebungsvariablen auslesen und in Datenbank ablegen

### Vorbereitung für die Datenerfassung

- Formular mit Upload-Möglichkeiten
- Photoshop-Bildaufbereitung für Slideshow
- html-Gerüst für „alle Gruppenmitglieder“ erstellen
- Datenbank: Einrichtung von Tabellen

### Ausgabemodul

- Auslesen der Daten mit SQL
- Empfang der Daten in Ajax-Modul
- html-Ausgabe
- Projektgestaltung und Präsentation des CMS

## 1. Installieren von Docker und Docker Compose

Siehe hierzu: https://github.com/knackw/docker_nginx_php8_mariadb10_phpmyadmin410

## 2. Installation der HTML Entwicklungsumgebung

**a) Webserver erzeugen**

Quellangaben:

PHP's development with Docker the easy way: https://stefan-poeltl.medium.com/php-development-with-docker-the-easy-way-13621ec5d39b

Mit dem unten angegeben Terminal Kommando wird Entwicklungsumgebung generiert 
und anschließen der Service (Server) gestartet. Du musst Dich im Verzeichnis des Projektes befinden, 
indem sich die Datei docker-compose.yml befindet.

`docker-compose up`

Sollte ein Fehler aufgetreten sein und am Setup Anpassungen vorgenommen haben musst Du folgenden Befehl ausführen.

`docker-compose up --build`

Zum Beenden des Services gibst du

`docker-compose down`

ein.

**b) Tabelle anlegen**

Um die Tabelle zu erzeugen muss das Script `tables_creator.php` im Verzeichnis `./www/public/connection/` ausgeführt werden.

## 5. Linksammlung

**W3Schools**

https://www.w3schools.com

**PHP**

https://www.php.de/
https://www.php.net/

**Design Pattern**

https://www.philipphauer.de/study/se/design-pattern.php
https://designpatternsphp.readthedocs.io/de/latest/README.html
https://refactoring.guru/design-patterns/catalog

## 4. Schlussbemerkung

Solltest Du Fehler entdecken, Vorschläge oder Anregungen haben scheu Dich nicht mir ein Ticket zu schreiben. 

Happy coding :)





