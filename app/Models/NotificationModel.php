<?php 

namespace Model;

class NotificationModel extends Model{

	public function getOilChanges(){
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

	
}