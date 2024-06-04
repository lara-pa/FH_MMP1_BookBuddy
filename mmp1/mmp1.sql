-- Author: Lara Pantlitschko
-- MultiMediaTechnology / FH Salzburg
-- Purpose: MultiMediaProjekt 1

create database mmp1;

DROP TABLE IF EXISTS readlist;
DROP TABLE IF EXISTS comments;
DROP TABLE IF EXISTS friends;
DROP TABLE IF EXISTS newuser;

CREATE TABLE newuser (
    user_id SERIAL PRIMARY KEY,
    email VARCHAR(50) NOT NULL,
    username VARCHAR(30) NOT NULL UNIQUE,
    password VARCHAR(70) NOT NULL
);

CREATE TABLE readlist (
    readlist_id SERIAL PRIMARY KEY,
    user_id INT NOT NULL,
    list_name VARCHAR(30) NOT NULL,
    books JSON NOT NULL,
    FOREIGN KEY (user_id) REFERENCES newuser(user_id)
);

CREATE TABLE comments(
    comment_id SERIAL PRIMARY KEY,
    user_id INT NOT NULL,
    comments VARCHAR(500) NOT NULL,
    books JSON NOT NULL,
    FOREIGN KEY (user_id) REFERENCES newuser(user_id)
)

CREATE TABLE friends (
    user_id INT,
    friend_id INT,
    status VARCHAR(20) NOT NULL CHECK (status IN ('waiting', 'accepted', 'declined')),
    FOREIGN KEY (user_id) REFERENCES newuser(user_id),
    FOREIGN KEY (friend_id) REFERENCES newuser(user_id)
);
