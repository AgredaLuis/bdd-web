<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Http\Request;

//CORREOS
use App\Mail\UsuarioRegistrado;
use App\Mail\UsuarioConfirmado;
use Mail;
use DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/signin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'user' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'max:50'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    //aca cambiar nombre al metodo
    protected function createuser(array $data)
    {

        $Usuario = new User();
        $Usuario->email = $data['email'];
        $Usuario->password = bcrypt($data['password']);
        $Usuario->save();
        $Usuario->roles()->attach($data['role']);

        return $Usuario;
    }

    public function register(Request $request)
    {

        $input=$request->all();
        $input["user"] = "Invitado";
        $validator=$this->validator($input);
        
        if($validator->passes())
        {

            $Data = $this->createuser($input)->toArray();
            $Usuario = User::where('id',$Data['id'])->first();
            $Link = str_random(30);
            $Contrasena = $input["password"];

            DB::table('role_users')->where('user_id', $Data['id'])->update(['token'=>$Link]);

            $DataMail = array('Link'=>$Link,'Usuario'=>$Usuario,'Contrasena'=>$Contrasena);

            //SE ENVIA EL EMAIL PARA ACTIVAR LA CUENTA DE USUARIO
            Mail::to($Usuario->email)->send(new UsuarioRegistrado($DataMail));
         
            return redirect()
                ->to('signin')
                ->with('msg','Enviamos el código de activación de la cuenta de usuario a su correo')
                ->with('title-msg','Cuenta de Usuario Creada')
                ->with('type','success')
                ->with('icon','check');

        }
        else{

            return redirect()
            ->to('newaccount')
            ->with('msg','El correo ya esta registrado')
            ->with('title-msg','Datos errados')
            ->with('type','error')
            ->with('icon','error'); 

        }

        return back()->with('Error',$validator->errors());

    }

    public function userActivation($token)
    {

        $RolUsuario=DB::table('role_users')->where('token',$token)->first();

        if(is_null($RolUsuario)){

            return redirect()
            ->to('signin')
            ->with('msg','Codigo de activacion invalido')
            ->with('title-msg','Activacion fallida')
            ->with('type','warning')
            ->with('icon','warning');     

        }

        $Usuario=User::find($RolUsuario->user_id);

        if($Usuario->is_activated == 1){

            return redirect()
            ->to('signin')
            ->with('msg','El usuario ya se encuentra activado')
            ->with('title-msg','Usuario activado')
            ->with('type','warning')
            ->with('icon','warning');


        }

        $Usuario->update(['is_activated'=>1]);
        DB::table('role_users')->where('token',$token)->update(['is_activated'=>true ,'is_predefined'=>true]);

        //SE ENVIA EL EMAIL CONFIRMANDO LA ACTIVACIÓN DE LA CUENTA DE USUARIO
        Mail::to($Usuario->email)->send(new UsuarioConfirmado());

        return redirect()
            ->to('signin')
            ->with('msg','Ya puede ingresar a su cuenta de usuario')
            ->with('title-msg','Usuario activado')
            ->with('type','success')
            ->with('icon','check');

    }
}
