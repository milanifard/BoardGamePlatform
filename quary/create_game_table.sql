CREATE TABLE room(
    roomID int  primary key NOT NULL AUTO_INCREMENT,
    managerID int,
    status ENUM('Accepting', 'Playing', 'Empty')
);

CREATE TABLE game(
    roomID int,
    userID int,
    CONSTRAINT Constraint_name PRIMARY KEY (roomID, userID)
);

CREATE TABLE game_request(
    roomID int,
    userID int,
    status ENUM('Accepted', 'Denied', 'Waiting'),
    CONSTRAINT Constraint_name PRIMARY KEY (roomID, userID)
);

CREATE TABLE chat (
	idchat INT NOT NULL AUTO_INCREMENT,
    roomID int,
    userID int,
    msg VARCHAR(100) NULL,
    PRIMARY KEY (idchat)
);