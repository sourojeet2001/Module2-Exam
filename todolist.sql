-- Active: 1677665060185@@127.0.0.1@3306@innoraft

CREATE TABLE TODO(
    ItemId INT AUTO_INCREMENT PRIMARY KEY,
    ItemName VARCHAR(30) NOT NULL CHECK(ItemName <> "")
);

select * from TODO;