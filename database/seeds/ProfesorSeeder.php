<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

#Se importa la clase User, RoleUser y Persona
use App\User;
use App\RoleUser;
use App\Persona;

class ProfesorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	Model::unguard();//ACTIVANDO INSERCION MASIVA DE DATOS EN LAS TABLAS

        //INSERTAR PROFESOR:
        
        //USUARIO
		User::create(array(
			'id'=> 7,
            'user'=>'Profesor',
            'password'=> bcrypt('12345678'),
            'email'=>'profesorjose@gmail.com',
            'is_activated'=>true,
            'predefined'=>'Profesor',
        ));

		//ASIGNAR ROL
		RoleUser::create(array(
            'role_id'=> 3, //profesor
            'user_id'=>7, //profesorjose@gmail.com
            'is_activated'=> true,
            'is_predefined'=>true,
        ));


		//PERSONAS
		Persona::create(array(
			'id'=> 7, //profesorjose@gmail.com
            'ci'=>'70000000',
            'nombre'=> 'PROFESOR JOSE',
            'apellido'=>'HERNANDEZ JIMENEZ',
            'nacionalidad'=>'V',
            'genero'=>'M',
            'estatus_civil'=>'S',
            'fecha_nacimiento'=>'1980-01-02',
            'email'=>'profesorjose@gmail.com',
            'telefono_movil'=>'(0412) 088-3413',
            'telefono_local'=>'(0412) 088-3413',
            'discapacidad'=> NULL,                 
            'imagen'=>'img/user2-160x160.jpg',
            'trabajo_empresa'=>'universidad de oriente',
            'trabajo_cargo'=>'profesor',
            'trabajo_tiempo_servicio'=> NULL,
            'activo'=>true,
            'direccion'=>'Fe y alegria. SUPER BLOQUES. BLOQUES 29. APTO. 01-05.',
            'id_parroquia'=>3,
            'ciudad'=>'CUMANA',
            'confirmado'=>false,
        ));


        //INSERTAR PROFESOR:
        
        //USUARIO
		User::create(array(
			'id'=> 8,
            'user'=>'Profesor',
            'password'=> bcrypt('12345678'),
            'email'=>'profesormario@gmail.com',
            'is_activated'=>true,
            'predefined'=>'Profesor',
        ));

		//ASIGNAR ROL
		RoleUser::create(array(
            'role_id'=> 3, //profesor
            'user_id'=>8, //profesormario@gmail.com
            'is_activated'=> true,
            'is_predefined'=>true,
        ));


		//PERSONAS
		Persona::create(array(
			'id'=> 8, //mariojose@gmail.com
            'ci'=>'80000000',
            'nombre'=> 'PROFESOR MARIO',
            'apellido'=>'HERNANDEZ JIMENEZ',
            'nacionalidad'=>'V',
            'genero'=>'M',
            'estatus_civil'=>'S',
            'fecha_nacimiento'=>'1980-01-02',
            'email'=>'profesormario@gmail.com',
            'telefono_movil'=>'(0412) 088-3413',
            'telefono_local'=>'(0412) 088-3413',
            'discapacidad'=> NULL,                 
            'imagen'=>'img/user2-160x160.jpg',
            'trabajo_empresa'=>'universidad de oriente',
            'trabajo_cargo'=>'profesor',
            'trabajo_tiempo_servicio'=> NULL,
            'activo'=>true,
            'direccion'=>'Fe y alegria. SUPER BLOQUES. BLOQUES 29. APTO. 01-05.',
            'id_parroquia'=>3,
            'ciudad'=>'CUMANA',
            'confirmado'=>false,
        ));

        Model::reguard();

    }
}
