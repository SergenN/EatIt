-- Project EatIT
-- Groep: F4
-- Versie: 1.0
-- Compatible met versie 1.3 EatIT Database 1.3 .SQL
-- Test gegevens toevoegen aan de verschillende tabbellen.

-- Alle medewerkers worden toegevoegd.
INSERT INTO Medewerkers (MED_Voornaam, MED_Achternaam, MED_Mail, MED_Telefoonnummer, MED_Plaats, MED_Adres, MED_Postcode)
VALUES ('Inge', 'Achternaam', 'ingeachternaam@eatit.com', '050-9658741', 'Groningen', 'Langestraat 23', '1122AB');

INSERT INTO Medewerkers (MED_Voornaam, MED_Achternaam, MED_Mail, MED_Telefoonnummer, MED_Plaats, MED_Adres, MED_Postcode)
VALUES ('Tim', 'Achter', 'timachter@eatit.com', '050-5423157', 'Groningen', 'Krommebocht 36', '4488ZB');

INSERT INTO Medewerkers (MED_Voornaam, MED_Achternaam, MED_Mail, MED_Telefoonnummer, MED_Plaats, MED_Adres, MED_Postcode)
VALUES ('Jeroen', 'de Vries', 'jeroendevries@eatit.com', '0597-542168', 'Stadskanaal', 'Kanaal 12', '8465MN');

INSERT INTO Medewerkers (MED_Voornaam, MED_Achternaam, MED_Mail, MED_Telefoonnummer, MED_Plaats, MED_Adres, MED_Postcode)
VALUES ('Bert', 'Bartels', 'bertbartels@eatit.com', '0598-645217', 'Veendam', 'Veenweg 156', '9998ZX');

INSERT INTO Medewerkers (MED_Voornaam, MED_Achternaam, MED_Mail, MED_Telefoonnummer, MED_Plaats, MED_Adres, MED_Postcode)
VALUES ('Els', 'Zoon', 'elszoon@eatit.com', '050-3214574', 'Groningen', 'Grotemarkt', '4444PO');

INSERT INTO Medewerkers (MED_Voornaam, MED_Achternaam, MED_Mail, MED_Telefoonnummer, MED_Plaats, MED_Adres, MED_Postcode)
VALUES ('Gerard', 'van Holten', 'gerardvanholten@eatit.com', '0598-455215', 'Hoogezand', 'Laagzand 55', '9876RE');

INSERT INTO Medewerkers (MED_Voornaam, MED_Achternaam, MED_Mail, MED_Telefoonnummer, MED_Plaats, MED_Adres, MED_Postcode)
VALUES ('Hanneke', 'Scheepstra', 'hannekescheepstra@eatit.com', '0595-875412', 'Winsum', 'Kleinelaan 4', '2123QW');

INSERT INTO Medewerkers (MED_Voornaam, MED_Achternaam, MED_Mail, MED_Telefoonnummer, MED_Plaats, MED_Adres, MED_Postcode)
VALUES ('Lars', 'Pieters', 'larspieters@eatit.com', '050-2124456', 'Groningen', 'Grachtweg 7', '2134KJ');


-- Managers van de medewerkers worden toegevoegd.
UPDATE Medewerkers
SET Manager_ID = 1
WHERE MedNR = 3;

UPDATE Medewerkers
SET Manager_ID = 2
WHERE MedNR = 4;

UPDATE Medewerkers
SET Manager_ID = 2
WHERE MedNR = 5;

UPDATE Medewerkers
SET Manager_ID = 1
WHERE MedNR = 6;

UPDATE Medewerkers
SET Manager_ID = 1
WHERE MedNR = 7;

UPDATE Medewerkers
SET Manager_ID = 7
WHERE MedNR = 8;

-- Afdelingen worden toegevoegd.
INSERT INTO Afdeling (AFD_Naam, AFD_Manager)
VALUES ('Directie', 1);

INSERT INTO Afdeling (AFD_Naam, AFD_Manager)
VALUES ('Expeditie', 6);

INSERT INTO Afdeling (AFD_Naam, AFD_Manager)
VALUES ('Administratie', 3);

INSERT INTO Afdeling (AFD_Naam, AFD_Manager)
VALUES ('Financiële administratie', 4);

INSERT INTO Afdeling (AFD_Naam, AFD_Manager)
VALUES ('Personeelsadministratie', 5);

INSERT INTO Afdeling (AFD_Naam, AFD_Manager)
VALUES ('Commerciele afdeling', 7);

INSERT INTO Afdeling (AFD_Naam, AFD_Manager)
VALUES ('Inkoop', 7);

INSERT INTO Afdeling (AFD_Naam, AFD_Manager)
VALUES ('Verkoop', 7);

-- Bij de Medewerkers tabel worden nu de afdelingen toegevoegd waar elke medewerkers bij zit.
UPDATE Medewerkers
SET Afdeling = 1
WHERE MedNR = 1;

UPDATE Medewerkers
SET Afdeling = 1
WHERE MedNR = 2;

UPDATE Medewerkers
SET Afdeling = 3
WHERE MedNR = 3;

UPDATE Medewerkers
SET Afdeling = 4
WHERE MedNR = 4;

UPDATE Medewerkers
SET Afdeling = 5
WHERE MedNR = 5;

