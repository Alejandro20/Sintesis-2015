
/*TABLAS*/

CREATE TABLE Categories(
    id_categoria int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nom varchar(60) NOT NULL,
    descripcio varchar(60) NULL
);

CREATE TABLE Favorits(
    site int NOT NULL ,
    usuari int NOT NULL ,
    CONSTRAINT Favorits_pk PRIMARY KEY (site,usuari)
);

CREATE TABLE Multimedia(
    id_multimedia int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    imatge varchar(100),
    video varchar(100),
    usuari int,
    site int,
    categoria int
);

CREATE TABLE Sites (
    id_site int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    titol varchar(30) NOT NULL ,
    descripcio TEXT NOT NULL ,
    imatge varchar(100) NOT NULL ,
    data date NOT NULL ,
    categoria int NOT NULL ,
    lloc varchar(60)  NOT NULL ,
    usuari int NOT NULL
);

CREATE TABLE Subscripcio (
    id_subs int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    metode_pagament varchar(30) NOT NULL,
    preu int NOT NULL DEFAULT 0.90 ,
    c_bancaria varchar(50) NOT NULL,
	subscrit char(2) NOT NULL DEFAULT 'NO',
	usuari INT NOT NULL
);

CREATE TABLE Usuaris (
    id_user int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nom varchar(30) NOT NULL,
    cognoms varchar(30) NULL,
	localitat varchar(30) NOT NULL,
	sexe varchar(30) NOT NULL,
	telefon char(9)  NOT NULL,
    email varchar(30) NOT NULL,
    usuari varchar(30) NOT NULL,
    password varchar(50) NOT NULL,
    rol int NOT NULL,
    estat int NOT NULL DEFAULT 1,
    imatge_Perfil varchar(100),
    valoracio int NOT NULL DEFAULT 10
);

CREATE TABLE Comentaris(

	id_comentari int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	comentari TEXT NOT NULL,
	data_publicacio DATE NOT NULL
);

CREATE TABLE UsuarisComentaris(
	usuari INT NOT NULL,
	comentari INT NOT NULL,
	CONSTRAINT Favorits_pk PRIMARY KEY (usuari,comentari)
);

CREATE TABLE SitesComentaris(
	site INT NOT NULL,
	comentari INT NOT NULL,
	CONSTRAINT Favorits_pk PRIMARY KEY (site,comentari)
);

/*RELACIONES*/	

ALTER TABLE Favorits ADD CONSTRAINT Favorits_Usuaris FOREIGN KEY Favorits_Usuaris (usuari)REFERENCES Usuaris (id_user)
ON UPDATE cascade
ON DELETE cascade;
    
ALTER TABLE Multimedia ADD CONSTRAINT Multimedia_Categories FOREIGN KEY Multimedia_Categories (categoria) REFERENCES Categories (id_categoria)
ON UPDATE cascade
ON DELETE cascade;

ALTER TABLE Multimedia ADD CONSTRAINT Multimedia_Sites FOREIGN KEY Multimedia_Sites (site) REFERENCES Sites (id_site)
ON UPDATE cascade
ON DELETE cascade;

ALTER TABLE Multimedia ADD CONSTRAINT Multimedia_Usuaris FOREIGN KEY Multimedia_Usuaris (usuari) REFERENCES Usuaris (id_user)
ON UPDATE cascade
ON DELETE cascade;

ALTER TABLE Sites ADD CONSTRAINT Sites_Categories FOREIGN KEY Sites_Categories (categoria)REFERENCES Categories (id_categoria)
ON UPDATE cascade
ON DELETE cascade;

ALTER TABLE Favorits ADD CONSTRAINT Sites_Favorits FOREIGN KEY Sites_Favorits (site)REFERENCES Sites (id_site)
ON UPDATE cascade
ON DELETE cascade;

ALTER TABLE Sites ADD CONSTRAINT Sites_Usuaris FOREIGN KEY Sites_Usuaris (usuari)REFERENCES Usuaris (id_user)
ON UPDATE cascade
ON DELETE cascade;

ALTER TABLE Subscripcio ADD CONSTRAINT Subscripcio_Usuaris FOREIGN KEY Subscripcio_Usuaris (usuari) REFERENCES Usuaris (id_user)
ON UPDATE cascade
ON DELETE cascade;

ALTER TABLE UsuarisComentaris ADD CONSTRAINT Comentaris_Usuaris FOREIGN KEY Comentaris_Usuaris(usuari) REFERENCES Usuaris(id_user)
ON UPDATE cascade
ON DELETE cascade;

ALTER TABLE UsuarisComentaris ADD CONSTRAINT Comentaris_Comentari FOREIGN KEY Comentaris_Comentari(comentari) REFERENCES Comentaris(id_comentari)
ON UPDATE cascade
ON DELETE cascade;

