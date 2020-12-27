<div class="card">
  <div class="card-body">
    <h4 class="card-title">Edit Congig <a href="/generalsettings/index" class=" float-right btn btn-sm btn-primary">Configs List</a></h4>
	<h6 class="card-subtitle mb-2 text-muted">Edit General Config </h6>
		<form method="post" action="/generalsettings/update/<?= $setting["id"] ?>">
			<div class="form-group">
				<label for="exampleInputName">Name</label>
				<input required type="text" class="form-control" name="name" id="exampleInputName"  value="<?= $setting["name"] ?>" >
			</div>
			<div class="form-group">
				<label for="exampleInputValue">Value</label>
				<input required type="text" class="form-control" name="value" id="exampleInputValue" value="<?= $setting["value"] ?>" >
			</div>
			<div class="form-group">
				<label for="exampleInputStatus">Status</label>
				<select class="form-control" name="status" id="exampleInputStatus" >
					<option <?= ($setting["status"]=="1")?"selected":"" ?> value='1'>Active</option>
					<option <?= ($setting["status"]=="2")?"selected":"" ?> value='2'>Inactive</option>
				</select>
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
</div>
