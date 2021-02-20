alter table daily_reports  
    DROP COLUMN car,
    DROP COLUMN customer,
    DROP COLUMN service_type,
    DROP COLUMN area,
    ADD report_group integer unsigned,
    ADD FOREIGN KEY report_group_fk (report_group) REFERENCES report_groups(id);