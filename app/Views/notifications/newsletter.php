<script src="/libs/tinymce/js/tinymce/tinymce.min.js"></script>
<div class="card">
  <div class="card-body">
    <h4 class="card-title">Enviar un newsletter </h4>
	<h6 class="card-subtitle mb-2 text-muted">Enviar un correo masivo a todos los clientes activos para newsletter </h6>
	<hr>
	<?php if(!empty($status)){ ?>
		<div class="alert alert-success" role="alert">
			Newsletter enviado satisfactoriamente
		</div>
	<?php } ?>
	<form method="post" action="/notification/send" enctype="multipart/form-data">
	  <div class="form-group">
	    <label for="exampleInputName">Asunto</label>
	    <input required type="text" class="form-control" name="subject" id="exampleInputName" >
	  </div>
	  <div class="form-group">
	    <label for="exampleInputBody">Contenido  (puede indicar el nombre del cliente escribiendo [[cliente]])</label>
	    <textarea class="form-control editor" name="body" id="exampleInputBody"  ></textarea>
	  </div>
	  <div class="form-group">
	    <label for="load-file">Adjuntos</label>
	    <input type="file" class="form-control" name="load_file[]" id="load-file" multiple />
	  </div>
	  <button type="submit" class="btn btn-primary">Enviar</button>
	</form>
	</div>
</div>
<script>
   tinymce.init({ 
      selector:'.editor',
	  theme: 'silver',
	  height: 500,
	  relative_urls : false,
		remove_script_host : false,
		convert_urls : true,
		menubar: false,
		plugins: [
			'advlist autolink lists link image charmap print preview anchor',
			'searchreplace visualblocks code fullscreen',
			'insertdatetime media table paste code help wordcount',
			"image",
		],
		toolbar: 'undo redo | formatselect | ' +
		' bold italic backcolor | alignleft aligncenter ' +
		' alignright alignjustify | bullist numlist outdent indent |' +
		' removeformat ',
    });
    </script>