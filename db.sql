-- SQL file for PostgreSQL
-- To run in MySQL, changes mentioned on line 97 & 103

DROP TABLE if EXISTS admin;
DROP TABLE if EXISTS auth_book;
DROP TABLE if EXISTS borrowing;
DROP TABLE if EXISTS author;
DROP TABLE if EXISTS book;
DROP TABLE if EXISTS member;

CREATE TABLE member(
	memberID serial PRIMARY KEY,
	first_name varchar(25),
	last_name varchar(25),
	instituteID int,
	email varchar(50),
	phone varchar(15),
	address text,
	dues float,
	pass varchar(127),
	rfid varchar(15)
);

INSERT into member values
	(DEFAULT, 'Alpha', 'Bravo', 218478, 'abc@gmail.com', 1234567890, 'Nashik', 0, '$2y$10$1rweLZFwaCOPVHCj2.iMUO//RKpn0tVVQ.EZ0UsGkxIHWSkYv9hnO', '5900D4B55F67'),		-- Abcd1234
	(DEFAULT, 'Sierra', 'Tango', 218452, 'ss@hotmail.com', 9987456321, 'Pune', 1.75, '$2y$10$rvfiBSV9mPEcyqz2WM9p1ecH2HJGqvtyLuLqjDWb1BfHf4jSufryW', 'A'),			-- Jaishreeram
	(DEFAULT, 'Oscar', 'Panther', 218442, 'orcas@yahoo.com', '+91 9988776600', 'Noida', 0, '$2y$10$cm4ycs.dkJwa8FmAnHHlR.R9qav/d0rAN5y9SUk0pGv4HiTPPkJBq', '5900D4A40E27'),	-- Chipichipi
	(DEFAULT, 'Hunter', 'Golf', 218421, 'hunter@abc.com', '6543210987', 'Bhagal, Surat', 12.55, '$2y$10$zE5zM8zIcCVQAC0qvdJJLeNNcJCZB0BfWtTPHv/vUFwUW.J1YTVn6', 'C');	-- Iamsaxyy
																										-- 4 entries
	



CREATE TABLE book(
	bookID serial PRIMARY KEY,
	title varchar(100),
	isbn varchar(32),
	year int,
	copies int,
	amount int,
	rfid varchar(15)
);

INSERT into book values
	(DEFAULT, 'Harry Potter: Philosophers Stone', '9780807286005', 2001, 5, 345, '5900D4EE791A'),
	(DEFAULT, 'Harry Potter: Chamber of Secrets', '9780439064866', 2002, 12, 794, 'A'),
	(DEFAULT, 'Harry Potter: Prisoner of Azkaban', '9780439655484', 2004, 11, 479, 'A'),
	(DEFAULT, 'The Black Stallion', '9780340196878', 1975, 11, 285, 'A'),
	(DEFAULT, 'The Adventures of Sherlock Holmes', '9780192823786', 1994, 32, 150, 'A'),
																-- 5 entries
	(DEFAULT, 'To Kill a Mockingbird', '9780061120084', 1960, 5, 500, 'A'),
	(DEFAULT, '1984', '9780451524935', 1949, 3, 700, 'A'),
	(DEFAULT, 'The Great Gatsby', '9780743273565', 1925, 8, 600, 'A'),
	(DEFAULT, 'The Catcher in the Rye', '9780241950425', 1951, 2, 800, 'A'),
	(DEFAULT, 'Pride and Prejudice', '9780141439518', 1813, 6, 900, 'A'),
																-- 10 entries
	(DEFAULT, 'Crime and Punishment', '9780143107637', 1866, 6, 1100, 'A'),
	(DEFAULT, 'The Brothers Karamazov', '9780141191654', 1880, 2, 1300, 'A'),
	(DEFAULT, 'The Alchemist', '9780061120084', 1988, 1, 2400, '5900D49B796F'),
	(DEFAULT, 'Sherlock Holmes: A Study in Scarlet', '9780997720702', 1887, 3, 600, 'A'),
	(DEFAULT, 'Sherlock Holmes: The Hound of the Baskervilles', '9781503332068', 1902, 5, 750, 'A'),
																-- 15 entries
	(DEFAULT, 'Sherlock Holmes: The Sign of the Four', '9781979988764', 1890, 6, 800, 'A'),
	(DEFAULT, 'Brida', '9780061120085', 1990, 8, 1000, 'A'),
	(DEFAULT, 'Veronika Decides to Die', '9780061120086', 1998, 5, 900, 'A'),
	(DEFAULT, 'The Witch of Portobello', '9780061120087', 2006, 6, 1100, 'A'),
	(DEFAULT, 'Eleven Minutes', '9780061120088', 2003, 7, 950, 'A');
																-- 20 entries



CREATE TABLE author(
	authorID serial PRIMARY KEY,
	name varchar(50)
);

INSERT into author values
	(DEFAULT, 'J.K. Rowling'),
	(DEFAULT, 'Arthur Conan Doyle'),
	(DEFAULT, 'Jane Austen'),
	(DEFAULT, 'Harper Lee'),
	(DEFAULT, 'George Orwell'),
						-- 5 entries
	(DEFAULT, 'F. Scott Fitzgerald'),
	(DEFAULT, 'J.D. Salinger'),
	(DEFAULT, 'Fyodor Dostoevsky'),
	(DEFAULT, 'Paulo Coelho');




CREATE TABLE borrowing(
	borrowingID serial PRIMARY KEY,
	bookID int references book(bookID) ON DELETE SET NULL,
	memberID int references member(memberID) ON DELETE SET NULL,
	borrow_date date DEFAULT CURRENT_DATE,
	due_date date DEFAULT CURRENT_DATE + INTERVAL '14 days',	-- For MySQL, change to "due_date date DEFAULT (CURRENT_DATE + INTERVAL 14 DAY)"
	ret_date date
);

INSERT into borrowing values
	(DEFAULT, 2, 2, DEFAULT, DEFAULT, null),
	(DEFAULT, 1, 3, (CURRENT_DATE - INTERVAL '29 days'), (CURRENT_DATE - INTERVAL '15 days'), null),		-- For MySQL, change to "(CURRENT_DATE - INTERVAL 29 DAY)" and "(CURRENT_DATE - INTERVAL 15 DAY)"
	(DEFAULT, 4, 3, DEFAULT, DEFAULT, null),
	(DEFAULT, 10, 4, DEFAULT, DEFAULT, null),
	(DEFAULT, 17, 4, DEFAULT, DEFAULT, null);



CREATE TABLE auth_book(
	bookID int references book(bookID) ON DELETE CASCADE,
	authorID int references author(authorID) ON DELETE SET NULL
);

INSERT into auth_book values
	(1, 1),
	(4, 3),
	(5, 2),
	(2, 1),
	(3, 1),
	(6, 4),
	(7, 5),
	(8, 6),
	(9, 7),
	(10, 3),
	(11, 8),
	(12, 8),
	(13, 9),
	(14, 2),
	(15, 2),
	(16, 2),
	(17, 9),
	(18, 9),
	(19, 9),
	(20, 9);

CREATE TABLE admin(
	adminID serial PRIMARY KEY,
	admin_name varchar(127),
	admin_pass varchar(127));
	
INSERT into admin VALUES
	(DEFAULT, 'admin', '$2y$10$f2XVsq/Vn1Xxn5gBzaaf5uswjuUM5Sg0hQMB0Mj1bBS3p.Izg/d9u');			-- IamAdmin
	



SELECT * from member;
SELECT * from book;
SELECT * from author;
SELECT * from auth_book;
SELECT * from borrowing;
SELECT * FROM admin;

