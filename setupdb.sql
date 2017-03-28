--DROP DATABASE qrcontest;
--CREATE DATABASE qrcontest;
--USE qrcontest;

CREATE TABLE qrs(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name TEXT,
    data TEXT,
    url TEXT,
    value INT,
    active INT
);

CREATE TABLE users(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name TEXT,
    login TEXT,
    class TEXT,
    password TEXT,
    points INT,
    signuptime DATETIME,
    lastonlinetime DATETIME,
    superuser INT
);

CREATE TABLE collectedqrs(
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_user INT,
    id_qr INT,
    time DATETIME,
    CONSTRAINT fk_user FOREIGN KEY (id_user) REFERENCES users(id),
    CONSTRAINT fk_qr FOREIGN KEY (id_qr) REFERENCES qrs(id)
);

INSERT INTO users(`id`, `name`, `login`, `class`, `password`, `points`, `signuptime`, `lastonlinetime`, `superuser`) VALUES (NULL, 'Roman', 'TypowyRoman', '3TI', '$2y$10$410ehabvJ2J5AWrtO2wWCuTCGblDCTNtDVw/O0qCO4RPTA.oBlvK.', '0', NOW(), NOW(), '1');


