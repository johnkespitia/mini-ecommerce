create table general_settings (
	id integer not null auto_increment  primary key,
	name varchar(20) not null,
    value text not null,
    status tinyint(2) default 1,
    unique(name)

)
ENGINE=InnoDB;