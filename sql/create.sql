DROP SCHEMA IF EXISTS textapi;
CREATE SCHEMA textapi;
USE
    textapi;

--
-- bestemmie table
--
DROP TABLE IF EXISTS text;
CREATE TABLE text
(
    id      INT AUTO_INCREMENT PRIMARY KEY,
    text    VARCHAR(1024) NOT NULL,
    created TIMESTAMP     NOT NULL
);
