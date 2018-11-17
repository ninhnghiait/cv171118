<?php

namespace App\Http\Controllers\Auth;

use App\Model\User;
use App\Model\UserActivation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\Jobs\SendWelcomeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\Classes\ActivationService;

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
    protected function redirectTo(Request $request)
    {   
        $request->session()->flash('msg','Vui lòng kiểm tra email của bạn để hoàn tất đăng kí tài khoản!');
        return route('login');
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ActivationService $activationService)
    {
        $this->middleware('guest');
        $this->activationService = $activationService;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, 
            [
                'username' => 'required|string|max:255|unique:users',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
                'fullname' => 'required|string|min:6',
            ],
            [  
                'required'=>':attribute Không được để trống',
                'unique'=>':attribute Đã tồn tại',
                'email'=>':attribute Không phải là email',
                'confirmed'=>':attribute Phải giống nhau',
                'min'=>':attribute Không được nhỏ hơn :min kí tự',
                'max'=>':attribute Không được lớn hơn :max kí tự',
            ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'fullname' => $data['fullname'],
            'active' => 0,
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $user = $this->create($request->all());
        event(new Registered($user));
        
        $this->activationService->sendActivationMail($user);
        
        return redirect('/login')->with('msg', 'Bạn hãy kiểm tra email và thực hiện xác thực theo hướng dẫn.');
    }

    public function activateUser($token)
    {
        if ($user = $this->activationService->activateUser($token)) {
            auth()->login($user);
            return redirect('/login');
        }
        abort(404);
    }

}
