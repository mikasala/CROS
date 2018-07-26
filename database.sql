CREATE DATABASE cros_db;
USE cros_db;
GRANT ALL ON menagerie.* TO 'root'@'localhost';

CREATE TABLE IF NOT EXISTS users(
	userid int(10) unsigned not null auto_increment,
	fname tinytext not null,
	lname tinytext not null,
	email tinytext not null,
	birthdate date not null,
	usertype tinytext not null,
	password tinytext not null,
	PRIMARY KEY (userid)
)ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=2386;

CREATE TABLE IF NOT EXISTS products(
	productid int(10) unsigned not null auto_increment,
	productcode tinytext not null,
	image_name tinytext not null,
	image_url tinytext not null,
	name tinytext not null,
	clothtype tinytext not null,
	quantity smallint(5) unsigned not null,
	description tinytext not null,
	size_fit tinytext not null,
	min_chest int(3) unsigned not null,
	max_chest int(3) unsigned not null,
	min_waist int(3) unsigned not null,
	max_waist int(3) unsigned not null,
	overall_length int(3) unsigned not null,
	amount double unsigned not null,
	category tinytext not null,
	PRIMARY KEY (productid)
)ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=3987;

CREATE TABLE IF NOT EXISTS orders(
	ordernum int(10) unsigned not null auto_increment,
	refnum tinytext not null,
	userid int(10) unsigned not null,
	date_created datetime not null,
	delivery_date datetime not null,
	address tinytext not null,
	contactno tinytext not null,
	mode_of_pay tinytext not null,
	total_amount double unsigned not null,
	status tinytext not null,
	PRIMARY KEY (ordernum),
	FOREIGN KEY (userid) REFERENCES users(userid)
)ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1110;

CREATE TABLE IF NOT EXISTS orderedproducts(
	orderprodid int(10) unsigned not null auto_increment,
	ordernum int(10) unsigned not null,
	productid int(10) unsigned not null,
	PRIMARY KEY (orderprodid),
	FOREIGN KEY (ordernum) REFERENCES orders(ordernum),
	FOREIGN KEY (productid) REFERENCES products(productid)
)ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1110;


INSERT INTO users (email,fname,lname,password,usertype)
VALUES('alphsa01@gmail.com','Marlo Ian','Kasala','10470c3b4b1fed12c3baac014be15fac67c6e815','admin');
