ALTER TABLE customers
    ADD dni varchar(20),
    ADD CONSTRAINT customers_dni_uk UNIQUE (dni);