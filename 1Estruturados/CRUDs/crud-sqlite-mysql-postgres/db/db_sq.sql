CREATE TABLE IF NOT EXISTS customers (
  id integer primary key autoincrement not null,
  name text NOT NULL,
  email text NOT NULL,
  city text NOT NULL
);

INSERT INTO customers (id, name, email, city) VALUES
(1, 'Jim Connor', 'jimconnor@yahoo.com', 'Las Vegas'),
(2, 'Taylor Fox', 'taylorfox@hotmail.com', 'San Francisco'),
(3, 'Daniel Greyson', 'danielgreyson@hotmail.com', 'New York'),
(4, 'Julia Brown', 'juliabrown@gmail.com', 'Los Angeles'),
(5, 'Rose Harris', 'roseharris@gmail.com', 'New York'),
(6, 'Lilly Whites', 'lillywhites@outlook.com', 'New York'),
(7, 'Jennifer Winters', 'jennie.winters001@gmail.com', 'Miami'),
(8, 'Michael Bruce', 'michaelbruce78@yahoo.com', 'Los Angeles'),
(9, 'John Alex', 'johnalex@example.com', 'Chicago'),
(10, 'Demi Milan', 'demimilan@gmail.com', 'Austin'),
(11, 'Austin Joseph', 'austin.joseph.boston@gmail.com', 'Boston'),
(12, 'Mark Higgins', 'mark.higgins21@yahoo.com', 'Houston'),
(13, 'Sean Kennedy', 'seankennedy.boss@outlook.com', 'Seattle');
