<?php

namespace Model;

class NotificationModel extends Model
{

	public function getOilChanges()
	{
		$sql = 'SELECT c.dni car, c.oil_change_km - mod(max(dr.km_end),c.oil_change_km) km_pending
		FROM daily_reports dr
		INNER JOIN report_groups rg ON  dr.report_group = rg.id
		INNER JOIN cars c ON  rg.car = c.id
		WHERE  c.oil_change_km - mod(dr.km_end,c.oil_change_km) < (c.oil_change_km*0.2)
		GROUP BY 1';
		foreach ($this->db->query($sql) as $row) {
			yield $row;
		}
	}

	public function getNotifications()
	{
		$sql = 'SELECT c.dni car, nt.name not_type , notc.value_compare - mod(max(dr.km_end),notc.value_compare) km_pending
		FROM daily_reports dr
		INNER JOIN report_groups rg ON  dr.report_group = rg.id
		INNER JOIN cars c ON  rg.car = c.id
		INNER JOIN car_notifications notc on notc.car = c.id
		INNER JOIN notification_types nt on nt.id = notc.notification_type
		WHERE  mod(dr.km_end,notc.value_compare) > avg_reminder
		GROUP BY 1,2';
		foreach ($this->db->query($sql) as $row) {
			yield $row;
		}
	}
}
