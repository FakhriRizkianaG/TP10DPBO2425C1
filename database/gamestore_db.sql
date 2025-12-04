-- Skrip SQL untuk membuat basis data gamestore_db
-- Asumsi menggunakan MySQL atau sintaks SQL yang serupa

-- Buat basis data (jika belum ada)
CREATE DATABASE IF NOT EXISTS gamestore_db;
USE gamestore_db;

-- -----------------------------------------------------
-- 1. Tabel Users
-- -----------------------------------------------------
CREATE TABLE Users (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Nama VARCHAR(255) NOT NULL,
    Join_Date DATE NOT NULL
);

-- -----------------------------------------------------
-- 2. Tabel Developers
-- Pemilik memiliki Foreign Key ke Users.ID
-- -----------------------------------------------------
CREATE TABLE Developers (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Nama VARCHAR(255) NOT NULL,
    Pemilik_ID INT NOT NULL,
    FOREIGN KEY (Pemilik_ID) REFERENCES Users(ID)
);

-- -----------------------------------------------------
-- 3. Tabel Engines
-- -----------------------------------------------------
CREATE TABLE Engines (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Nama VARCHAR(255) NOT NULL,
    Bahasa_Utama VARCHAR(100)
);

-- -----------------------------------------------------
-- 4. Tabel Games
-- Memiliki Foreign Key ke Developers.ID dan Engines.ID
-- -----------------------------------------------------
CREATE TABLE Games (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Nama VARCHAR(255) NOT NULL,
    Genre VARCHAR(100),
    Developer_ID INT NOT NULL,
    Engine_ID INT NOT NULL,
    FOREIGN KEY (Developer_ID) REFERENCES Developers(ID),
    FOREIGN KEY (Engine_ID) REFERENCES Engines(ID)
);

-- -----------------------------------------------------
-- Contoh Data (Opsional: untuk menguji struktur)
-- -----------------------------------------------------

-- Insert data ke Users
INSERT INTO Users (Nama, Join_Date) VALUES
('Rizky Aditya', '2023-01-15'),
('Siti Nuraini', '2022-11-01');

-- Insert data ke Developers
-- Rizky Aditya (ID 1) adalah pemilik Developer A
-- Siti Nuraini (ID 2) adalah pemilik Developer B
INSERT INTO Developers (Nama, Pemilik_ID) VALUES
('Developer A Studios', 1),
('Indie Game House', 2);

-- Insert data ke Engines
INSERT INTO Engines (Nama, Bahasa_Utama) VALUES
('Unity', 'C#'),
('Unreal Engine', 'C++');

-- Insert data ke Games
-- Game 1: Developer A (ID 1), Engine Unity (ID 1)
-- Game 2: Indie Game House (ID 2), Engine Unreal (ID 2)
INSERT INTO Games (Nama, Genre, Developer_ID, Engine_ID) VALUES
('Shadow Runner', 'Action RPG', 1, 1),
('Mystic Farm', 'Simulation', 2, 2);