<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use Auth;

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

    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');
        $user = \App\User::where($this->username(), $request->{$this->username()})->first();
        if ($user && \Hash::check($request->password, $user->password) && $user->user_type != 'admin') {
            $errors = [$this->username() => 'No es admin.'];
        }else{
            if(Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])){
                return redirect('/home');
            }else{
                $errors = [$this->username() => 'Credenciales inválidas.'];
            }
        }
        return redirect('/login')->withErrors($errors);
    }
     use AuthenticatesUsers;

    // /**
    //  * Where to redirect users after login.
    //  *
    //  * @var string
    //  */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
