create table rols (
	id integer unsigned  not null auto_increment  primary key,
	name varchar(50) not null,
	unique(name)
)
ENGINE=InnoDB;