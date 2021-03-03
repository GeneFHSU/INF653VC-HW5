/*INF653_VC_Back-End Web Development I - Homework 4*/
/*Feb 21, 2021*/
/*Creates the two tables for use with the Applying MVC Assignment ToDo List Assignment.*/

-- create and select the database
CREATE DATABASE IF NOT EXISTS todolist
    COLLATE utf8mb4_general_ci;
USE todolist;

-- create the tables for the database
-- Create todoitems table
CREATE TABLE todoitems (
                           ItemNum           INT            NOT NULL   AUTO_INCREMENT,
                           Title             VARCHAR(20)    NOT NULL,
                           Description       VARCHAR(50)    NOT NULL,
                           categoryID        INT            NOT NULL,
                           PRIMARY KEY (ItemNum)
);

-- Create table categories
CREATE TABLE categories (
                            categoryID        INT            NOT NULL   AUTO_INCREMENT,
                            categoryName      VARCHAR(20)    NOT NULL,
                            PRIMARY KEY (categoryID)
);

-- Add foreign key constraint to todoitems table for categories
-- ALTER TABLE todoitems
--    ADD FOREIGN KEY (categoryID) REFERENCES categories(categoryID);

-- create user named root without a password
CREATE USER IF NOT EXISTS 'root'@'localhost';

-- grant user access to todolist database
GRANT SELECT, INSERT, UPDATE, DELETE
    ON todolist.*
    TO root@localhost;