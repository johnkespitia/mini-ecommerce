<?php

namespace Controller;
use Model\ReportModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class ReportController extends Controller{
	public function __construct(){
		if(empty($_SESSION)){
			header("location:/");	
		}
	}
	public function indexAction($params = []){
		$reportModel = new ReportModel;
		$results = $reportModel->findBy([]);
		return $this->renderHtml("report/index", ["results"=>$results]);
	}
	public function exportAction($params = []){
		$reportModel = new ReportModel;
		$results = $reportModel->findBy([]);
		$spreadsheet = new Spreadsheet();
 
		$spreadsheet->getProperties()
			->setCreator($_ENV["SITE_NAME"])
			->setLastModifiedBy($_ENV["SITE_NAME"])
			->setTitle("Reporte completo")
			->setSubject("Reporte completo")
			->setDescription(
				"Reporte completo"
			)
			->setCategory("Reporte");
		$sheet = $spreadsheet->getActiveSheet(); 
		
		// Set the value of cell A1 
		$sheet->setCellValue("A1", "ID_EVENTO"); 
		$sheet->setCellValue("B1", "TITULO_EVENTO"); 
		$sheet->setCellValue("C1", "FECHA_INICIO_EVENTO"); 
		$sheet->setCellValue("D1", "FECHA_FINAL_EVENTO"); 
		$sheet->setCellValue("E1", "DESCRIPCION_EVENTO"); 
		$sheet->setCellValue("F1", "TIPO_EVENTO"); 
		$sheet->setCellValue("G1", "MODO_CONTACTO"); 
		$sheet->setCellValue("H1", "ASESOR_EVENTO"); 
		$sheet->setCellValue("I1", "EMAIL_ASESOR_EVENTO"); 
		$sheet->setCellValue("J1", "TITULO_RESULTADO_EVENTO"); 
		$sheet->setCellValue("K1", "FECHA_RESULTADO_EVENTO"); 
		$sheet->setCellValue("L1", "DESCRIPCION_RESULTADO_EVENTO"); 
		$sheet->setCellValue("M1", "TITULO_RESULTADO_RESULTADO"); 
		$sheet->setCellValue("N1", "PASOSIG_RESULTADO_EVENTO"); 
		$sheet->setCellValue("O1", "ASESOR_EVENTO_RESULTADO"); 
		$sheet->setCellValue("P1", "EMAIL_ASESOR_EVENTO_RESULTADO"); 
		$sheet->setCellValue("Q1", "NOMBRE_CLIENTE"); 
		$sheet->setCellValue("R1", "TELEFONO_CLIENTE"); 
		$sheet->setCellValue("S1", "DIRECCION_CLIENTE"); 
		$sheet->setCellValue("T1", "EMAIL_CLIENTE"); 
		$sheet->setCellValue("U1", "IDENTIFICACION_CLIENTE"); 
		$sheet->setCellValue("V1", "CIUDAD_CLIENTE"); 
		$sheet->setCellValue("W1", "ID_PEDIDO"); 
		$sheet->setCellValue("X1", "FECHA_PEDIDO"); 
		$sheet->setCellValue("Y1", "TOTAL_PEDIDO"); 
		$sheet->setCellValue("Z1", "SKU_ITEM_PEDIDO"); 
		$sheet->setCellValue("AA1", "ESTADO_ITEM_PEDIDO"); 
		$sheet->setCellValue("AB1", "PRECIO_VENTA_ITEM_PEDIDO"); 
		$sheet->setCellValue("AC1", "SKU_PRODUCTO"); 
		$sheet->setCellValue("AD1", "NOMBRE_PRODUCTO"); 
		$sheet->setCellValue("AE1", "DESCRIPCION_PRODUCTO"); 
		$sheet->setCellValue("AF1", "NOMBRE_CATEGORIA"); 
		$sheet->setCellValue("AG1", "NOMBRE_CATEGORIA_PADRE"); 
		foreach ($results as $key => $prd) {
			$cellNumber=$key+2; 
			$sheet->setCellValue("A{$cellNumber}", $prd["id_evento"]); 
			$sheet->setCellValue("B{$cellNumber}", $prd["titulo_evento"]); 
			$sheet->setCellValue("C{$cellNumber}", $prd["fecha_inicio_evento"]); 
			$sheet->setCellValue("D{$cellNumber}", $prd["fecha_final_evento"]); 
			$sheet->setCellValue("E{$cellNumber}", $prd["descripcion_evento"]); 
			$sheet->setCellValue("F{$cellNumber}", $prd["tipo_evento"]); 
			$sheet->setCellValue("G{$cellNumber}", $prd["modo_contacto"]); 
			$sheet->setCellValue("H{$cellNumber}", $prd["asesor_evento"]); 
			$sheet->setCellValue("I{$cellNumber}", $prd["email_asesor_evento"]); 
			$sheet->setCellValue("J{$cellNumber}", $prd["titulo_resultado_evento"]); 
			$sheet->setCellValue("K{$cellNumber}", $prd["fecha_resultado_evento"]); 
			$sheet->setCellValue("L{$cellNumber}", $prd["descripcion_resultado_evento"]); 
			$sheet->setCellValue("M{$cellNumber}", $prd["titulo_resultado_resultado"]); 
			$sheet->setCellValue("N{$cellNumber}", $prd["pasosig_resultado_evento"]); 
			$sheet->setCellValue("O{$cellNumber}", $prd["asesor_evento_resultado"]); 
			$sheet->setCellValue("P{$cellNumber}", $prd["email_asesor_evento_resultado"]); 
			$sheet->setCellValue("Q{$cellNumber}", $prd["nombre_cliente"]); 
			$sheet->setCellValue("R{$cellNumber}", $prd["telefono_cliente"]); 
			$sheet->setCellValue("S{$cellNumber}", $prd["direccion_cliente"]); 
			$sheet->setCellValue("T{$cellNumber}", $prd["email_cliente"]); 
			$sheet->setCellValue("U{$cellNumber}", $prd["identificacion_cliente"]); 
			$sheet->setCellValue("V{$cellNumber}", $prd["ciudad_cliente"]); 
			$sheet->setCellValue("W{$cellNumber}", $prd["id_pedido"]); 
			$sheet->setCellValue("X{$cellNumber}", $prd["fecha_pedido"]); 
			$sheet->setCellValue("Y{$cellNumber}", $prd["total_pedido"]); 
			$sheet->setCellValue("Z{$cellNumber}", $prd["sku_item_pedido"]); 
			$sheet->setCellValue("AA{$cellNumber}", $prd["estado_item_pedido"]); 
			$sheet->setCellValue("AB{$cellNumber}", $prd["precio_venta_item_pedido"]); 
			$sheet->setCellValue("AC{$cellNumber}", $prd["sku_producto"]); 
			$sheet->setCellValue("AD{$cellNumber}", $prd["nombre_producto"]); 
			$sheet->setCellValue("AE{$cellNumber}", $prd["descripcion_producto"]); 
			$sheet->setCellValue("AF{$cellNumber}", $prd["nombre_categoria"]);
			$sheet->setCellValue("AG{$cellNumber}", $prd["nombre_categoria_padre"]);
		}	
		// Write an .xlsx file  
		$writer = new Xlsx($spreadsheet); 
		
		// Save .xlsx file to the current directory 
		$filePath = $_ENV["STORAGE_FILES"]."/products/report-export.xlsx";
		$writer->save($filePath); 
		header("location:/files/products/report-export.xlsx");
		return $this->renderHtml("report/index", ["results"=>$results]);
	}
}