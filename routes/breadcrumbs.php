<?php
// Escritorio
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Inicio', route('home'));
});

//Catálogos
	Breadcrumbs::for('catalogos', function ($trail) {
	    $trail->parent('home');
	    $trail->push('Catálogos', route('home'));
	});

	Breadcrumbs::for('procesos', function ($trail) {
	    $trail->parent('home');
	    $trail->push('Procesos', route('home'));
	});

	Breadcrumbs::for('configuraciones', function ($trail) {
	    $trail->parent('home');
	    $trail->push('Configuraciones', route('home'));
	});

	//USUARIOS
		// Home > Catálogos > Usuarios
		Breadcrumbs::for('users_index', function ($trail) {
		    $trail->parent('catalogos');
		    $trail->push('Usuarios', route('users.index'));
		});
		// Home > Catálogos > Usuarios > create
		Breadcrumbs::for('users_create', function ($trail) {
		    $trail->parent('users_index');
		    $trail->push('Crear', route('users.create'));
		});
		// Home > Catálogos > Usuarios > username de usuario
		Breadcrumbs::for('users_editar', function ($trail,$array_data) {
		    $trail->parent('users_index');
		    $trail->push($array_data['nombre'], route('users.edit',['id' => $array_data['id']]));
		});

	//SOLICITUDES
		// Home > Procesos > Solicitudes
		Breadcrumbs::for('solicitudes_index', function ($trail) {
		    $trail->parent('procesos');
		    $trail->push('Solicitudes SAT', route('solicitudes.index'));
		});

		// Home > Procesos > Solicitudes > username de usuario
		Breadcrumbs::for('solicitudes_editar', function ($trail,$array_data) {
		    $trail->parent('solicitudes_index');
		    $trail->push($array_data['nombre'], route('solicitudes.edit',['id' => $array_data['id']]));
		});



	//CONFIGURACIONES

		// Home > Catálogos > Usuarios
		Breadcrumbs::for('configuraciones_index', function ($trail) {
		    $trail->parent('configuraciones');
		    $trail->push('Certificados', route('configuraciones.index'));
		});

		// Home > Procesos > Solicitudes > username de usuario
		Breadcrumbs::for('configuraciones_editar', function ($trail,$array_data) {
		    $trail->parent('configuraciones_index');
		    $trail->push($array_data['nombre'], route('configuraciones.edit',['id' => $array_data['id']]));
		});