ALTER TABLE SitesComentaris ADD CONSTRAINT Comentaris_Sites FOREIGN KEY Comentaris_Sites(site) REFERENCES Sites(id_site)
ON UPDATE cascade
ON DELETE cascade;
ALTER TABLE SitesComentaris ADD CONSTRAINT Comentaris_Comentari_Site FOREIGN KEY Comentaris_Comentari_Site(comentari) REFERENCES Comentaris(id_comentari)
ON UPDATE cascade
ON DELETE cascade;

/*VISTAS*/

CREATE VIEW VFavorits AS
SELECT Sites.titol as 'titol',Sites.descripcio as 'descripcio',Sites.imatge as 'imatge',Sites.lloc as 'lloc', Usuaris.id_user as 'usuari'
FROM Sites INNER JOIN Favorits on Sites.id_site = Favorits.site 
INNER JOIN Usuaris on Favorits.usuari = Usuaris.id_user;

CREATE VIEW VComentaris AS
SELECT Usuaris.imatge_Perfil as 'img_perfil', Usuaris.usuari as 'usuari', Comentaris.comentari as 'comentari',Comentaris.data_publicacio as 'publicat', SitesComentaris.site as 'site'
FROM Usuaris INNER JOIN UsuarisComentaris on Usuaris.id_user = UsuarisComentaris.usuari 
INNER JOIN Comentaris on UsuarisComentaris.comentari = Comentaris.id_comentari 
INNER JOIN SitesComentaris on Comentaris.id_comentari = SitesComentaris.comentari 
INNER JOIN Sites on SitesComentaris.site = Sites.id_site;

CREATE VIEW VCategories AS
SELECT Categories.id_categoria as 'categoria',Categories.nom as 'nom', Categories.descripcio as 'descripcio', Multimedia.imatge as 'imatge'
FROM Categories INNER JOIN Multimedia on Categories.id_categoria = Multimedia.categoria;

CREATE VIEW VSites AS
SELECT Sites.id_site as 'id_site',Sites.titol as 'titol', Sites.descripcio as 'descripcio', Sites.categoria as 'n_categoria', Categories.nom as 'categoria',Sites.lloc as 'lloc',Sites.imatge as 'imatge',Sites.data as 'data',Sites.usuari as 'usuari'
FROM Sites INNER JOIN Categories on Sites.categoria = Categories.id_categoria;

/*TRIGGERS*/

Delimiter //

Create Trigger SUBSCRIPCIO after Insert on Usuaris
For each row
Begin

 Declare usuari int;

 SELECT id_user INTO usuari from Usuaris ORDER BY id_user DESC LIMIT 1;
 
 INSERT INTO Subscripcio Values (null,'No Definit',0,'No Definida','NO',usuari);


End //

Delimiter //

CREATE TRIGGER IMG_CATEGORIES AFTER INSERT ON Categories

For each row
Begin

 Declare categoria int;

 SELECT id_categoria INTO categoria FROM Categories ORDER BY id_categoria DESC LIMIT 1;
 
 INSERT INTO Multimedia Values (null,null,null,null,null,categoria);


End //

/*INSERT DEL USUARI ADMININSTRADOR*/

INSERT INTO Usuaris VALUES(null,'Administrador','SportSites','Gava','Home','936541232','admin@sportsites.com','admin','202cb962ac59075b964b07152d234b70',1,1,null,0);

INSERT INTO `Categories` (`id_categoria`, `nom`, `descripcio`) VALUES
(1, 'BMX', 'Esport extrem de freestyle amb bicicleta'),
(2, 'BARS', 'Esport on poder fer exercici fisic al carrer'),
(3, 'Running', 'Esport extrem de freestyle amb bicicleta'),
(4, 'MTB', 'Esport on poder fer exercici fisic al carrer'),
(5, 'Downhill', 'Esport on poder fer exercici fisic al carrer'),
(6, 'Skate', 'Esport on poder fer exercici fisic al carrer'),
(7, 'Rollers', 'Esport on poder fer exercici fisic al carrer'),
(8, 'Escalada', 'Esport on poder fer exercici fisic al carrer'),
(9, 'BARS', 'Esport on poder fer exercici fisic al carrer'),
(10, 'Futbol', 'Esport on poder fer exercici fisic al carrer'),
(11, 'Tennis', 'Esport on poder fer exercici fisic al carrer'),
(12, 'Basquet', 'Esport on poder fer exercici fisic al carrer'),
(13, 'Handbol', 'Esport on poder fer exercici fisic al carrer'),
(14, 'Hockey Herba', 'Esport on poder fer exercici fisic al carrer'),
(15, 'Hockey Sala', 'Esport on poder fer exercici fisic al carrer'),
(16, 'Rollers', 'Esport on poder fer exercici fisic al carrer'),
(17, 'Volleyball', 'Esport on poder fer exercici fisic al carrer'),
(18, 'Softball', 'Esport on poder fer exercici fisic al carrer');

