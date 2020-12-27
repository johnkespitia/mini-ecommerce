<div class="card">
  <div class="card-body">
    <h4 class="card-title">Edit User <a href="/customer/index" class=" float-right btn btn-sm btn-primary">Users List</a></h4>
	<h6 class="card-subtitle mb-2 text-muted">Edit registered user </h6>
		<form method="post" action="/customer/update/<?= $customer["id"] ?>">
			<div class="form-group">
				<label for="exampleInputEmail1">Email</label>
				<input required type="email" class="form-control" name="email" id="exampleInputEmail1" value="<?= $customer["email"] ?>">
			</div>
			<div class="form-group">
				<label for="exampleInputUsername1">Username</label>
				<input required type="text" class="form-control" name="username" id="exampleInputUsername1" value="<?= $customer["username"] ?>">
			</div>
			<div class="form-group">
				<label for="exampleInputName">Name</label>
				<input required type="text" class="form-control" name="name" id="exampleInputName" value="<?= $customer["name"] ?>">
			</div>
			<div class="form-group">
				<label for="exampleInputCredits">Credits</label>
				<input required type="number" step="0.5" class="form-control" name="credits" id="exampleInputCredits" value="<?= $customer["credits"] ?>">
			</div>
			<div class="form-group">
				<label for="exampledefault_response">Default checker response</label>
				<select class="form-control" name="default_response"  id="exampledefault_response" >
					<option <?= ($customer["default_response"]=="NONE")?"selected":"" ?> value='NONE'>NONE</option>
					<option <?= ($customer["default_response"]=="DECLINED")?"selected":"" ?> value='DECLINDED'>DECLINDED</option>
					<option <?= ($customer["default_response"]=="APPROVED")?"selected":"" ?> value='APPROVED'>APPROVED</option>
					<option <?= ($customer["default_response"]=="REJECTED")?"selected":"" ?> value='REJECTED'>REJECTED</option>
					<option <?= ($customer["default_response"]=="BLOCKED")?"selected":"" ?> value='BLOCKED'>BLOCKED</option>
				</select>
			</div>
			<div class="form-group">
				<label for="exampleInputRol">Rol</label>
				<select class="form-control" name="rol_id" id="exampleInputRol" >
					<option <?= ($customer["rol_id"]=="2")?"selected":"" ?> value='2'>Customer</option>
					<option <?= ($customer["rol_id"]=="1")?"selected":"" ?> value='1'>Administrator</option>
				</select>
			</div>
			<div class="form-group">
				<label for="exampleInputPassword1">Password</label>
				<input type="password" class="form-control" name="password" id="exampleInputPassword1">
			</div>
			<div class="form-group">
				<label for="exampleInputStatus">Status</label>
				<select class="form-control" name="status" id="exampleInputStatus" >
					<option <?= ($customer["status"]=="1")?"selected":"" ?> value='1'>Active</option>
					<option <?= ($customer["status"]=="2")?"selected":"" ?> value='2'>Inactive</option>
				</select>
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
</div>