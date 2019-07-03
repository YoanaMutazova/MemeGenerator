DROP TABLE IF EXISTS templates;
DROP TABLE IF EXISTS upload_images;
DROP DATABASE IF EXISTS meme_generator;

CREATE DATABASE meme_generator CHARACTER SET utf8 COLLATE utf8_general_ci;


CREATE TABLE templates (
    id int(11) NOT NULL AUTO_INCREMENT,
    image longblob NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE upload_images (
    id int(11) NOT NULL AUTO_INCREMENT,
    image longblob NOT NULL,
    PRIMARY KEY (id)
);
