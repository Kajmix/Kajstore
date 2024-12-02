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
    is_admin TINYINT(1)
    );
CREATE TABLE products(
    id_product int PRIMARY KEY AUTO_INCREMENT NOT null,
    price int,
    name varchar(200),
    description TEXT,
    full_description TEXT,
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
    payment_method ENUM("bank_transfer","blik","paypal")
    );
CREATE TABLE bought_products(
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

INSERT INTO `users`(`first_name`, `last_name`, `password_user`, `email`, `birthdate`, `is_admin`) VALUES ('Kacper','Mizgała','fcec91509759ad995c2cd14bcb26b2720993faf61c29d379b270d442d92290eb','email@gmail.com','2009-07-14',true); #password is here

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
