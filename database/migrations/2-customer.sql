create table customers (
	id integer not null auto_increment primary key,
	name varchar(150) not null,
	phone varchar(12) not null,
	address varchar(150) not null,
	city_id integer not null,
	password text  not null,
	email varchar(120) not null,
	unique(email),
	CONSTRAINT `fk_city` FOREIGN KEY (city_id) REFERENCES cities(id)
)
ENGINE=InnoDB;