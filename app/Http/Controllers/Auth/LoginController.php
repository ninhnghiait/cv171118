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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admincp';
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    //
    public function username()
    {
        return 'username';
    }
    protected function credentials(\Illuminate\Http\Request $request)
    {
        return ['username' => $request->{$this->username()}, 'password' => $request->password, 'active' => 1];
    }

    protected function validateLogin()
    {
        $messages = [
            'username.exists' => 'Username hoặc mật khẩu không đúng!',
            'username.credential' => 'Username hoặc mật khẩu không đúng!',
        ];
	    
        $this->validate(request(), [
            $this->username() => 'required|exists:users', 'password' => 'required'
        ], $messages);
    }
//     public function authenticated()
// {
//     if(auth()->user()->hasRole('admin'))
//     {
//         return redirect('/admin/dashboard');
//     } 

//     return redirect('/user/dashboard');
// }

}
