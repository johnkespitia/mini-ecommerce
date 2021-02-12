create table daily_reports (
	id integer unsigned not null auto_increment  primary key,
	date_report date not null,
    car integer unsigned null, 
    customer integer unsigned not null,
    employe integer unsigned not null,
    time_start_am decimal(4,2) unsigned not null,
    time_end_am decimal(4,2) unsigned not null,
    time_start_pm decimal(4,2) unsigned not null,
    time_end_pm decimal(4,2) unsigned not null,
    lunch_time decimal(4,2) not null,
    service_type varchar(20), 
    area varchar(20), 
    worked_hours decimal(4,2),
    abble_hours decimal(4,2),
    km_start integer,
    km_end integer,
    people tinyint
)
ENGINE=InnoDB;