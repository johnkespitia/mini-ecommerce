create table cars (
	id integer unsigned not null auto_increment  primary key,
	dni varchar(7) not null,
    car_type integer unsigned not null, 
    modelo varchar(4) not null,
    status tinyint(2) default 1,
	unique(dni),
    FOREIGN KEY (car_type) REFERENCES car_types(id)
)
ENGINE=InnoDB;