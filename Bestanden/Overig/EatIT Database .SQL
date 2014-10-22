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

CREATE TABLE Besteling
  (
    BestNR     INT NOT NULL AUTO_INCREMENT ,
    KlantNR    INT NOT NULL ,
    BEST_Datum DATE ,
    Status     VARCHAR (20) ,
	PRIMARY KEY ( BestNR ) ,
	CONSTRAINT Besteling_Klant_FK FOREIGN KEY ( KlantNR ) REFERENCES Klant ( KlantNR ) 
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

CREATE TABLE Locatie
  (
    LocNR      INT NOT NULL AUTO_INCREMENT ,
    LOC_Naam   VARCHAR (30) ,
    LOC_Plaats VARCHAR (30) ,
    LOC_Adres  VARCHAR (30) ,
	PRIMARY KEY ( LocNR )
  ) ;

CREATE TABLE Gerecht
  (
    GerNR     INT NOT NULL AUTO_INCREMENT ,
    GER_Naam  VARCHAR (30) ,
    GER_Prijs INT ,
	PRIMARY KEY ( GerNR ) 
  ) ;

CREATE TABLE AantalVerkocht
  (
    BestNR INT NOT NULL AUTO_INCREMENT ,
    GerNR  INT NOT NULL ,
    Aantal INT ,
	PRIMARY KEY ( BestNR, GerNR ) ,
	CONSTRAINT AantalVerkocht_Besteling_FK FOREIGN KEY ( BestNR ) REFERENCES Besteling ( BestNR ) ,
	CONSTRAINT AantalVerkocht_Gerecht_FK FOREIGN KEY ( GerNR ) REFERENCES Gerecht ( GerNR ) 
  ) ;

CREATE TABLE Afdeling
  (
    AfdNR       INT NOT NULL AUTO_INCREMENT ,
    AFD_Naam    VARCHAR (30) ,
    AFD_Locatie VARCHAR (30) ,
    AFD_Manager INT ,
	PRIMARY KEY ( AfdNR ) ,
	CONSTRAINT Afdeling_Locatie_FK FOREIGN KEY ( AfdNR ) REFERENCES Locatie ( LocNR ) 
  ) ;

CREATE TABLE Ingredienten
  (
    IngNR           INT NOT NULL AUTO_INCREMENT ,
    ING_Naam        VARCHAR (30) ,
    ING_Voorraad    INT ,
    ING_Leverancier INT NOT NULL ,
	PRIMARY KEY ( IngNR ) ,
	CONSTRAINT Ingredienten_Leverancier_FK FOREIGN KEY ( ING_Leverancier ) REFERENCES Leverancier ( LevNR ) 
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
    Manager_ID         INT NOT NULL ,
	PRIMARY KEY ( MedNR ) ,
	CONSTRAINT Medewerkers_Afdeling_FK FOREIGN KEY ( Afdeling ) REFERENCES Afdeling ( AfdNR ) ,
	CONSTRAINT Medewerkers_Medewerkers_FK FOREIGN KEY ( Manager_ID ) REFERENCES Medewerkers ( MedNR ) 
  ) ;