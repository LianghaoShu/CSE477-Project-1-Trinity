-- You should be able to just copy-paste this whole file into phpMyAdmin and be good to go!
-- REMEMBER TO ADD YOUR TABLE PREFIX THOUGH!!

-- Create the game table
CREATE TABLE game (id int(11) NOT NULL AUTO_INCREMENT, game longtext, PRIMARY KEY (id));

-- Create the player table
CREATE TABLE player (gameid int(11) NOT NULL, userid int(11) NOT NULL, PRIMARY KEY (userid));

-- Create Users Table
CREATE TABLE user (id int(11) NOT NULL AUTO_INCREMENT, email varchar(200) NOT NULL, name varchar(100) NOT NULL, phone varchar(20) NOT NULL, address text NOT NULL, notes text NOT NULL, password varchar(64) NOT NULL, joined datetime NOT NULL, role char(1) NOT NULL, salt char(16), PRIMARY KEY (id), UNIQUE INDEX (email));

-- Create Validator Table
CREATE TABLE validator (userid int(11) NOT NULL, validator char(32) NOT NULL, `date` datetime NOT NULL, PRIMARY KEY (validator), INDEX (userid));

-- Create Lobby Table
CREATE TABLE lobby (lobbyid int(11) NOT NULL AUTO_INCREMENT, name varchar(100) NOT NULL, numplayer int(6) NOT NULL, gameId int(11) NOT NULL, PRIMARY KEY (lobbyid));

-- Create GamePlayer Table
CREATE TABLE GamePlayer (gameid int(11) NOT NULL AUTO_INCREMENT, owen int(11) NOT NULL UNIQUE, mccullen int(11) NOT NULL, onsay int(11) NOT NULL , enbody int(11) NOT NULL, plum int(11) NOT NULL, day int(11) NOT NULL, PRIMARY KEY (gameid), UNIQUE INDEX (gameid));
