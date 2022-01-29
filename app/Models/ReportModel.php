<?php 

namespace Model;

class ReportModel extends Model{

	public function findBy($where, $singleRow = false){
        $sql = '
        select c.id id_evento, c.title titulo_evento, c.datetime_start fecha_inicio_evento, c.datetime_end fecha_final_evento, c.description descripcion_evento, 
        c.type tipo_evento, c.method modo_contacto,
        uc.name asesor_evento, uc.email email_asesor_evento,
        cr.id id_resultado_evento , cr.title titulo_resultado_evento,  cr.date_result fecha_resultado_evento, cr.description descripcion_resultado_evento, cr.result titulo_resultado_resultado, cr.status estado_resultado_evento, cr.next_step pasosig_resultado_evento,
        ucr.name asesor_evento_resultado, ucr.email email_asesor_evento_resultado,
        cm.id id_cliente, cm.name nombre_cliente, cm.phone telefono_cliente, cm.address direccion_cliente, cm.email email_cliente, cm.dni identificacion_cliente, 
        city.name ciudad_cliente,
        o.id id_pedido, o.date_order fecha_pedido, o.total total_pedido,
        oi.id id_item_pedido, oi.product_price_sold  precio_venta_item_pedido, oi.product_status  estado_item_pedido, oi.item_sku  sku_item_pedido,
        p.id id_producto, p.sku sku_producto, p.name nombre_producto, p.price precio_producto, p.quantity cantidad_producto, p.description descripcion_producto, 
        cg.id id_categoria, cg.name nombre_categoria,
        pcg.id id_categoria_padre, pcg.name nombre_categoria_padre
        from contacts c
        left join contact_results cr on c.id = cr.contact_id
        left join users uc on c.user_id = uc.id
        left join users ucr on cr.user_id = ucr.id
        left join customers cm on c.customer_id = cm.id
        left join cities city on cm.city_id = city.id
        left join orders o on c.order_id = o.id
        left join order_items oi on o.id = oi.order_id
        left join products p on oi.product_id = p.id
        left join categories cg on cg.id = p.category_id
        left join categories pcg on pcg.id = cg.parent_category
         '.$this->where($where).' ORDER BY c.id desc
         limit 3000';
		foreach ($this->db->query($sql) as $row) {
			if($singleRow)
			return $row;
			else
			yield $row;
		}	
	}
}