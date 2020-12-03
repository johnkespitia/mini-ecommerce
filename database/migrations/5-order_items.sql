create table order_items (
	id integer not null auto_increment primary key,
	order_id integer not null,
	product_id integer not null,
	product_price_sold decimal(15,2),
	product_status varchar(10),
	CONSTRAINT `fk_order` FOREIGN KEY (order_id) REFERENCES orders(id),
    CONSTRAINT `fk_product` FOREIGN KEY (product_id) REFERENCES products(id)
)
ENGINE=InnoDB;