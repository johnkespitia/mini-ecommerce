<?php 

namespace Model;

class EmployeModel extends Model{

	const TABLE = "employees";

	public function all(){
		$sql = 'SELECT e.* ,
		p.name position_name, 
		b.name bank_name,
		eps.name eps_name,
		ps.name pension_name,
		c.name cesantias_name,
		a.name area_name,
		cc.name caja_compensacion_name,
		arl.name arl_name
		FROM '.self::TABLE.' e
		LEFT JOIN positions p on e.position = p.id
		LEFT JOIN banks b on e.bank = b.id
		LEFT JOIN eps on e.eps = eps.id
		LEFT JOIN pension ps on e.pension = ps.id
		LEFT JOIN cesantias c on e.cesantias = c.id
		LEFT JOIN areas a on e.area = a.id
		LEFT JOIN cajas_compensacion cc on e.caja_compensacion = cc.id
		LEFT JOIN arl on e.arl = arl.id
		ORDER BY id';
		foreach ($this->db->query($sql) as $row) {
		    yield $row;
		}
	}

	public function find($id){
		$sql = 'SELECT e.* ,
		p.name position_name, 
		b.name bank_name,
		eps.name eps_name,
		ps.name pension_name,
		c.name cesantias_name,
		a.name area_name,
		cc.name caja_compensacion_name,
		arl.name arl_name
		FROM '.self::TABLE.' e
		LEFT JOIN positions p on e.position = p.id
		LEFT JOIN banks b on e.bank = b.id
		LEFT JOIN eps on e.eps = eps.id
		LEFT JOIN pension ps on e.pension = ps.id
		LEFT JOIN cesantias c on e.cesantias = c.id
		LEFT JOIN areas a on e.area = a.id
		LEFT JOIN cajas_compensacion cc on e.caja_compensacion = cc.id
		LEFT JOIN arl on e.arl = arl.id
		WHERE e.id='.$id.' ORDER BY e.id'; 
		foreach ($this->db->query($sql) as $row) {
		    return $row;
		}	
	}

	public function findBy($where, $singleRow = false){
		$sql = 'SELECT e.* ,
		p.name position_name, 
		b.name bank_name,
		eps.name eps_name,
		ps.name pension_name,
		c.name cesantias_name,
		a.name area_name,
		cc.name caja_compensacion_name,
		arl.name arl_name
		FROM '.self::TABLE.' e
		LEFT JOIN positions p on e.position = p.id
		LEFT JOIN banks b on e.bank = b.id
		LEFT JOIN eps on e.eps = eps.id
		LEFT JOIN pension ps on e.pension = ps.id
		LEFT JOIN cesantias c on e.cesantias = c.id
		LEFT JOIN areas a on e.area = a.id
		LEFT JOIN cajas_compensacion cc on e.caja_compensacion = cc.id
		LEFT JOIN arl on e.arl = arl.id
		'.$this->where($where).' ORDER BY id desc';
		foreach ($this->db->query($sql) as $row) {
			if($singleRow)
				return $row;
			else
				yield $row;
		}	
	}

	public function create($fields){
		$sql = "INSERT INTO ".self::TABLE." (dni, name, email ,status, dni_type, city_exp, birth_date,
		address, phone, position, rh, payment_method, bank, account_type, account_number,
		salary, payment_base, start_date, extra_benefit, type_contract, contract_agreement,
		eps, cesantias, pension, area, caja_compensacion, arl, app_password, img_signature ) value (
			'".addslashes($fields["dni"])."', 
			'".addslashes($fields["name"])."',
			'".addslashes($fields["email"])."', 
			".addslashes($fields["status"]).",
			'".addslashes($fields["dni_type"])."',
			'".addslashes($fields["city_exp"])."',
			'".addslashes($fields["birth_date"])."',
			'".addslashes($fields["address"])."',
			'".addslashes($fields["phone"])."',
			'".addslashes($fields["position"])."',
			'".addslashes($fields["rh"])."',
			'".addslashes($fields["payment_method"])."',
			'".addslashes($fields["bank"])."',
			'".addslashes($fields["account_type"])."',
			'".addslashes($fields["account_number"])."',
			'".addslashes($fields["salary"])."',
			'".addslashes($fields["payment_base"])."',
			'".addslashes($fields["start_date"])."',
			'".addslashes($fields["extra_benefit"])."',
			'".addslashes($fields["type_contract"])."',
			'".addslashes($fields["contract_agreement"])."',
			'".addslashes($fields["eps"])."',
			'".addslashes($fields["cesantias"])."',
			'".addslashes($fields["pension"])."',
			'".addslashes($fields["area"])."',
			'".addslashes($fields["caja_compensacion"])."',
			'".addslashes($fields["arl"])."',
			'".addslashes($fields["app_password"])."',
			'".addslashes($fields["img_signature"])."' 
		)";
		return $this->db->exec($sql);
	}

	public function update($fields, $id){
		$sql = "UPDATE ".self::TABLE." 
			SET
			dni = '".addslashes($fields["dni"])."', 
			name = '".addslashes($fields["name"])."', 
			email = '".addslashes($fields["email"])."',
			status = ".addslashes($fields["status"]).",
			dni_type = '".addslashes($fields["dni_type"])."',
			city_exp = '".addslashes($fields["city_exp"])."',
			birth_date = '".addslashes($fields["birth_date"])."',
			address = '".addslashes($fields["address"])."',
			phone = '".addslashes($fields["phone"])."',
			position = '".addslashes($fields["position"])."',
			rh = '".addslashes($fields["rh"])."',
			payment_method = '".addslashes($fields["payment_method"])."',
			bank = '".addslashes($fields["bank"])."',
			account_type = '".addslashes($fields["account_type"])."',
			account_number = '".addslashes($fields["account_number"])."',
			salary = '".addslashes($fields["salary"])."',
			payment_base = '".addslashes($fields["payment_base"])."',
			start_date = '".addslashes($fields["start_date"])."',
			extra_benefit = '".addslashes($fields["extra_benefit"])."',
			type_contract = '".addslashes($fields["type_contract"])."',
			contract_agreement = '".addslashes($fields["contract_agreement"])."',
			eps = '".addslashes($fields["eps"])."',
			cesantias = '".addslashes($fields["cesantias"])."',
			pension = '".addslashes($fields["pension"])."',
			area = '".addslashes($fields["area"])."',
			caja_compensacion = '".addslashes($fields["caja_compensacion"])."',
			arl = '".addslashes($fields["arl"])."',
			app_password = '".addslashes($fields["app_password"])."',
			img_signature = '".addslashes($fields["img_signature"])."' 
			WHERE id = {$id}"; 
		return $this->db->exec($sql);
	}

	public function delete($id){
		$sql = "DELETE FROM ".self::TABLE." 
			WHERE id = {$id}";
		return $this->db->exec($sql);	
	}
}