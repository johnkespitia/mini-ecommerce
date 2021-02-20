alter table daily_reports  
    ADD COLUMN origin int not null unsigned,
    ADD COLUMN destination int not null unsigned,
    ADD FOREIGN KEY origin_report_fk (origin) REFERENCES cities(id),
    ADD FOREIGN KEY destination_report_fk (destination) REFERENCES cities(id);