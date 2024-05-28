create database mmp1;

DROP TABLE IF EXISTS newuser

CREATE TABLE newuser (
    id SERIAL PRIMARY KEY,
    email VARCHAR(50) NOT NULL,
    username VARCHAR(10) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

INSERT INTO newuser (email, username, password)
VALUES('l.pantlitschko@gmail.com, Lara, $2y$10$8FShhWtHUGcVu.I.buySneLcot7v.DJKM.3MFQMVdh2c2mi7EQYzi');

