CREATE DATABASE twosuitcases;

use twosuitcases;

	CREATE TABLE things_to_pack (
		id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		luggage VARCHAR(50) NOT NULL,
		category VARCHAR(50) NOT NULL,
		item VARCHAR(50) NOT NULL,
		description VARCHAR(200)
		);
