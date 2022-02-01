CREATE DATABASE IF NOT EXISTS test;
USE test;

CREATE TABLE IF NOT EXISTS FizzBuzz
(
  `id`         int NOT NULL AUTO_INCREMENT,
  `message`     varchar(10),
  PRIMARY KEY (`id`)
);