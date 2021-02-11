create table cities (
	id integer not null auto_increment  primary key,
	name varchar(50) not null,
	unique(name)
)
ENGINE=InnoDB;
