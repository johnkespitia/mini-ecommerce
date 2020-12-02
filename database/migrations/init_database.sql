create table products (
	id integer not null auto_increment unsigned primary key,
	sku varchar(10) not null,
	name varchar(50) not null,
	price decimal(10,2) unsigned,
	UNIQUE KEY (sku)
)
ENGINE=InnoDB;

create table cities (
	id integer not null auto_increment unsigned  primary key,
	name varchar(50) not null,
	UNIQUE KEY (name)
)
ENGINE=InnoDB;

create table customers (
	id integer not null auto_increment unsigned primary key,
	name varchar(150) not null,
	phone varchar(12) not null,
	address varchar(150) not null,
	city_id integer unsigned not null,
	password text  not null,
	email varchar not null,
	UNIQUE KEY (sku),
	FOREIGN KEY (city_id)
        REFERENCES cities(id)
)
ENGINE=InnoDB;

create table orders (
	id integer not null auto_increment unsigned primary key,
	customer_id integer unsigned not null,
	date_order datetime not null,
	total decimal(15,2),
	FOREIGN KEY (customer_id)
        REFERENCES customers(id)
)
ENGINE=InnoDB;


create table order_items (
	id integer not null auto_increment unsigned primary key,
	order_id integer unsigned not null,
	product_id integer unsigned not null,
	product_price_sold decimal(15,2),
	product_status varchar(10),
	FOREIGN KEY (order_id)
        REFERENCES orders(id),
    FOREIGN KEY (product_id)
        REFERENCES products(id)
)
ENGINE=InnoDB;

