cREATE DATABASE universitate_db;
GRANT ALL PRIVILEGES ON universitate_db.* TO 'marina'@'localhost'  IDENTIFIED BY 'parola';

CREATE TABLE IF NOT EXISTS ADMIN(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user CHAR(50) NOT NULL,
    parola CHAR(80) NOT NULL
);

CREATE TABLE IF NOT EXISTS PROFESOR(
	idProfesor INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nume CHAR(50) NOT NULL,
    mail CHAR(50) NOT NULL,
    telefon CHAR(50) NOT NULL,
    fax CHAR(50) NOT NULL,
    pagWeb CHAR(200) NOT NULL,
    grad CHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS ANUNTURI(
    idAnunt INT(11) NOT NULL AUTO_INCREMENT,
    denumire VARCHAR(255) NOT NULL,
    continut MEDIUMTEXT NOT NULL,
    dataPostarii DATE,
    PRIMARY KEY (idAnunt) 
);

CREATE TABLE IF NOT EXISTS CATEGORII(
	idCategoie INT(11) NOT NULL AUTO_INCREMENT,
    denumire VARCHAR(255) NOT NULL,
    PRIMARY KEY (idCategorie)
);



CREATE TABLE IF NOT EXISTS ANUNTURICATEGORII(
    idAC INT NOT NULL AUTO_INCREMENT,
    idAnunt INT(11),
    idCategorie INT(11),
	FOREIGN KEY (idAnunt) REFERENCES ANUNTURI(idAnunt),
    FOREIGN KEY (idCategorie) REFERENCES CATEGORII(idCategorie),
    PRIMARY KEY (idAC)
);

INSERT INTO ADMIN(user,parola)
VALUES ('marina',md5('parola'))


INSERT INTO anunturi(denumire,continut,dataPostarii)
VALUES ('Anunt1', 'continut anunt1',CURDATE()),
('Anunt2', 'continut anunt2',CURDATE() ),
('Anunt3', 'continut anunt3',CURDATE() ),
('Anunt4', 'continut anunt4',CURDATE() );

INSERT INTO categorii(denumire)
VALUES ('Stire'),
	('Eveniment'),
    ('Oferta');


INSERT INTO anunturicategorii(idAnunt,idCategorie)
VALUES (1,1),
		(1,2),
        (1,3),
        (2,3),
        (3,1),
        (3,3),
        (4,2);


-- SELECT anunturi.denumire, anunturi.continut, anunturi.dataPostarii FROM anunturicategorii
-- INNER JOIN anunturi
-- ON anunturicategorii.idAnunt = anunturi.idAnunt
-- INNER JOIN categorii
-- ON anunturicategorii.idCategorie = categorii.idCategorie
-- WHERE categorii.denumire = 'Stire';

-- SELECT categorii.denumire FROM anunturicategorii
--             INNER JOIN categorii
--             ON anunturicategorii.idCategorie = categorii.idCategorie
--             WHERE anunturicategorii.idAC = 18;