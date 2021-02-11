create table users (
	id integer unsigned not null auto_increment  primary key,
	username varchar(20) not null,
    password text not null, 
    name varchar(100) not null,
    email varchar(150) not null,
    rol_id integer unsigned not null,
    status tinyint(2) default 1,
	unique(username),
    unique(email),
    FOREIGN KEY (rol_id) REFERENCES rols(id)
)
ENGINE=InnoDB;