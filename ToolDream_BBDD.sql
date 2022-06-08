CREATE TABLE ALBUM(
ID_ALBUM INT AUTO_INCREMENT,
NAME_ALBUM VARCHAR(45),
ARTIST VARCHAR(30),
GENRE VARCHAR(15),
ALBUM_LABEL VARCHAR(30),
ALBUM_YEAR SMALLINT,
OWNER_SONG VARCHAR(255),
IMG VARCHAR(255),
CONSTRAINT pk_album PRIMARY KEY (ID_ALBUM)
);

CREATE TABLE PLAYLIST(
ID_PLAYLIST INT AUTO_INCREMENT,
NAME_PLAYLIST VARCHAR(30), 
OWNER_SONG VARCHAR(255),
CONSTRAINT pk_playlist PRIMARY KEY (ID_PLAYLIST)
);

CREATE TABLE SONGS(
ID_SONG INT AUTO_INCREMENT,
NAME_SONG VARCHAR(45),
URL_SONG VARCHAR (255),
OWNER_SONG VARCHAR(255),
ID_ALBUM INT,
ID_PLAYLIST INT,
CONSTRAINT pk_songs PRIMARY KEY (ID_SONG),
CONSTRAINT fk_album FOREIGN KEY (ID_ALBUM) REFERENCES ALBUM (ID_ALBUM),
CONSTRAINT fk_playlist FOREIGN KEY (ID_PLAYLIST) REFERENCES PLAYLIST (ID_PLAYLIST)
);

CREATE TABLE USER_BD(
ID_USER INT AUTO_INCREMENT,
NAME_USER VARCHAR(30),
PASS VARCHAR(255),
EMAIL VARCHAR(255),
IMG VARCHAR(255),
CONSTRAINT pk_user PRIMARY KEY (ID_USER),
CONSTRAINT uk_user UNIQUE (NAME_USER)
);