<div class="alert alert-danger" role="alert" id="response">
</div>
<form onsubmit="return false;" id="send-form">
	<div class="form-group">
		<label for="username">Name</label>
		<input type="text" class="form-control" id="username" name="username" placeholder="Enter your name" required/>
	</div>
	<div class="form-group">
		<label for="e-mail">E-mail</label>
		<input type="email" id="e-mail" class="form-control" name="e-mail" placeholder="Enter your e-mail" required/>
	</div>
	<div class="form-group">
		<label for="text">Text</label>
		<textarea class="form-control" name="text" rows="8" id="text" required></textarea>
	</div>
	<div class="form-group">
		<label class="custom-file">
			<input type="file" id="file" class="custom-file-input">
			<span class="custom-file-control">Choose file</span>
		</label>
	</div>
	<button type="submit" class="btn btn-primary" id="send">Submit</button>
	<button type="button" class="btn btn-primary" id="perview">Perview</button>
</form>
