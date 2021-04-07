<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Configuracionweb;
use App\User;
use App\Modulo;
use App\Permiso;
use App\Area;
use App\Grado;
use App\Modalidad;
use App\Nucleo;
use App\Banco;
use App\Programa;
use App\Role;
use App\RoleUser;
use App\Universidad;
use App\TipoTitulo;
use App\Estado;
use App\Municipio;
use App\Parroquia;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();//ACTIVANDO INSERCION MASIVA DE DATOS EN LAS TABLAS
    		//CONFIGURACIONWEB
	            Configuracionweb::create(array(
   	             'nombre'=>'nombre',
	             'parametros'=>'Sistema de Información y Administración de Estudios de Postgrado de la Universidad de Oriente',
	             'tipo'=> 1,
	            ));
	            Configuracionweb::create(array(
   	             'nombre'=>'titulo',
	             'parametros'=>'SIAEPUDO',
	             'tipo'=> 1,
	            ));
	            Configuracionweb::create(array(
                 'nombre'=>'nombre_negocio',
	             'parametros'=>'SIAEPUDO',
	             'tipo'=> 1,
	            ));
	            Configuracionweb::create(array(
                 'nombre'=>'abreviatura',
	             'parametros'=>'SIAEPUDO',
	             'tipo'=> 1,
	            ));
	            Configuracionweb::create(array(
                 'nombre'=>'logo',
	             'parametros'=>'img/logo.png',
	             'tipo'=> 1,
	            ));
	            Configuracionweb::create(array(
                 'nombre'=>'descripcion',
	             'parametros'=>'Software para SIAEPUDO',
	             'tipo'=> 1,
	            ));
                Configuracionweb::create(array(
                 'nombre'=>'palabrasclaves',
                 'parametros'=>'SIAEPUDO',
                 'tipo'=> 1,
                ));
                Configuracionweb::create(array(
                 'nombre'=>'Emisora',
                 'parametros'=>'SIAEPUDO',
                 'tipo'=> 2,
                ));


            //SEMILLA DE SIAEPUDO

                //BANCO
                Banco::create(array(
                    'id'=>1,
                    'nombre'=>'Mercantil',
                    'descripcion'=>'Banco Mercantil',
                ));

                Banco::create(array(
                    'id'=>2,
                    'nombre'=>'Banesco',
                    'descripcion'=>'Banco Banesco',
                ));

                Banco::create(array(
                    'id'=>3,
                    'nombre'=>'Provincial',
                    'descripcion'=>'Banco Provincial',
                ));

                Banco::create(array(
                    'id'=>4,
                    'nombre'=>'Venezuela',
                    'descripcion'=>'Banco Venezuela',
                ));


                //NUCLEO
                Nucleo::create(array(
                    'id'=>1,
                    'nombre'=>'Núcleo de Sucre',
                ));

                Nucleo::create(array(
                    'id'=>2,
                    'nombre'=>'Núcleo de Anzoategui',
                ));

                Nucleo::create(array(
                    'id'=>3,
                    'nombre'=>'Núcleo de Bolivar',
                ));

                Nucleo::create(array(
                    'id'=>4,
                    'nombre'=>'Núcleo de Nueva Esparta',
                ));

                Nucleo::create(array(
                    'id'=>5,
                    'nombre'=>'Núcleo de Monagas',
                ));


                //AREA
                Area::create(array(
                    'id'=>1,
                    'nombre'=>'Ciencias Exactas y Naturales',
                    'descripcion'=>'Ciencias Exactas y Naturales',
                ));

                Area::create(array(
                    'id'=>2,
                    'nombre'=>'Ciencias Humanísticas y Filosofía',
                    'descripcion'=>'Ciencias Humanísticas y Filosofía',
                ));

                Area::create(array(
                    'id'=>3,
                    'nombre'=>'Ciencias Sociales, Políticas y Administración',
                    'descripcion'=>'Ciencias Sociales, Políticas y Administración',
                ));

                Area::create(array(
                    'id'=>4,
                    'nombre'=>'Tecnología y Ciencias Agropecuarias y Veterinarias',
                    'descripcion'=>'Tecnología y Ciencias Agropecuarias y Veterinarias',
                ));

                Area::create(array(
                    'id'=>5,
                    'nombre'=>'Tecnología y Ciencias de la Ingeniería',
                    'descripcion'=>'Tecnología y Ciencias de la Ingeniería',
                ));

                Area::create(array(
                    'id'=>6,
                    'nombre'=>'Tecnología y Ciencias Médicas',
                    'descripcion'=>'Tecnología y Ciencias Médicas',
                ));


                //GRADO
                Grado::create(array(
                    'id'=>1,
                    'nombre'=>'Doctor',
                    'descripcion'=>'Está basado principalmente en la formación de Investigadores de alto nivel capaces de planificar, coordinar y ejecutar investigaciones básicas y/o aplicadas para la creación de nuevos conocimientos científicos, tecnológicos y humanísticos. El programa doctoral está constituido por un conjunto de asignaturas y una tesis doctoral con un número total de créditos no inferior a 60. Los aspirantes deben tener una permanencia ininterrumpida en la Universidad de dos años como alumno regular a tiempo completo y deben aprobar un examen integral de acuerdo con las normas de cada postgrado.',
                    'titulo'=>'Doctorado',
                ));

                Grado::create(array(
                    'id'=>2,
                    'nombre'=>'Especialista',
                    'descripcion'=>'Son aquellos estudios que hacen énfasis en la utilización de métodos y técnicas para el ejercicio profesional. Comprende un conjunto de asignaturas afines con un número de créditos no inferior a 31 permanencia mínima ininterrumpida de un año, como alumno a tiempo completo.',
                    'titulo'=>'Especialización',
                ));

                Grado::create(array(
                    'id'=>3,
                    'nombre'=>'Magister Scientiarum',
                    'descripcion'=>'Comprende los estudios destinados a la adquisición de conocimientos y metodología para la investigación a través de un conjunto de asignaturas afines con un número de créditos no inferior a 31 permanencia mínima ininterrumpida de un año como alumno a tiempo completo. Además requiere la realización de un Trabajo de Grado.',
                    'titulo'=>'Maestría',
                ));


                //MODALIDAD DE ESTUDIO DE POSTGRADO
                Modalidad::create(array(
                    'id'=>1,
                    'nombre'=>'Presencial',
                    'descripcion'=>'Se refiere a los estudios normales en una Universidad, en donde el estudiante permanece en el recinto, desarrollando la modalidad de enseñanza hasta que termine su período de estudio, en un tiempo estipulado en el reglamento. Los semestres académicos para esta modalidad tendrán una duración mínima de dieciséis semanas.',
                ));

                Modalidad::create(array(
                    'id'=>2,
                    'nombre'=>'Modular (Semi Presencial)',
                    'descripcion'=>'Implica una modalidad de enseñanza de tipo mixto, que combina la educación a distancia con períodos presénciales continuos de corta duración, lo cual permite la participación de candidatos con responsabilidades de empleo. Cada asignatura o módulo, en este sistema, tiene una duración de ocho semanas, siete de las cuales son dedicadas al estudio individual, a distancia, de un manual de instrucción preparado por el docente del curso y una semana de trabajo intensivo o mixto presencial, dedicada al estudio más a fondo de la materia, mediante trabajos en equipo, disertaciones y análisis de casos, guiados por el instructor a cargo de la asignatura. El material didáctico es proporcionado al participante al iniciarse cada módulo, con siete semanas de anticipación. Sin embargo, los períodos a distancia y presenciales pueden variar, de acuerdo a la naturaleza y necesidades de un curso.',
                ));


                //UNIVERSIDAD
                Universidad::create(array(
                    'id'=>1,
                    'nombre'=>'Universidad de Oriente',
                ));

                Universidad::create(array(
                    'id'=>2,
                    'nombre'=>'Universidad Central de Venezuela',
                ));


                //UNIVERSIDAD
                TipoTitulo::create(array(
                    'id'=>1,
                    'nombre'=>'Licenciatura',
                ));

                TipoTitulo::create(array(
                    'id'=>2,
                    'nombre'=>'Ingeniería',
                ));

                TipoTitulo::create(array(
                    'id'=>3,
                    'nombre'=>'Postgrado',
                ));

                TipoTitulo::create(array(
                    'id'=>4,
                    'nombre'=>'Doctorado',
                ));


                //ROLES DE USUARIO
                Role::create(array(
                 'id'=> 1,
                 'name'=>'Estudiante',
                 'description'=>'Estudiante de Postgrado',
                ));

                Role::create(array(
                 'id'=> 2,
                 'name'=>'Administrador',
                 'description'=>'Administrador',
                ));

                Role::create(array(
                 'id'=> 3,
                 'name'=>'Profesor',
                 'description'=>'Profesor de Postgrado',
                ));

                Role::create(array(
                 'id'=> 4,
                 'name'=>'Invitado',
                 'description'=>'Invitado',
                ));

                Role::create(array(
                 'id'=> 5,
                 'name'=>'Coord. Programa',
                 'description'=>'Coordinador de Programa de Postgrado',
                ));

                Role::create(array(
                 'id'=> 6,
                 'name'=>'Coord. Nucleo',
                 'description'=>'Coordinador de Nucleo de Postgrado',
                ));

                Role::create(array(
                 'id'=> 7,
                 'name'=>'Coord. General',
                 'description'=>'Coordinador de General de Postgrado',
                ));


                //USUARIOS
                User::create(array(
                 'id'=> 1,
                 'user'=>'Administrador',
                 'password'=> bcrypt('12345678'),
                 'email'=>'na948730@gmail.com',
                 'is_activated'=>true,
                 'predefined'=>'Administrador',
                ));


                //ASIGNAR ROLES DE USUARIO
                RoleUser::create(array(
                 'role_id'=> 2,
                 'user_id'=>1,
                 'is_activated'=> true,
                 'is_predefined'=>true,
                ));


                //ESTADOS
                Estado::create(array(
                 'id'=> 1,
                 'nombre'=>'Sucre',
                ));

                Estado::create(array(
                 'id'=> 2,
                 'nombre'=>'Anzoátegui',
                ));


                //MUNICIPIOS
                Municipio::create(array(
                 'id'=> 1,
                 'nombre'=>'Sucre',
                 'id_estado'=>1,
                ));

                Municipio::create(array(
                 'id'=> 2,
                 'nombre'=>'Cruz Salmerón Acosta',
                 'id_estado'=>1,
                ));

                Municipio::create(array(
                 'id'=> 3,
                 'nombre'=>'Guanta',
                 'id_estado'=>2,
                ));

                Municipio::create(array(
                 'id'=> 4,
                 'nombre'=>'Anaco',
                 'id_estado'=>2,
                ));


                //PARROQUIAS
                Parroquia::create(array(
                 'id'=> 1,
                 'nombre'=>'Altagracia',
                 'id_municipio'=>1,
                ));

                Parroquia::create(array(
                 'id'=> 2,
                 'nombre'=>'Valentin Valiente',
                 'id_municipio'=>1,
                ));

                Parroquia::create(array(
                 'id'=> 3,
                 'nombre'=>'Araya',
                 'id_municipio'=>2,
                ));

                Parroquia::create(array(
                 'id'=> 4,
                 'nombre'=>'Guanta',
                 'id_municipio'=>3,
                ));

                Parroquia::create(array(
                 'id'=> 5,
                 'nombre'=>'Chorrerón',
                 'id_municipio'=>3,
                ));

                Parroquia::create(array(
                 'id'=> 6,
                 'nombre'=>'Anaco',
                 'id_municipio'=>4,
                ));

                Parroquia::create(array(
                 'id'=> 7,
                 'nombre'=>'Buena Vista',
                 'id_municipio'=>4,
                ));


        Model::reguard();
    }
}
