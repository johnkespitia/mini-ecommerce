create table report_groups (
	id integer unsigned not null auto_increment  primary key,
	date_report date not null,
    service_type varchar(50), 
    area varchar(20), 
    customer integer unsigned not null,
    car integer unsigned null, 
    FOREIGN KEY (car) REFERENCES cars(id),
    FOREIGN KEY (customer) REFERENCES customers(id)
)
ENGINE=InnoDB;