create table charges (
	id integer not null auto_increment  primary key,
	user_id integer unsigned not null,
    amount_charge decimal(15,2) not null,
    date_charge datetime not null,
    FOREIGN KEY (user_id) REFERENCES users(id)
)
ENGINE=InnoDB;