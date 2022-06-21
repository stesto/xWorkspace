Raum
ID
Nummer
HausNr
Ort
PLZ


Feature
ID
Name


Raum_Feature
ID
RaumID
FeatureID


Reservierung
ID
Datum
Von
Bis
RaumID
BenutzerID


//// Raum

INSERT INTO Raum (Nummer, Straße, HausNr, Ort, PLZ)
VALUES ('6A 123', 'Alt Friedrichsfelde', '60', '10315', 'Berlin');
INSERT INTO Raum (Nummer, Straße, HausNr, Ort, PLZ)
VALUES ('6A 124', 'Alt Friedrichsfelde', '60', '10315', 'Berlin');
INSERT INTO Raum (Nummer, Straße, HausNr, Ort, PLZ)
VALUES ('6A 125', 'Alt Friedrichsfelde', '60', '10315', 'Berlin');
INSERT INTO Raum (Nummer, Straße, HausNr, Ort, PLZ)
VALUES ('6A 126', 'Alt Friedrichsfelde', '60', '10315', 'Berlin');
INSERT INTO Raum (Nummer, Straße, HausNr, Ort, PLZ)
VALUES ('6A 127', 'Alt Friedrichsfelde', '60', '10315', 'Berlin');

INSERT INTO Raum (Nummer, Straße, HausNr, Ort, PLZ)
VALUES ('6A 223', 'Alt Friedrichsfelde', '60', '10315', 'Berlin');
INSERT INTO Raum (Nummer, Straße, HausNr, Ort, PLZ)
VALUES ('6A 224', 'Alt Friedrichsfelde', '60', '10315', 'Berlin');
INSERT INTO Raum (Nummer, Straße, HausNr, Ort, PLZ)
VALUES ('6A 225', 'Alt Friedrichsfelde', '60', '10315', 'Berlin');
INSERT INTO Raum (Nummer, Straße, HausNr, Ort, PLZ)
VALUES ('6A 226', 'Alt Friedrichsfelde', '60', '10315', 'Berlin');
INSERT INTO Raum (Nummer, Straße, HausNr, Ort, PLZ)
VALUES ('6A 227', 'Alt Friedrichsfelde', '60', '10315', 'Berlin');

INSERT INTO Raum (Nummer, Straße, HausNr, Ort, PLZ)
VALUES ('6A 323', 'Alt Friedrichsfelde', '60', '10315', 'Berlin');
INSERT INTO Raum (Nummer, Straße, HausNr, Ort, PLZ)
VALUES ('6A 324', 'Alt Friedrichsfelde', '60', '10315', 'Berlin');
INSERT INTO Raum (Nummer, Straße, HausNr, Ort, PLZ)
VALUES ('6A 325', 'Alt Friedrichsfelde', '60', '10315', 'Berlin');
INSERT INTO Raum (Nummer, Straße, HausNr, Ort, PLZ)
VALUES ('6A 326', 'Alt Friedrichsfelde', '60', '10315', 'Berlin');
INSERT INTO Raum (Nummer, Straße, HausNr, Ort, PLZ)
VALUES ('6A 327', 'Alt Friedrichsfelde', '60', '10315', 'Berlin');


//// Feature

INSERT INTO Feature (Name)
VALUES ('Computerplatz');1
INSERT INTO Feature (Name)
VALUES ('Projektor');2
INSERT INTO Feature (Name)
VALUES ('Konferenzraum');3
INSERT INTO Feature (Name)
VALUES ('Hoehenverstellbarer Tisch');4
INSERT INTO Feature (Name)
VALUES ('Drucker');5
INSERT INTO Feature (Name)
VALUES ('Telefon');6


//// Raum_Feature

INSERT INTO Raum_Feature (RaumID, FeatureID)
VALUES (1, 2);
INSERT INTO Raum_Feature (RaumID, FeatureID)
VALUES (1, 3);
INSERT INTO Raum_Feature (RaumID, FeatureID)
VALUES (1, 5);
INSERT INTO Raum_Feature (RaumID, FeatureID)
VALUES (2, 2);
INSERT INTO Raum_Feature (RaumID, FeatureID)
VALUES (2, 3);
INSERT INTO Raum_Feature (RaumID, FeatureID)
VALUES (3, 1);
INSERT INTO Raum_Feature (RaumID, FeatureID)
VALUES (3, 2);
INSERT INTO Raum_Feature (RaumID, FeatureID)
VALUES (4, 1);
INSERT INTO Raum_Feature (RaumID, FeatureID)
VALUES (4, 2);
INSERT INTO Raum_Feature (RaumID, FeatureID)
VALUES (5, 1);
INSERT INTO Raum_Feature (RaumID, FeatureID)
VALUES (5, 2);

