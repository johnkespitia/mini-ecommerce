create table brands (
	id integer unsigned not null auto_increment  primary key,
	name varchar(20) not null, 
    unique(name)
)
ENGINE=InnoDB;