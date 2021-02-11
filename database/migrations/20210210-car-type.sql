create table car_types (
	id integer unsigned not null auto_increment  primary key,
	name varchar(30) not null,
    status tinyint(2) default 1,
	unique(name)
)
ENGINE=InnoDB;