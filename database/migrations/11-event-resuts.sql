create table contact_results (
	id integer not null auto_increment primary key,
    title VARCHAR(50) NOT NULL,
	contact_id integer null,
	user_id integer unsigned not null,
    date_result datetime not null,
	description text,
    result text, 
    status enum('Atendida','Cancelada por cliente','Cancelada por asesor'),
    next_step enum('Otro evento','Cotización','Venta', 'Proceso finalizado'),
	CONSTRAINT `fk_result_contact` FOREIGN KEY (contact_id) REFERENCES contacts(id),
    CONSTRAINT `fk_user_contact_result` FOREIGN KEY (user_id) REFERENCES users(id)
)
ENGINE=InnoDB;