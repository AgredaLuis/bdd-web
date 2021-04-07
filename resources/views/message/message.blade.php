
<script>

	// Recibe un msg del controlador y emite un mensaje en pantalla con el uso de la libreria JS Sweetalert
	@if (Session::get('msg'))
		
		Swal.fire("{{ Session::get('title-msg') }}","{{ Session::get('msg') }}","{{ Session::get('type') }}");

   @endif

</script>