create table history (
	id integer not null auto_increment  primary key,
	user_id integer unsigned not null,
    raw_request text not null,
    raw_response text null,
    date_request datetime not null,
    cost_request decimal(10,2) not null,
    FOREIGN KEY (user_id) REFERENCES users(id)
)
ENGINE=InnoDB;