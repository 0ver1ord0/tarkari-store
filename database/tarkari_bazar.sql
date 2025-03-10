create database tarkari_bazar;
use tarkari_bazar;
-- Users Table: Stores user info for both admin and regular users
CREATE TABLE Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    phone_number VARCHAR(15) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user',  -- Differentiates between admin and regular users
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- Vegetables Table: Stores vegetable details
CREATE TABLE Vegetables (
    vegetable_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,  -- Price of vegetable
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Cart Table: Stores cart items with user ID, vegetable ID, and quantity
CREATE TABLE Cart (
    cart_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,  -- Foreign key to Users
    vegetable_id INT NOT NULL,  -- Foreign key to Vegetables
    quantity INT NOT NULL,  -- Quantity of the vegetable selected
    FOREIGN KEY (user_id) REFERENCES Users(user_id),
    FOREIGN KEY (vegetable_id) REFERENCES Vegetables(vegetable_id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE Vegetables ADD COLUMN image VARCHAR(255) NULL;

