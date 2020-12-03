create table products (
	id integer not null auto_increment primary key,
	sku varchar(10) not null,
	name varchar(50) not null,
	price decimal(10,2),
	unique(sku)
)
ENGINE=InnoDB;