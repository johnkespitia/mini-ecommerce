create table employees (
	id integer unsigned not null auto_increment  primary key,
	name varchar(150) not null,
    dni varchar(12) not null,
    email varchar(150) not null,
    status tinyint(2) default 1,
	unique(dni)
)
ENGINE=InnoDB;