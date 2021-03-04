create table images (
	id integer unsigned not null auto_increment  primary key,
	car integer unsigned not null,
    url varchar(200) not null,
    CONSTRAINT `fk_image_car` FOREIGN KEY (car) REFERENCES cars(id)
)
ENGINE=InnoDB;