INSERT INTO Raum_Feature (RaumID, FeatureID)
VALUES (6, 2);
INSERT INTO Raum_Feature (RaumID, FeatureID)
VALUES (6, 3);
INSERT INTO Raum_Feature (RaumID, FeatureID)
VALUES (6, 5);
INSERT INTO Raum_Feature (RaumID, FeatureID)
VALUES (7, 2);
INSERT INTO Raum_Feature (RaumID, FeatureID)
VALUES (7, 3);
INSERT INTO Raum_Feature (RaumID, FeatureID)
VALUES (8, 1);
INSERT INTO Raum_Feature (RaumID, FeatureID)
VALUES (8, 2);
INSERT INTO Raum_Feature (RaumID, FeatureID)
VALUES (9, 1);
INSERT INTO Raum_Feature (RaumID, FeatureID)
VALUES (9, 2);
INSERT INTO Raum_Feature (RaumID, FeatureID)
VALUES (10, 1);
INSERT INTO Raum_Feature (RaumID, FeatureID)
VALUES (10, 2);

INSERT INTO Raum_Feature (RaumID, FeatureID)
VALUES (11, 2);
INSERT INTO Raum_Feature (RaumID, FeatureID)
VALUES (11, 3);
INSERT INTO Raum_Feature (RaumID, FeatureID)
VALUES (11, 5);
INSERT INTO Raum_Feature (RaumID, FeatureID)
VALUES (12, 2);
INSERT INTO Raum_Feature (RaumID, FeatureID)
VALUES (12, 3);
INSERT INTO Raum_Feature (RaumID, FeatureID)
VALUES (13, 1);
INSERT INTO Raum_Feature (RaumID, FeatureID)
VALUES (13, 2);
INSERT INTO Raum_Feature (RaumID, FeatureID)
VALUES (14, 1);
INSERT INTO Raum_Feature (RaumID, FeatureID)
VALUES (14, 2);
INSERT INTO Raum_Feature (RaumID, FeatureID)
VALUES (15, 1);
INSERT INTO Raum_Feature (RaumID, FeatureID)
VALUES (15, 2);


//// Reservierung

INSERT INTO Reservierung (Datum, Von, Bis, RaumID, BenutzerID)
VALUES ('2022-06-24', '14:00:00', '17:00:00', '4', '1');
INSERT INTO Reservierung (Datum, Von, Bis, RaumID, BenutzerID)
VALUES ('2022-06-23', '14:00:00', '17:00:00', '4', '1');
INSERT INTO Reservierung (Datum, Von, Bis, RaumID, BenutzerID)
VALUES ('2022-06-22', '10:00:00', '13:30:00', '4', '1');

INSERT INTO Reservierung (Datum, Von, Bis, RaumID, BenutzerID)
VALUES ('2022-06-24', '14:00:00', '17:00:00', '8', '2');
INSERT INTO Reservierung (Datum, Von, Bis, RaumID, BenutzerID)
VALUES ('2022-06-23', '14:00:00', '17:00:00', '8', '2');
INSERT INTO Reservierung (Datum, Von, Bis, RaumID, BenutzerID)
VALUES ('2022-06-22', '10:00:00', '13:30:00', '8', '2');

INSERT INTO Reservierung (Datum, Von, Bis, RaumID, BenutzerID)
VALUES ('2022-06-24', '14:00:00', '17:00:00', '12', '3');
INSERT INTO Reservierung (Datum, Von, Bis, RaumID, BenutzerID)
VALUES ('2022-06-23', '14:00:00', '17:00:00', '12', '3');
INSERT INTO Reservierung (Datum, Von, Bis, RaumID, BenutzerID)
VALUES ('2022-06-22', '10:00:00', '13:30:00', '12', '3');

INSERT INTO Reservierung (Datum, Von, Bis, RaumID, BenutzerID)
VALUES ('2022-06-22', '14:00:00', '17:00:00', '4', '1');
INSERT INTO Reservierung (Datum, Von, Bis, RaumID, BenutzerID)
VALUES ('2022-06-22', '14:00:00', '17:00:00', '8', '1');
INSERT INTO Reservierung (Datum, Von, Bis, RaumID, BenutzerID)
VALUES ('2022-06-22', '14:00:00', '17:00:00', '12', '1');

SELECT *
FROM Raum INNER JOIN Reservierung
ON Raum.ID = Reservierung.RaumID
WHERE Reservierung.Von <= '14:00:00' AND Reservierung.Bis >= '17:00:00' AND Reservierung.Datum != '2022-06-23'


