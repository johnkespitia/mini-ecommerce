alter table cars
    ADD COLUMN fuel_type integer unsigned ,
    ADD COLUMN line_category integer unsigned ,
    ADD COLUMN brand integer unsigned ,
    ADD COLUMN service_type integer unsigned ,
    ADD FOREIGN KEY (`brand`) REFERENCES `brands`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
    ADD FOREIGN KEY (fuel_type) REFERENCES line_categories(id) ON DELETE RESTRICT ON UPDATE RESTRICT,
    ADD FOREIGN KEY (line_category) REFERENCES brands(id) ON DELETE RESTRICT ON UPDATE RESTRICT,
    ADD FOREIGN KEY (service_type) REFERENCES service_types(id) ON DELETE RESTRICT ON UPDATE RESTRICT;