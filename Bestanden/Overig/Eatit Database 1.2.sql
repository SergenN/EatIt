-- Project EatIT
-- Groep: F4
-- Versie: 1.2

CREATE TABLE AantalVerkocht
  (
    BestNR INT NOT NULL ,
    GerNR  INT NOT NULL ,
    Aantal INT ,
	PRIMARY KEY ( BestNR, GerNR ) 
  ) ;

CREATE TABLE Aantalingredienten
  (
    AiNR       INT NOT NULL AUTO_INCREMENT ,
    GerNR      INT NOT NULL ,
    IngNR      INT NOT NULL ,
    ING_Aantal INT ,
	PRIMARY KEY ( AiNR ) 
  ) ;

CREATE TABLE Afdeling
  (
    AfdNR       INT NOT NULL AUTO_INCREMENT ,
    AFD_Naam    VARCHAR (30) ,
    AFD_Manager INT ,
	PRIMARY KEY ( AfdNR ) 
  ) ;

CREATE TABLE Besteling
  (
    BestNR     INT NOT NULL AUTO_INCREMENT ,
    KlantNR    INT NOT NULL ,
    MedNR      INT NOT NULL ,
    BEST_Datum DATE ,
    BEST_Status     VARCHAR (20) ,
	PRIMARY KEY ( BestNR ) 
  ) ;

CREATE TABLE Gerecht
  (
    GerNR     INT NOT NULL AUTO_INCREMENT ,
    GER_Naam  VARCHAR (30) ,
    GER_Prijs INT ,
	PRIMARY KEY ( GerNR ) 
  ) ;

CREATE TABLE Ingredienten
  (
    IngNR           INT NOT NULL AUTO_INCREMENT ,
    ING_Naam        VARCHAR (30) ,
    ING_Voorraad    INT ,
    ING_Leverancier INT NOT NULL ,
    ING_Prijs       INT ,
	PRIMARY KEY ( IngNR ) 
  ) ;

CREATE TABLE Inkoopfactuur
  (
    InkfNR INT NOT NULL AUTO_INCREMENT ,
    Inkf_Status VARCHAR (60) ,
    Bedrag INT ,
	PRIMARY KEY ( InkfNR ) 
  ) ;

CREATE TABLE Inkooporder
  (
    OrderNR INT NOT NULL AUTO_INCREMENT ,
    IngNR   INT NOT NULL ,
    LevNR   INT NOT NULL ,
    Aantal  INT ,
	PRIMARY KEY ( OrderNR ) 
  ) ;

CREATE TABLE Klant
  (
    KlantNR           INT NOT NULL AUTO_INCREMENT ,
    KL_Voornaam       VARCHAR (20) ,
    KL_Achternaam     VARCHAR (20) ,
    KL_Telefoonnummer VARCHAR (16) ,
    KL_Mail           VARCHAR (60) ,
    KL_Plaats         VARCHAR (30) ,
    KL_Adres          VARCHAR (30) ,
    KL_Postcode       VARCHAR (6) ,
    KL_Wachtwoord     VARCHAR (60) ,
	PRIMARY KEY ( KlantNR ) 
  ) ;

CREATE TABLE Leverancier
  (
    LevNR              INT NOT NULL AUTO_INCREMENT ,
    LEV_Naam           VARCHAR (30) ,
    LEV_Telefoonnummer VARCHAR (16) ,
    LEV_Mail           VARCHAR (60) ,
    LEV_Plaats         VARCHAR (30) ,
    LEV_Adres          VARCHAR (30) ,
    LEV_Postcode       VARCHAR (6) ,
	PRIMARY KEY ( LevNR ) 
  ) ;

CREATE TABLE Medewerkers
  (
    MedNR              INT NOT NULL AUTO_INCREMENT ,
    MED_Voornaam       VARCHAR (20) ,
    MED_Achternaam     VARCHAR (20) ,
    MED_Mail           VARCHAR (60) ,
    MED_Telefoonnummer VARCHAR (16) ,
    MED_Plaats         VARCHAR (30) ,
    MED_Adres          VARCHAR (30) ,
    MED_Postcode       VARCHAR (6) ,
    Afdeling           INT NOT NULL ,
    Manager_ID         INT ,
	PRIMARY KEY ( MedNR ) 
  ) ;

ALTER TABLE AantalVerkocht ADD CONSTRAINT AantalVerkocht_Besteling_FK FOREIGN KEY ( BestNR ) REFERENCES Besteling ( BestNR ) ;

ALTER TABLE AantalVerkocht ADD CONSTRAINT AantalVerkocht_Gerecht_FK FOREIGN KEY ( GerNR ) REFERENCES Gerecht ( GerNR ) ;

ALTER TABLE Aantalingredienten ADD CONSTRAINT Aantalingredienten_Gerecht_FK FOREIGN KEY ( GerNR ) REFERENCES Gerecht ( GerNR ) ;

ALTER TABLE Aantalingredienten ADD CONSTRAINT Aantalingredienten_Ingredienten_FK FOREIGN KEY ( IngNR ) REFERENCES Ingredienten ( IngNR ) ;

ALTER TABLE Besteling ADD CONSTRAINT Besteling_Klant_FK FOREIGN KEY ( KlantNR ) REFERENCES Klant ( KlantNR ) ;

ALTER TABLE Besteling ADD CONSTRAINT Besteling_Medewerkers_FK FOREIGN KEY ( MedNR ) REFERENCES Medewerkers ( MedNR ) ;

ALTER TABLE Inkoopfactuur ADD CONSTRAINT Inkoopfactuur_Inkooporder_FK FOREIGN KEY ( InkfNR ) REFERENCES Inkooporder ( OrderNR ) ;

ALTER TABLE Inkooporder ADD CONSTRAINT Inkooporder_Ingredienten_FK FOREIGN KEY ( IngNR ) REFERENCES Ingredienten ( IngNR ) ;

ALTER TABLE Inkooporder ADD CONSTRAINT Inkooporder_Leverancier_FK FOREIGN KEY ( LevNR ) REFERENCES Leverancier ( LevNR ) ;

ALTER TABLE Medewerkers ADD CONSTRAINT Medewerkers_Afdeling_FK FOREIGN KEY ( Afdeling ) REFERENCES Afdeling ( AfdNR ) ;

ALTER TABLE Medewerkers ADD CONSTRAINT Medewerkers_Medewerkers_FK FOREIGN KEY ( Manager_ID ) REFERENCES Medewerkers ( MedNR ) ;