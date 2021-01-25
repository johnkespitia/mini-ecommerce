<?php
$header="";
$head_ready=false;
$bodyAll="";
foreach ($results as $prd) {
	$content="<tr>";
	foreach ($prd as $key => $value) {
		if(!is_numeric($key) && !$head_ready){
			$header.="<th>{$key}</th>";
		}

		if(!is_numeric($key)){
			$content.="<td>{$value}</td>";
		}
	} 
	$head_ready=true;
	$content.="</tr>";	
	$bodyAll.=$content;
}
?>

<div class="card">
  <div class="card-body">
	<div class="row">
	<div class="col-12">
		<div class="card">
		<h5 class="card-header">Reporte preliminar <a href="/report/export" class=" float-right btn btn-sm btn-primary">Descargar Excel</a></h5>
		<div class="card-body">
			<table class="table table-responsive ">
			<thead class="thead-dark">
				<tr>
				<?= $header ?>
				</tr>
			</thead>
			<tbody>
				<?= $bodyAll ?>
			</tbody>
			</table>
		</div>
		</div>
	</div>

</div>
</div>
</div>
