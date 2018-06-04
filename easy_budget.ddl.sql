DROP DATABASE	IF EXISTS m133_easy_budget;

CREATE DATABASE IF NOT EXISTS m133_easy_budget;

USE m133_easy_budget;

CREATE TABLE users(
	id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    firstname varchar(255) NOT NULL,
    surname  varchar(255) NOT NULL,
    email  varchar(255) NOT NULL,
    username  varchar(255) NOT NULL,
    pass char(64) NOT NULL,
    uid int(11) NOT NULL
);

INSERT INTO
    users(firstname, surname, email, username, pass, uid)
VALUES
    ('Marco', 'Schneider', 'marco-schneider@hispeed.ch', 'maschneider', 'D3751D33F9CD5049C4AF2B462735457E4D3BAF130BCBB87F389E349FBAEB20B9', 1);