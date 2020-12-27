<div class="card">
  <div class="card-body">
    <h4 class="card-title">New Congig <a href="/generalsettings/index" class=" float-right btn btn-sm btn-primary">Configs List</a></h4>
	<h6 class="card-subtitle mb-2 text-muted">create General Config </h6>
		<form method="post" action="/generalsettings/store">
			<div class="form-group">
				<label for="exampleInputName">Name</label>
				<input required type="text" class="form-control" name="name" id="exampleInputName" >
			</div>
			<div class="form-group">
				<label for="exampleInputValue">Value</label>
				<input required type="text" class="form-control" name="value" id="exampleInputValue" >
			</div>
			<div class="form-group">
				<label for="exampleInputStatus">Status</label>
				<select class="form-control" name="status" id="exampleInputStatus" >
					<option value='1'>Active</option>
					<option value='2'>Inactive</option>
				</select>
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
</div>
