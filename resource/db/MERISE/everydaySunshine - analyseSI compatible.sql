DROP TABLE IF EXISTS Sky ;
CREATE TABLE Sky (ID_sky INT AUTO_INCREMENT NOT NULL,
Label VARCHAR(255),
PRIMARY KEY (ID_sky)) ENGINE=InnoDB;

DROP TABLE IF EXISTS Weather ;
CREATE TABLE Weather (ID_weather INT AUTO_INCREMENT NOT NULL,
Forecast DATETIME,
MinTemp FLOAT,
MaxTemp FLOAT,
FeltTemp FLOAT,
Humidity FLOAT,
Pressure FLOAT,
ID_sky INT,
ID_town INT,
PRIMARY KEY (ID_weather)) ENGINE=InnoDB;

DROP TABLE IF EXISTS User ;
CREATE TABLE User (ID_user INT AUTO_INCREMENT NOT NULL,
Name VARCHAR(255),
Password VARCHAR(255),
BirthDate DATE,
Height FLOAT,
ID_town INT,
PRIMARY KEY (ID_user)) ENGINE=InnoDB;

DROP TABLE IF EXISTS Renewal ;
CREATE TABLE Renewal (ID_renewal INT AUTO_INCREMENT NOT NULL,
ModuleName VARCHAR(255),
ID_frequency INT,
PRIMARY KEY (ID_renewal)) ENGINE=InnoDB;

DROP TABLE IF EXISTS Frequency ;
CREATE TABLE Frequency (ID_frequency INT AUTO_INCREMENT NOT NULL,
NumberOfDays FLOAT,
NextDate DATETIME,
PRIMARY KEY (ID_frequency)) ENGINE=InnoDB;

DROP TABLE IF EXISTS Article ;
CREATE TABLE Article (ID_article INT AUTO_INCREMENT NOT NULL,
Pays VARCHAR(255),
Summary TEXT,
URL VARCHAR(255),
ReadingTime TIME,
PRIMARY KEY (ID_article)) ENGINE=InnoDB;

DROP TABLE IF EXISTS TVprogram ;
CREATE TABLE TVprogram (ID_TVprogram INT AUTO_INCREMENT NOT NULL,
Title VARCHAR(255),
Synopsis TEXT,
Begin TIME,
Genre VARCHAR(255),
ID_channel INT,
PRIMARY KEY (ID_TVprogram)) ENGINE=InnoDB;

DROP TABLE IF EXISTS Recipe ;
CREATE TABLE Recipe (ID_recipe INT AUTO_INCREMENT NOT NULL,
Name VARCHAR(255),
Picture VARCHAR(255),
NbPerson INT,
PreparationTime TIME,
CookingTime TIME,
TotalTime TIME,
Score FLOAT,
Price VARCHAR(255),
Difficulty VARCHAR(255),
Steps TEXT,
Ingredients TEXT,
Calories FLOAT,
ID_type INT,
PRIMARY KEY (ID_recipe)) ENGINE=InnoDB;

DROP TABLE IF EXISTS Health ;
CREATE TABLE Health (ID_health INT AUTO_INCREMENT NOT NULL,
RecordDate DATE,
Weight FLOAT,
Calories FLOAT,
Sleep TIME,
ID_user INT,
PRIMARY KEY (ID_health)) ENGINE=InnoDB;

DROP TABLE IF EXISTS Sport ;
CREATE TABLE Sport (ID_sport INT AUTO_INCREMENT NOT NULL,
Label VARCHAR(255),
Picture VARCHAR(255),
Calories FLOAT,
PRIMARY KEY (ID_sport)) ENGINE=InnoDB;

DROP TABLE IF EXISTS Muscle ;
CREATE TABLE Muscle (ID_muscle INT AUTO_INCREMENT NOT NULL,
Label VARCHAR(255),
PRIMARY KEY (ID_muscle)) ENGINE=InnoDB;

DROP TABLE IF EXISTS Channel ;
CREATE TABLE Channel (ID_channel INT AUTO_INCREMENT NOT NULL,
Label VARCHAR(255),
PRIMARY KEY (ID_channel)) ENGINE=InnoDB;

DROP TABLE IF EXISTS Type ;
CREATE TABLE Type (ID_type INT AUTO_INCREMENT NOT NULL,
Label VARCHAR(255),
PRIMARY KEY (ID_type)) ENGINE=InnoDB;

DROP TABLE IF EXISTS Town ;
CREATE TABLE Town (ID_town INT AUTO_INCREMENT NOT NULL,
Label VARCHAR(255),
PRIMARY KEY (ID_town)) ENGINE=InnoDB;

DROP TABLE IF EXISTS Work ;
CREATE TABLE Work (ID_muscle INT AUTO_INCREMENT NOT NULL,
ID_sport INT NOT NULL,
PRIMARY KEY (ID_muscle,
 ID_sport)) ENGINE=InnoDB;

DROP TABLE IF EXISTS Program ;
CREATE TABLE Program (ID_user INT AUTO_INCREMENT NOT NULL,
ID_sport INT NOT NULL,
PRIMARY KEY (ID_user,
 ID_sport)) ENGINE=InnoDB;

ALTER TABLE Weather ADD CONSTRAINT FK_Weather_ID_sky FOREIGN KEY (ID_sky) REFERENCES Sky (ID_sky);

ALTER TABLE Weather ADD CONSTRAINT FK_Weather_ID_town FOREIGN KEY (ID_town) REFERENCES Town (ID_town);
ALTER TABLE User ADD CONSTRAINT FK_User_ID_town FOREIGN KEY (ID_town) REFERENCES Town (ID_town);
ALTER TABLE Renewal ADD CONSTRAINT FK_Renewal_ID_frequency FOREIGN KEY (ID_frequency) REFERENCES Frequency (ID_frequency);
ALTER TABLE TVprogram ADD CONSTRAINT FK_TVprogram_ID_channel FOREIGN KEY (ID_channel) REFERENCES Channel (ID_channel);
ALTER TABLE Recipe ADD CONSTRAINT FK_Recipe_ID_type FOREIGN KEY (ID_type) REFERENCES Type (ID_type);
ALTER TABLE Health ADD CONSTRAINT FK_Health_ID_user FOREIGN KEY (ID_user) REFERENCES User (ID_user);
ALTER TABLE Work ADD CONSTRAINT FK_Work_ID_muscle FOREIGN KEY (ID_muscle) REFERENCES Muscle (ID_muscle);
ALTER TABLE Work ADD CONSTRAINT FK_Work_ID_sport FOREIGN KEY (ID_sport) REFERENCES Sport (ID_sport);
ALTER TABLE Program ADD CONSTRAINT FK_Program_ID_user FOREIGN KEY (ID_user) REFERENCES User (ID_user);
ALTER TABLE Program ADD CONSTRAINT FK_Program_ID_sport FOREIGN KEY (ID_sport) REFERENCES Sport (ID_sport);
