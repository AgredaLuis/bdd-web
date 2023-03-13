<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

#Se importa la clase User, RoleUser y Persona
use App\User;
use App\RoleUser;
use App\Persona;


class EstudianteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	Model::unguard();//ACTIVANDO INSERCION MASIVA DE DATOS EN LAS TABLAS

        //INSERTAR ESTUDIANTE:
        
        //USUARIO
		User::create(array(
			'id'=> 5,
            'user'=>'Estudiante',
            'password'=> bcrypt('12345678'),
            'email'=>'estudiantejose@gmail.com',
            'is_activated'=>true,
            'predefined'=>'Estudiante',
        ));

		//ASIGNAR ROL
		RoleUser::create(array(
            'role_id'=> 1, //Estudiante
            'user_id'=>5, //estudiantejose@gmail.com
            'is_activated'=> true,
            'is_predefined'=>true,
        ));


		//PERSONAS
		Persona::create(array(
			'id'=> 5, //estudiantejose@gmail.com
            'ci'=>'50000000',
            'nombre'=> 'ESTUDIANTE JOSE',
            'apellido'=>'JIMENEZ HERNANDEZ',
            'nacionalidad'=>'V',
            'genero'=>'M',
            'estatus_civil'=>'S',
            'fecha_nacimiento'=>'1990-01-02',
            'email'=>'estudiantejose@gmail.com',
            'telefono_movil'=>'(0412) 088-3413',
            'telefono_local'=>'(0412) 088-3413',
            'discapacidad'=> NULL,                 
            'imagen'=>'img/user2-160x160.jpg',
            'trabajo_empresa'=>'universidad de oriente',
            'trabajo_cargo'=>'estudiante',
            'trabajo_tiempo_servicio'=> NULL,
            'activo'=>true,
            'direccion'=>'Fe y alegria. SUPER BLOQUES. BLOQUES 29. APTO. 01-05.',
            'id_parroquia'=>3,
            'ciudad'=>'CUMANA',
            'confirmado'=>false,
        ));


        //INSERTAR ESTUDIANTE:
        
        //USUARIO
		User::create(array(
			'id'=> 6,
            'user'=>'Estudiante',
            'password'=> bcrypt('12345678'),
            'email'=>'estudiantefernanda@gmail.com',
            'is_activated'=>true,
            'predefined'=>'Estudiante',
        ));

		//ASIGNAR ROL
		RoleUser::create(array(
            'role_id'=> 1, //Estudiante
            'user_id'=>6, //fernandajose@gmail.com
            'is_activated'=> true,
            'is_predefined'=>true,
        ));


		//PERSONAS
		Persona::create(array(
			'id'=> 6, //estudiantejose@gmail.com
            'ci'=>'60000000',
            'nombre'=> 'ESTUDIANTE FERNANDA',
            'apellido'=>'JIMENEZ HERNANDEZ',
            'nacionalidad'=>'V',
            'genero'=>'F',
            'estatus_civil'=>'S',
            'fecha_nacimiento'=>'1990-01-02',
            'email'=>'estudiantefernanda@gmail.com',
            'telefono_movil'=>'(0412) 088-3413',
            'telefono_local'=>'(0412) 088-3413',
            'discapacidad'=> NULL,                 
            'imagen'=>'img/user2-160x160.jpg',
            'trabajo_empresa'=>'universidad de oriente',
            'trabajo_cargo'=>'estudiante',
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
