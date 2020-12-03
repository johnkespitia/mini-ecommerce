create table orders (
	id integer not null auto_increment primary key,
	customer_id integer not null,
	date_order datetime not null,
	total decimal(15,2),
	CONSTRAINT `fk_customer` FOREIGN KEY (customer_id) REFERENCES customers(id)
)
ENGINE=InnoDB;