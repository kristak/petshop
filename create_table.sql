CREATE TABLE users ( id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255), password VARCHAR(255) NOT NULL);

CREATE TABLE pets ( id INT AUTO_INCREMENT PRIMARY KEY, user_id INT NOT NULL, name VARCHAR(50), FOREIGN KEY user_key (user_id) REFERENCES users(id)
);
