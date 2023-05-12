START TRANSACTION;

CREATE DATABASE IF NOT EXISTS `uni_plans`;

USE `uni_plans`;

CREATE TABLE users (
  id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);

CREATE TABLE subject_plans (
  id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  description TEXT,
  owner INT(11) UNSIGNED NOT NULL,
  FOREIGN KEY (owner) REFERENCES users(id)
);

COMMIT;