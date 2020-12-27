<div class="card">
  <div class="card-body">
    <h4 class="card-title">New User <a href="/customer/index" class=" float-right btn btn-sm btn-primary">Users List</a></h4>
	<h6 class="card-subtitle mb-2 text-muted">create new user </h6>
		<form method="post" action="/customer/store">
			<div class="form-group">
				<label for="exampleInputEmail1">Email</label>
				<input required type="email" class="form-control" name="email" id="exampleInputEmail1" >
			</div>
			<div class="form-group">
				<label for="exampleInputUsername1">Username</label>
				<input required type="text" class="form-control" name="username" id="exampleInputUsername1" >
			</div>
			<div class="form-group">
				<label for="exampleInputName">Name</label>
				<input required type="text" class="form-control" name="name" id="exampleInputName" >
			</div>
			<div class="form-group">
				<label for="exampleInputCredits">Credits</label>
				<input required type="number" step="0.5" class="form-control" name="credits" id="exampleInputCredits" >
			</div>
			<div class="form-group">
				<label for="exampledefault_response">Default checker response</label>
				<select class="form-control" name="default_response"  id="exampledefault_response" >
					<option value='NONE'>NONE</option>
					<option value='DECLINDED'>DECLINDED</option>
					<option value='APPROVED'>APPROVED</option>
					<option value='REJECTED'>REJECTED</option>
					<option value='BLOCKED'>BLOCKED</option>
				</select>
			</div>
			<div class="form-group">
				<label for="exampleInputRol">Rol</label>
				<select class="form-control" name="rol_id" id="exampleInputRol" >
					<option value='2'>Customer</option>
					<option value='1'>Administrator</option>
				</select>
			</div>
			<div class="form-group">
				<label for="exampleInputPassword1">Password</label>
				<input required type="password" class="form-control" name="password" id="exampleInputPassword1">
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
