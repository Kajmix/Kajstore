DROP DATABASE if EXISTS Kajstore;
CREATE DATABASE Kajstore;
USE Kajstore;
CREATE TABLE users(
	id_user int PRIMARY KEY AUTO_INCREMENT NOT null,
    first_name varchar(100),
    last_name varchar(100),
    password_user TEXT,
    email varchar(200),
    birthdate date,
    photo_path TEXT DEFAULT "default.png",
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    is_admin TINYINT(1) DEFAULT 0
    );
CREATE TABLE products(
    id_product int PRIMARY KEY AUTO_INCREMENT NOT null,
    price int,
    name varchar(200),
    description TEXT,
    file_path TEXT,
    photo_path TEXT DEFAULT "ina.png"
    );
CREATE TABLE carts(
    id_cart int PRIMARY KEY AUTO_INCREMENT NOT null,
    id_user int,
    id_product int
    );

CREATE TABLE orders(
    id_order int PRIMARY KEY AUTO_INCREMENT NOT null,
    id_user int,
    id_product int,
    ordered TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    payment_method ENUM("bank_transfer","blik","paypal")
    );
CREATE TABLE bought_products(
    id_bought_products int PRIMARY KEY NOT null AUTO_INCREMENT,
    id_user int,
    id_product int
    );

ALTER TABLE carts
ADD FOREIGN KEY (id_user) REFERENCES users(id_user),
ADD FOREIGN KEY (id_product) REFERENCES products(id_product);
ALTER TABLE bought_products
ADD FOREIGN KEY (id_user) REFERENCES users(id_user),
ADD FOREIGN KEY (id_product) REFERENCES products(id_product);
ALTER TABLE orders
ADD FOREIGN KEY (id_user) REFERENCES users(id_user),
ADD FOREIGN KEY (id_product) REFERENCES products(id_product);

DELIMITER //
CREATE PROCEDURE ProcessOrder(IN user_id INT, IN payment ENUM('bank_transfer','blik','paypal'))
BEGIN
    INSERT INTO orders (id_user, payment_method) VALUES (user_id, payment);
    
    INSERT INTO bought_products (id_user, id_product)
    SELECT id_user, id_product FROM carts WHERE id_user = user_id;
    
    DELETE FROM carts WHERE id_user = user_id;
END //
DELIMITER ;

DELIMITER //

CREATE PROCEDURE DeleteProduct(IN product_id INT)
BEGIN
    DELETE FROM carts WHERE id_product = product_id;
    
    DELETE FROM orders WHERE id_product = product_id;
    
    DELETE FROM bought_products WHERE id_product = product_id;
    
    DELETE FROM products WHERE id_product = product_id;
END //

DELIMITER ;

INSERT INTO users (first_name, last_name, password_user, email, birthdate, is_admin)
VALUES 
('John', 'Doe', 'password123', 'john.doe@example.com', '1985-06-15', 0),
('Jane', 'Smith', 'mypassword', 'jane.smith@example.com', '1990-12-22', 1),
('Alice', 'Johnson', 'alice123', 'alice.johnson@example.com', '1982-04-05', 0),
('Bob', 'Brown', 'bobbrown2024', 'bob.brown@example.com', '1978-09-19', 0),
('Charlie', 'Davis', 'charlie2024', 'charlie.davis@example.com', '1995-02-11', 0),
('Emily', 'Miller', 'emily1999', 'emily.miller@example.com', '1999-07-30', 0),
('David', 'Wilson', 'davids123', 'david.wilson@example.com', '1987-03-09', 0),
('Sophia', 'Taylor', 'sophiat123', 'sophia.taylor@example.com', '1993-08-23', 1),
('Lucas', 'Martinez', 'lucas1990', 'lucas.martinez@example.com', '1990-01-05', 0),
('Olivia', 'Anderson', 'olivia123', 'olivia.anderson@example.com', '2000-05-17', 0);

INSERT INTO products (price, name, description)
VALUES 
(100, 'Product 1', 'Description of Product 1'),
(150, 'Product 2', 'Description of Product 2'),
(200, 'Product 3', 'Description of Product 3'),
(120, 'Product 4', 'Description of Product 4'),
(180, 'Product 5', 'Description of Product 5'),
(250, 'Product 6', 'Description of Product 6'),
(90, 'Product 7', 'Description of Product 7'),
(110, 'Product 8', 'Description of Product 8'),
(130, 'Product 9', 'Description of Product 9'),
(160, 'Product 10', 'Description of Product 10'),
(200, 'Product 11', 'Description of Product 11'),
(220, 'Product 12', 'Description of Product 12'),
(180, 'Product 13', 'Description of Product 13'),
(210, 'Product 14', 'Description of Product 14'),
(140, 'Product 15', 'Description of Product 15'),
(170, 'Product 16', 'Description of Product 16'),
(160, 'Product 17', 'Description of Product 17'),
(190, 'Product 18', 'Description of Product 18'),
(180, 'Product 19', 'Description of Product 19'),
(210, 'Product 20', 'Description of Product 20'),
(130, 'Product 21', 'Description of Product 21'),
(220, 'Product 22', 'Description of Product 22'),
(150, 'Product 23', 'Description of Product 23'),
(230, 'Product 24', 'Description of Product 24'),
(120, 'Product 25', 'Description of Product 25'),
(140, 'Product 26', 'Description of Product 26'),
(160, 'Product 27', 'Description of Product 27'),
(200, 'Product 28', 'Description of Product 28'),
(210, 'Product 29', 'Description of Product 29'),
(180, 'Product 30', 'Description of Product 30'),
(190, 'Product 31', 'Description of Product 31'),
(150, 'Product 32', 'Description of Product 32'),
(170, 'Product 33', 'Description of Product 33'),
(160, 'Product 34', 'Description of Product 34'),
(180, 'Product 35', 'Description of Product 35'),
(220, 'Product 36', 'Description of Product 36'),
(250, 'Product 37', 'Description of Product 37'),
(230, 'Product 38', 'Description of Product 38'),
(200, 'Product 39', 'Description of Product 39'),
(180, 'Product 40', 'Description of Product 40'),
(170, 'Product 41', 'Description of Product 41'),
(190, 'Product 42', 'Description of Product 42'),
(210, 'Product 43', 'Description of Product 43'),
(240, 'Product 44', 'Description of Product 44'),
(230, 'Product 45', 'Description of Product 45'),
(160, 'Product 46', 'Description of Product 46'),
(220, 'Product 47', 'Description of Product 47'),
(250, 'Product 48', 'Description of Product 48'),
(230, 'Product 49', 'Description of Product 49'),
(210, 'Product 50', 'Description of Product 50');
