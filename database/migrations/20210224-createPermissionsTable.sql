create table permissions (
	id integer unsigned not null auto_increment  primary key,
	rol_id integer unsigned not null,
    permission varchar(20) not null, 
    module varchar(20) not null, 
    status tinyint,
    unique(rol_id,permission,module),
    CONSTRAINT `fk_permission_rol` FOREIGN KEY (rol_id) REFERENCES rols(id)
)
ENGINE=InnoDB;