UPDATE Medewerkers
SET Afdeling = 2
WHERE MedNR = 6;

UPDATE Medewerkers
SET Afdeling = 6
WHERE MedNR = 7;

UPDATE Medewerkers
SET Afdeling = 7
WHERE MedNR = 8;

-- Vijftal klanten worden toegevoegd.
INSERT INTO Klant (KL_Voornaam, KL_Achternaam, KL_Telefoonnummer, KL_Mail, KL_Plaats, KL_Adres, KL_Postcode, KL_Wachtwoord)
VALUES ('Pieter', 'Halveliter', '050-9687452', 'pieterhalveliter@mail.com', 'Groningen', 'Krommedijk 78', '4587AS', 'Wachtwoord');

INSERT INTO Klant (KL_Voornaam, KL_Achternaam, KL_Telefoonnummer, KL_Mail, KL_Plaats, KL_Adres, KL_Postcode, KL_Wachtwoord)
VALUES ('Kees', 'Meijer', '0598-542147', 'keesmeijer@mail.com', 'Veendam', 'Oosterdiep 34', '4532YS', 'Password');

INSERT INTO Klant (KL_Voornaam, KL_Achternaam, KL_Telefoonnummer, KL_Mail, KL_Plaats, KL_Adres, KL_Postcode, KL_Wachtwoord)
VALUES ('Sjaak', 'de Vries', '0597-654217', 'sjaakdevries@mail.com', 'Oude Pekela', 'Steenweg 41', '2104WQ', 'Welkom12');

INSERT INTO Klant (KL_Voornaam, KL_Achternaam, KL_Telefoonnummer, KL_Mail, KL_Plaats, KL_Adres, KL_Postcode, KL_Wachtwoord)
VALUES ('Linda', 'Klaassens', '050-5421789', 'lindaklaassens@mail.com', 'Groningen', 'Groningerweg 87', '6542RG', 'ABCD1234');

INSERT INTO Klant (KL_Voornaam, KL_Achternaam, KL_Telefoonnummer, KL_Mail, KL_Plaats, KL_Adres, KL_Postcode, KL_Wachtwoord)
VALUES ('Marith', 'Bos', '050-2314879', 'marithbos@mail.com', 'Groningen', 'Paddepoel 45', '0214ZE', 'HelloWorld');

-- Leveranciers worden toegevoegd.
INSERT INTO Leverancier (LEV_Naam, LEV_Telefoonnummer, LEV_Mail, LEV_Plaats, LEV_Adres, LEV_Postcode)
VALUES ('Smiths', '050-9854781', 'infosmiths@smithsbv.nl', 'Groningen', 'Slingerweg 87', '6565MO');

INSERT INTO Leverancier (LEV_Naam, LEV_Telefoonnummer, LEV_Mail, LEV_Plaats, LEV_Adres, LEV_Postcode)
VALUES ('LekkerLekker', '0595-874120', 'infolekkerlekker@lekkerlekker.nl', 'Winsum', 'Diepdal 98', '3214HW');

-- Ingredienten worden toegevoegd.
INSERT INTO Ingredienten (ING_Naam, ING_TechnischeVoorraad, ING_InBestelling, ING_Gereserveerd, ING_BestelNiveau, ING_Leverancier, ING_Prijs)
VALUES ('Pesto', 150, 20, 50, 60, 1, 0.80);

INSERT INTO Ingredienten (ING_Naam, ING_TechnischeVoorraad, ING_InBestelling, ING_Gereserveerd, ING_BestelNiveau, ING_Leverancier, ING_Prijs)
VALUES ('Mais', 240, 40, 65, 40, 2, 0.75 );

INSERT INTO Ingredienten (ING_Naam, ING_TechnischeVoorraad, ING_InBestelling, ING_Gereserveerd, ING_BestelNiveau, ING_Leverancier, ING_Prijs)
VALUES ('Ingredient67', 210, 24, 24, 42, 2, 1.20 );

INSERT INTO Ingredienten (ING_Naam, ING_TechnischeVoorraad, ING_InBestelling, ING_Gereserveerd, ING_BestelNiveau, ING_Leverancier, ING_Prijs)
VALUES ('Ingredient12', 50, 10, 20, 8, 5, 2.20 );

-- 2 Gerechten worden toegevoegd.
INSERT INTO Gerecht (GER_Naam, GER_Prijs, GER_Beschrijving)
VALUES ('Gerecht 1', 7.80, 'Lekkere gerecht vers gebakken uit de oven.' );

INSERT INTO Gerecht (GER_Naam, GER_Prijs, GER_Beschrijving)
VALUES ('Gerecht 2', 8.20, 'Gebraden varkensvlees met champignons' );

-- Ingredienten die nodig zijn per gerecht toevoegen.
INSERT INTO Aantalingredienten (GerNR, IngNR, ING_Aantal)
VALUES (1, 3, 2);

INSERT INTO Aantalingredienten (GerNR, IngNR, ING_Aantal)
VALUES (1, 1, 3);

INSERT INTO Aantalingredienten (GerNR, IngNR, ING_Aantal)
VALUES (1, 2, 5);

INSERT INTO Aantalingredienten (GerNR, IngNR, ING_Aantal)
VALUES (2, 1, 1);

INSERT INTO Aantalingredienten (GerNR, IngNR, ING_Aantal)
VALUES (2, 4, 4);