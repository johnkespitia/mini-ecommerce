create table contacts (
	id integer not null auto_increment primary key,
    title VARCHAR(50) NOT NULL,
	order_id integer null,
	user_id integer unsigned not null,
    customer_id integer not null,
	datetime_start datetime not null,
    datetime_end datetime not null,
	description text,
    type enum('Preventa','Postventa'),
	CONSTRAINT `fk_order_contact` FOREIGN KEY (order_id) REFERENCES orders(id),
    CONSTRAINT `fk_user_contact` FOREIGN KEY (user_id) REFERENCES users(id),
    CONSTRAINT `fk_customer_contact` FOREIGN KEY (customer_id) REFERENCES customers(id)
)
ENGINE=InnoDB;