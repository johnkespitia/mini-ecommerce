create table documents (
	id integer unsigned not null auto_increment  primary key,
	document_type integer unsigned not null, 
	car integer unsigned not null, 
	url varchar(200) not null, 
    date_created date not null,
    date_expiration date,
    CONSTRAINT `fk_document_type` FOREIGN KEY (document_type) REFERENCES document_types(id),
    CONSTRAINT `fk_car_document` FOREIGN KEY (car) REFERENCES cars(id)
)
ENGINE=InnoDB;