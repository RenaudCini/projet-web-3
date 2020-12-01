#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: roles
#------------------------------------------------------------

CREATE TABLE roles
(
    id  Int Auto_increment NOT NULL,
    nom Varchar(50)        NOT NULL,
    CONSTRAINT roles_PK PRIMARY KEY (id)
) ENGINE = InnoDB;


#------------------------------------------------------------
# Table: utilisateurs
#------------------------------------------------------------

CREATE TABLE utilisateurs
(
    id                 Int Auto_increment NOT NULL,
    pseudo             Varchar(50)        NOT NULL,
    mail               Varchar(50)        NOT NULL,
    mdp                Varchar(50)        NOT NULL,
    date_inscription   Datetime           NOT NULL,
    derniere_connexion Datetime           NOT NULL,
    id_roles           Int                NOT NULL,
    CONSTRAINT utilisateur_PK PRIMARY KEY (id),
    CONSTRAINT utilisateur_roles_FK FOREIGN KEY (id_roles) REFERENCES roles (id)
) ENGINE = InnoDB;


#------------------------------------------------------------
# Table: recettes
#------------------------------------------------------------

CREATE TABLE recettes
(
    id              Int Auto_increment NOT NULL,
    titre           Varchar(50)        NOT NULL,
    difficulte      Int                NOT NULL,
    budget          Int                NOT NULL,
    temps           Varchar(50)        NOT NULL,
    date            Datetime           NOT NULL,
    image           Varchar(50)        NOT NULL,
    id_utilisateurs Int                NOT NULL,
    CONSTRAINT recettes_PK PRIMARY KEY (id),
    CONSTRAINT recettes_utilisateur_FK FOREIGN KEY (id_utilisateurs) REFERENCES utilisateurs (id)
) ENGINE = InnoDB;


#------------------------------------------------------------
# Table: etapes
#------------------------------------------------------------

CREATE TABLE etapes
(
    id          Int Auto_increment NOT NULL,
    no_etape    Int                NOT NULL,
    contenu     Varchar(50)        NOT NULL,
    id_recettes Int                NOT NULL,
    CONSTRAINT recettes_p_PK PRIMARY KEY (id),
    CONSTRAINT etapes_recettes_FK FOREIGN KEY (id_recettes) REFERENCES recettes (id)
) ENGINE = InnoDB;


#------------------------------------------------------------
# Table: ingredients
#------------------------------------------------------------

CREATE TABLE ingredients
(
    id    Int Auto_increment NOT NULL,
    nom   Varchar(50)        NOT NULL,
    image Varchar(50)        NOT NULL,
    CONSTRAINT ingredients_PK PRIMARY KEY (id)
) ENGINE = InnoDB;


#------------------------------------------------------------
# Table: liste
#------------------------------------------------------------

CREATE TABLE listes
(
    id              Int Auto_increment NOT NULL,
    quantite        Int                NOT NULL,
    id_utilisateurs Int                NOT NULL,
    CONSTRAINT liste_PK PRIMARY KEY (id),
    CONSTRAINT liste_utilisateur_FK FOREIGN KEY (id_utilisateurs) REFERENCES utilisateurs (id)
) ENGINE = InnoDB;


#------------------------------------------------------------
# Table: mesure
#------------------------------------------------------------

CREATE TABLE mesures
(
    id  Int Auto_increment NOT NULL,
    nom Varchar(50)        NOT NULL,
    CONSTRAINT mesure_PK PRIMARY KEY (id)
) ENGINE = InnoDB;


#------------------------------------------------------------
# Table: compositions
#------------------------------------------------------------

CREATE TABLE compositions
(
    id_recettes    Int NOT NULL,
    id_ingredients Int NOT NULL,
    id_mesures     Int NOT NULL,
    quantite       Int NOT NULL,
    CONSTRAINT compositions_PK PRIMARY KEY (id_recettes, id_ingredients, id_mesures),
    CONSTRAINT compositions_recettes_FK FOREIGN KEY (id_recettes) REFERENCES recettes (id),
    CONSTRAINT compositions_ingredients0_FK FOREIGN KEY (id_ingredients) REFERENCES ingredients (id),
    CONSTRAINT compositions_mesure1_FK FOREIGN KEY (id_mesures) REFERENCES mesures (id)
) ENGINE = InnoDB;


#------------------------------------------------------------
# Table: commentaires
#------------------------------------------------------------

CREATE TABLE commentaires
(
    id              Int         NOT NULL,
    id_recettes     Int         NOT NULL,
    id_utilisateurs Int         NOT NULL,
    note            Varchar(50) NOT NULL,
    contenu         Varchar(50) NOT NULL,
    date            Datetime    NOT NULL,
    CONSTRAINT ingredients_PK PRIMARY KEY (id),
    CONSTRAINT commentaires_PK PRIMARY KEY (id_recettes, id_utilisateurs),
    CONSTRAINT commentaires_recettes_FK FOREIGN KEY (id_recettes) REFERENCES recettes (id),
    CONSTRAINT commentaires_utilisateurs0_FK FOREIGN KEY (id_utilisateurs) REFERENCES utilisateurs (id)

) ENGINE = InnoDB;


SELECT * FROM recettes AS r INNER JOIN utilisateurs AS u ON r.id_utilisateurs = u.id ORDER BY r.id DESC limit 3

INSERT INTO mesures (nom) VALUES
('gramme(s)'),
('kilogramme(s)'),
('pincée(s)'),
('cuillère(s) à café'),
( 'cuillère(s) à soupe'),
('litre(s)'),
('centilitre(s)');

INSERT INTO utilisateurs (id, pseudo, mail, mdp, date_inscription, derniere_connexion, id_roles) VALUES (NULL, 'AdamSky', 'adamsky@mail.com', '123456', '2020-12-01 04:07:10', '', '1');

INSERT INTO recettes (id, titre, difficulte, budget, temps, date, image, id_utilisateurs) VALUES (NULL, 'Sauté de boeuf', '3', '4', '45 min', '2020-12-01 09:12:11', '', '1');

INSERT INTO roles (id, nom) VALUES (NULL, 'Administrateur');
