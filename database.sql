-- Create the database
CREATE DATABASE IF NOT EXISTS mydb1;
USE mydb1;

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Products table
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    image_url VARCHAR(255),
    stock INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Orders table (optional but recommended)
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    total_amount DECIMAL(10, 2) NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Order items table (optional but recommended)
CREATE TABLE IF NOT EXISTS order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- Sample products for dog dishes
INSERT INTO products (name, description, price, image_url, stock) VALUES
('Chicken Chunks', 'Fresh sautéed chicken made for dogs', 12.99, 'images/chickenchunks.png', 12),
('Beef Bites', 'Beef mix formulated for active dogs.', 14.50, 'images/beefbites.png', 10),
('Veggie Bowl', 'Hand picked fresh vegetable mix for dogs.', 11.99, 'images/veggiebowl.png', 6),
('Chicken & Rice Delight', 'Premium chicken with brown rice and vegetables', 12.99, 'images/chickenrice.png', 15),
('Beef Stew Special', 'Tender beef chunks in savory gravy', 14.99, 'images/beefstew.png', 10),
('Salmon & Sweet Potato', 'Wild-caught salmon with sweet potato', 15.99, 'images/salmonpotato.png', 8);
