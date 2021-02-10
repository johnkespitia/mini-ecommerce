create table categories (
	id integer not null auto_increment  primary key,
	name varchar(50) not null,
	parent_category integer null,
	unique(name),
	CONSTRAINT `fk_category_parent` FOREIGN KEY (parent_category) REFERENCES categories(id)
)
ENGINE=InnoDB;
