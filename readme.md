<!-- PROJECT LOGO -->

<div id="top" align="center">
<h1 align="center">Projekt xWorkspace</h3>
<br />
    <img src="media/xWS_Logo.png" alt="Logo">
  </a>
<br />
<br />
</div>

<br />

<!-- Inhaltsverzeichnis -->

# Inhaltsverzeichnis
1. [Roadmap](#roadmap)
2. [ER Modell](#er-modell)
3. [Relationaler DB-Entwurf](#relationaler-datenbank-entwurf)
4. [Erstellt mit](#erstellt-mit)

<br />

<!-- Content -->

## Roadmap

<br />

- [x] Browser Login
- [x] Räume reservieren
- [x] Passwortabfrage mit Weiterleitung
- [x] Kalender mit Terminen
- [x] Prototyp mit Login, Startseite und Raumreservierung
- [x] Erstellung zugehöriger Datenbank
- [x] Implementierung von Datenbank in das xWS Tool
- [x] Verfügbarkeiten und eigene Termine anzeigen lassen
- [x] Raumsuche nach Datum und Zeit
- [x] Designänderungen
- [ ] Buchung stornieren
    
<p align="right">(<a href="#top">nach oben</a>)</p>

## ER Modell

<br />

<div align="center">
    <img src="media/ER-Modell.svg" alt="ER Model">
</div>
<p align="right">(<a href="#top">nach oben</a>)</p>

## Relationaler Datenbank Entwurf

<br />

Benutzer(**ID**, Name, Password)<br>
Raum(**ID**, Nummer, Straße, HausNr, Ort, PLZ)<br>
Feature(**ID**, Name)

Raum_Feature(**ID**, <ins>RaumID</ins>, <ins>FeatureID</ins>)<br>
Reservierung(**ID**, <ins>BenutzerID</ins>, <ins>RaumID</ins>, Von, Bis, Datum)

<p align="right">(<a href="#top">nach oben</a>)</p>

## Erstellt mit

<br />

- [Bootstrap](https://getbootstrap.com)
- [Vue.js](https://vuejs.org/)

<p align="right">(<a href="#top">nach oben</a>)</p>

## UI/UX Prototyp

https://www.figma.com/file/C9jDSH8pYWVMZhPsl88JDO/xWorkspace?node-id=0%3A1