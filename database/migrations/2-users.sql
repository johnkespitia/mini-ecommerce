create table users (
	id integer unsigned not null auto_increment  primary key,
	username varchar(20) not null,
    password text not null, 
    name varchar(100) not null,
    email varchar(150) not null,
    rol_id integer unsigned not null,
    credits decimal(20,2) not null default 0,
    status tinyint(2) default 1,
    default_response ENUM('NONE', 'DECLINDED', 'APPROVED', 'REJECTED', 'BLOCKED') default 'NONE',
	unique(username),
    unique(email),
    FOREIGN KEY (rol_id) REFERENCES rols(id)
)
ENGINE=InnoDB;