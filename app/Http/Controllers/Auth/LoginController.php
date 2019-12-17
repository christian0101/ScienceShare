<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    //protected $redirectTo = '/';
    /**
     * Where to redirect users after login.
     */
    protected function authenticated()
    {
    	return redirect()->intended()->with('status', 'You are logged in!');
    }

    /**
     * Where to redirect users after logout.
     */
    protected function loggedOut()
    {
        return redirect()->intended()->with('status', 'You are logged out!');
    }

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
